<?php

namespace App\Jobs;

use App\Models\AiArticleJob;
use App\Services\AiRewriterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAiArticleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 1;
    public int $timeout = 300;

    public function __construct(
        public int $jobId
    ) {}

    public function handle(AiRewriterService $service): void
    {
        $job = AiArticleJob::find($this->jobId);

        if (!$job || $job->status === 'published') {
            return;
        }

        $service->processJob($job);
    }
}
