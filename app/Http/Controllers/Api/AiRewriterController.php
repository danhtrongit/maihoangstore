<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessAiArticleJob;
use App\Models\AiArticleJob;
use App\Services\AiRewriterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class AiRewriterController extends Controller
{
    protected AiRewriterService $service;

    public function __construct(AiRewriterService $service)
    {
        $this->service = $service;
    }

    /**
     * Fetch sitemap URLs and create pending jobs
     */
    public function fetchSitemap(Request $request)
    {
        $sitemapUrl = $request->input('sitemap_url', 'https://delfi.com.vn/sitemap.xml');
        $urls = $this->service->parseSitemap($sitemapUrl);

        $created = 0;
        $skipped = 0;

        foreach ($urls as $entry) {
            $exists = AiArticleJob::where('source_url', $entry['url'])->exists();
            if (!$exists) {
                AiArticleJob::create([
                    'source_url' => $entry['url'],
                    'status' => 'pending',
                ]);
                $created++;
            } else {
                $skipped++;
            }
        }

        return response()->json([
            'success' => true,
            'total_found' => count($urls),
            'created' => $created,
            'skipped' => $skipped,
            'message' => "Tìm thấy {$created} bài mới, {$skipped} bài đã tồn tại.",
        ]);
    }

    /**
     * Get job statistics
     */
    public function stats()
    {
        return response()->json([
            'total' => AiArticleJob::count(),
            'pending' => AiArticleJob::where('status', 'pending')->count(),
            'crawled' => AiArticleJob::where('status', 'crawled')->count(),
            'rewriting' => AiArticleJob::where('status', 'rewriting')->count(),
            'rewritten' => AiArticleJob::where('status', 'rewritten')->count(),
            'published' => AiArticleJob::where('status', 'published')->count(),
            'failed' => AiArticleJob::where('status', 'failed')->count(),
            'worker_running' => Cache::get('ai_worker_running', false),
        ]);
    }

    /**
     * Get jobs list
     */
    public function jobs(Request $request)
    {
        $query = AiArticleJob::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->orderByDesc('id')->paginate(20);

        return response()->json($jobs);
    }

    /**
     * Dispatch batch and start queue worker in background
     */
    public function processBatch(Request $request)
    {
        $limit = $request->input('limit', 5);

        $jobs = AiArticleJob::whereIn('status', ['pending', 'crawled', 'failed'])
            ->where('retry_count', '<', 3)
            ->orderBy('id')
            ->limit($limit)
            ->get();

        if ($jobs->isEmpty()) {
            return response()->json([
                'success' => true,
                'dispatched' => 0,
                'message' => 'Không có bài viết nào cần xử lý.',
            ]);
        }

        foreach ($jobs as $job) {
            ProcessAiArticleJob::dispatch($job->id)->onQueue('ai-rewriter');
        }

        $this->ensureWorkerRunning();

        return response()->json([
            'success' => true,
            'dispatched' => $jobs->count(),
            'message' => "Đã đưa {$jobs->count()} bài vào hàng đợi. Worker đang chạy nền.",
        ]);
    }

    /**
     * Dispatch ALL pending jobs and start worker
     */
    public function processAll()
    {
        $jobs = AiArticleJob::whereIn('status', ['pending', 'crawled', 'failed'])
            ->where('retry_count', '<', 3)
            ->orderBy('id')
            ->get();

        if ($jobs->isEmpty()) {
            return response()->json([
                'success' => true,
                'dispatched' => 0,
                'message' => 'Không có bài viết nào cần xử lý.',
            ]);
        }

        foreach ($jobs as $job) {
            ProcessAiArticleJob::dispatch($job->id)->onQueue('ai-rewriter');
        }

        $this->ensureWorkerRunning();

        return response()->json([
            'success' => true,
            'dispatched' => $jobs->count(),
            'message' => "Đã đưa {$jobs->count()} bài vào hàng đợi. Worker đang chạy nền.",
        ]);
    }

    /**
     * Process the next available job synchronously (called by frontend loop)
     */
    public function processNext()
    {
        $job = AiArticleJob::whereIn('status', ['pending', 'crawled', 'failed'])
            ->where('retry_count', '<', 3)
            ->orderBy('id')
            ->first();

        if (!$job) {
            return response()->json([
                'done' => true,
                'message' => 'Không còn bài viết nào cần xử lý.',
            ]);
        }

        try {
            $this->service->processJob($job);
            $job->refresh();

            return response()->json([
                'done' => false,
                'success' => true,
                'job_id' => $job->id,
                'title' => $job->rewritten_title ?? $job->source_title ?? $job->source_url,
                'status' => $job->status,
            ]);
        } catch (\Throwable $e) {
            $job->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'retry_count' => $job->retry_count + 1,
            ]);

            return response()->json([
                'done' => false,
                'success' => false,
                'job_id' => $job->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Process a single job by ID (sync - only for individual button click)
     */
    public function processJob(Request $request, AiArticleJob $aiArticleJob)
    {
        if ($aiArticleJob->status === 'published') {
            return response()->json(['error' => 'Bài viết đã được xuất bản.'], 422);
        }

        // Dispatch to queue instead of sync
        ProcessAiArticleJob::dispatch($aiArticleJob->id)->onQueue('ai-rewriter');
        $this->ensureWorkerRunning();

        return response()->json([
            'success' => true,
            'message' => "Job #{$aiArticleJob->id} đã được đưa vào hàng đợi.",
        ]);
    }

    /**
     * Delete a job
     */
    public function deleteJob(AiArticleJob $aiArticleJob)
    {
        $aiArticleJob->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Clear all jobs
     */
    public function clearAll()
    {
        $count = AiArticleJob::count();
        AiArticleJob::truncate();
        return response()->json(['success' => true, 'deleted' => $count, 'message' => "Đã xóa {$count} jobs."]);
    }

    /**
     * Retry failed jobs
     */
    public function retryFailed()
    {
        $count = AiArticleJob::where('status', 'failed')
            ->where('retry_count', '<', 3)
            ->update(['status' => 'pending']);

        return response()->json([
            'success' => true,
            'reset' => $count,
            'message' => "{$count} bài đã được đặt lại để thử lại.",
        ]);
    }

    /**
     * Get AI config
     */
    public function getConfig()
    {
        return response()->json([
            'api_url' => config('services.ai.api_url', 'https://api.openai.com/v1/chat/completions'),
            'api_key' => config('services.ai.api_key') ? '***' . substr(config('services.ai.api_key'), -4) : '',
            'model' => config('services.ai.model', 'gpt-4o-mini'),
            'temperature' => config('services.ai.temperature', 0.7),
            'system_prompt' => config('services.ai.system_prompt', ''),
        ]);
    }

    /**
     * Update AI config
     */
    public function updateConfig(Request $request)
    {
        $validated = $request->validate([
            'api_url' => 'required|url',
            'api_key' => 'nullable|string',
            'model' => 'required|string',
            'temperature' => 'required|numeric|min:0|max:2',
            'system_prompt' => 'nullable|string',
        ]);

        $settings = [
            'ai_api_url' => $validated['api_url'],
            'ai_model' => $validated['model'],
            'ai_temperature' => $validated['temperature'],
        ];

        if (!empty($validated['api_key']) && !str_starts_with($validated['api_key'], '***')) {
            $settings['ai_api_key'] = $validated['api_key'];
        }

        if (!empty($validated['system_prompt'])) {
            $settings['ai_system_prompt'] = $validated['system_prompt'];
        }

        foreach ($settings as $key => $value) {
            $envKey = strtoupper($key);
            $this->setEnv($envKey, $value);
        }

        Artisan::call('config:clear');

        return response()->json(['success' => true, 'message' => 'Cấu hình AI đã được cập nhật.']);
    }

    /**
     * Start a background queue worker process if not already running
     */
    protected function ensureWorkerRunning(): void
    {
        $pidFile = storage_path('app/ai-worker.pid');

        // Check if worker is already running
        if (file_exists($pidFile)) {
            $pid = (int) file_get_contents($pidFile);
            if ($pid > 0 && posix_kill($pid, 0)) {
                // Worker still alive
                Cache::put('ai_worker_running', true, 600);
                return;
            }
            // Stale pid file
            @unlink($pidFile);
        }

        // Launch worker in background
        $php = PHP_BINARY;
        $artisan = base_path('artisan');
        $logFile = storage_path('logs/ai-worker.log');

        $cmd = sprintf(
            '%s %s queue:work database --queue=ai-rewriter --timeout=300 --tries=1 --stop-when-empty >> %s 2>&1 & echo $!',
            escapeshellarg($php),
            escapeshellarg($artisan),
            escapeshellarg($logFile)
        );

        $pid = trim(shell_exec($cmd));

        if ($pid && is_numeric($pid)) {
            file_put_contents($pidFile, $pid);
            Cache::put('ai_worker_running', true, 600);
        }
    }

    protected function setEnv(string $key, $value): void
    {
        $envFile = base_path('.env');
        $content = file_get_contents($envFile);

        $value = is_numeric($value) ? $value : '"' . $value . '"';

        if (preg_match("/^{$key}=.*/m", $content)) {
            $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
        } else {
            $content .= "\n{$key}={$value}";
        }

        file_put_contents($envFile, $content);
    }
}
