<?php

namespace App\Services;

use App\Models\AiArticleJob;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AiRewriterService
{
    protected string $apiUrl;
    protected string $apiKey;
    protected string $model;
    protected float $temperature;
    protected string $systemPrompt;

    public function __construct()
    {
        $this->apiUrl = config('services.ai.api_url', 'https://api.openai.com/v1/chat/completions');
        $this->apiKey = config('services.ai.api_key', '');
        $this->model = config('services.ai.model', 'gpt-4o-mini');
        $this->temperature = (float) config('services.ai.temperature', 0.7);

        // FIX: empty string from config should fallback to default
        $configPrompt = config('services.ai.system_prompt', '');
        $this->systemPrompt = (!empty($configPrompt) && strlen(trim($configPrompt)) > 10)
            ? $configPrompt
            : $this->defaultSystemPrompt();
    }

    /**
     * Parse sitemap and return blog URLs
     */
    public function parseSitemap(string $sitemapUrl = 'https://delfi.com.vn/sitemap.xml'): array
    {
        $urls = [];

        try {
            $response = Http::timeout(30)->get($sitemapUrl);
            $xml = simplexml_load_string($response->body());

            if (!$xml) return [];

            if ($xml->getName() === 'sitemapindex') {
                foreach ($xml->sitemap as $sitemap) {
                    $loc = (string) $sitemap->loc;
                    if (str_contains($loc, 'blog-sitemap')) {
                        $urls = array_merge($urls, $this->parseSingleSitemap($loc));
                    }
                }
            } else {
                $urls = $this->parseSingleSitemap($sitemapUrl);
            }
        } catch (\Exception $e) {
            Log::error('Sitemap parse error: ' . $e->getMessage());
        }

        return $urls;
    }

    protected function parseSingleSitemap(string $url): array
    {
        $urls = [];
        try {
            $response = Http::timeout(30)->get($url);
            $xml = simplexml_load_string($response->body());
            if (!$xml) return [];

            foreach ($xml->url as $entry) {
                $loc = (string) $entry->loc;
                $lastmod = isset($entry->lastmod) ? (string) $entry->lastmod : null;

                if (str_contains($loc, '/page/') || $loc === 'https://delfi.com.vn/') continue;

                $urls[] = [
                    'url' => $loc,
                    'lastmod' => $lastmod,
                ];
            }
        } catch (\Exception $e) {
            Log::error('Single sitemap parse error: ' . $e->getMessage());
        }
        return $urls;
    }

    /**
     * Crawl a single article page - improved for Delfi
     */
    public function crawlArticle(string $url): array
    {
        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'vi-VN,vi;q=0.9,en;q=0.8',
                ])
                ->get($url);

            $html = $response->body();

            // Parse title
            $title = $this->extractOgMeta($html, 'og:title')
                  ?? $this->extractBetween($html, '<title>', '</title>');
            $title = html_entity_decode(strip_tags($title ?? ''), ENT_QUOTES, 'UTF-8');
            $title = preg_replace('/\s*[-|–].*?(Delfi|delfi).*$/iu', '', $title);
            $title = trim($title);

            // Parse article content - improved for Delfi's HTML structure
            $content = $this->extractArticleContent($html);

            // Parse featured image
            $image = $this->extractOgMeta($html, 'og:image');

            // Detect category
            $category = $this->detectCategory($html, $url);

            Log::info("Crawled [{$url}]: title=" . mb_strlen($title) . "chars, content=" . mb_strlen(strip_tags($content)) . "chars");

            return [
                'title' => $title,
                'content' => $content,
                'image' => $image,
                'category' => $category,
            ];
        } catch (\Exception $e) {
            Log::error("Crawl error for {$url}: " . $e->getMessage());
            throw $e;
        }
    }

    protected function extractArticleContent(string $html): string
    {
        // Delfi-specific patterns first
        $patterns = [
            // Delfi usually uses these classes
            '/<div[^>]*class="[^"]*content-detail[^"]*"[^>]*>(.*?)<\/div>\s*(?:<\/div>|\s*<div[^>]*class="[^"]*(?:share|related|comment))/si',
            '/<div[^>]*class="[^"]*blog-content[^"]*"[^>]*>(.*?)<\/div>\s*(?:<\/div>|\s*<div[^>]*class="[^"]*(?:share|related|comment))/si',
            '/<div[^>]*class="[^"]*post-content[^"]*"[^>]*>(.*)/si',
            '/<div[^>]*class="[^"]*entry-content[^"]*"[^>]*>(.*)/si',
            '/<div[^>]*class="[^"]*article-content[^"]*"[^>]*>(.*)/si',
            '/<article[^>]*>(.*?)<\/article>/si',
            '/<div[^>]*class="[^"]*content-blog[^"]*"[^>]*>(.*)/si',
            '/<div[^>]*class="[^"]*news-detail[^"]*"[^>]*>(.*)/si',
            '/<div[^>]*class="[^"]*detail-content[^"]*"[^>]*>(.*)/si',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $html, $matches)) {
                $content = $matches[1];
                $content = $this->cleanHtmlContent($content);
                if (mb_strlen(strip_tags($content)) > 100) {
                    return $content;
                }
            }
        }

        // Broader approach: find the largest text block between divs
        $bestContent = '';
        $bestLength = 0;

        // Extract all text-heavy divs
        preg_match_all('/<div[^>]*>((?:(?!<div[^>]*>).)*?)<\/div>/si', $html, $divMatches);
        foreach ($divMatches[1] as $block) {
            $textLen = mb_strlen(strip_tags($block));
            if ($textLen > $bestLength && $textLen > 200) {
                $bestLength = $textLen;
                $bestContent = $block;
            }
        }

        if ($bestContent) {
            return $this->cleanHtmlContent($bestContent);
        }

        // Last resort: extract all paragraphs
        preg_match_all('/<p[^>]*>(.*?)<\/p>/si', $html, $matches);
        if (!empty($matches[0])) {
            $paragraphs = array_filter($matches[0], function ($p) {
                $text = strip_tags($p);
                return mb_strlen($text) > 30;
            });
            if (!empty($paragraphs)) {
                return $this->cleanHtmlContent(implode("\n", $paragraphs));
            }
        }

        return '';
    }

    protected function cleanHtmlContent(string $content): string
    {
        // Remove scripts, styles, nav, etc
        $content = preg_replace('/<script[^>]*>.*?<\/script>/si', '', $content);
        $content = preg_replace('/<style[^>]*>.*?<\/style>/si', '', $content);
        $content = preg_replace('/<nav[^>]*>.*?<\/nav>/si', '', $content);
        $content = preg_replace('/<footer[^>]*>.*?<\/footer>/si', '', $content);
        $content = preg_replace('/<form[^>]*>.*?<\/form>/si', '', $content);
        $content = preg_replace('/<iframe[^>]*>.*?<\/iframe>/si', '', $content);

        // Remove share/social/comment sections
        $content = preg_replace('/<div[^>]*class="[^"]*(?:share|social|comment|related|sidebar|widget|ad-|banner)[^"]*"[^>]*>.*?<\/div>/si', '', $content);

        // Keep basic HTML
        $content = strip_tags($content, '<p><h1><h2><h3><h4><h5><h6><ul><ol><li><strong><em><b><i><br><a><table><tr><td><th><thead><tbody>');

        // Normalize whitespace
        $content = preg_replace('/\n{3,}/', "\n\n", $content);
        $content = preg_replace('/\s{2,}/', ' ', $content);

        return trim($content);
    }

    protected function extractOgMeta(string $html, string $property): ?string
    {
        if (preg_match('/<meta[^>]*property=["\']' . preg_quote($property) . '["\'][^>]*content=["\']([^"\']+)["\']/i', $html, $matches)) {
            return $matches[1];
        }
        if (preg_match('/<meta[^>]*content=["\']([^"\']+)["\'][^>]*property=["\']' . preg_quote($property) . '["\']/i', $html, $matches)) {
            return $matches[1];
        }
        return null;
    }

    protected function detectCategory(string $html, string $url): string
    {
        // Try breadcrumb with various common patterns
        $breadcrumbPatterns = [
            '/<[^>]*class="[^"]*breadcrumb[^"]*"[^>]*>(.*?)<\/(?:nav|div|ul|ol)>/si',
            '/<nav[^>]*aria-label="[^"]*breadcrumb[^"]*"[^>]*>(.*?)<\/nav>/si',
        ];

        foreach ($breadcrumbPatterns as $pattern) {
            if (preg_match($pattern, $html, $m)) {
                preg_match_all('/<a[^>]*>(.*?)<\/a>/si', $m[1], $links);
                if (count($links[1]) >= 2) {
                    // Get the second-to-last link (category, not current page)
                    $catIndex = count($links[1]) >= 3 ? count($links[1]) - 2 : 1;
                    $category = strip_tags($links[1][$catIndex]);
                    $category = trim($category);
                    if ($category && mb_strlen($category) > 1 && mb_strlen($category) < 100
                        && !str_contains(strtolower($category), 'trang chủ')
                        && !str_contains(strtolower($category), 'home')) {
                        return $category;
                    }
                }
            }
        }

        return 'Tin tức';
    }

    /**
     * Download image to local storage
     */
    public function downloadImage(string $imageUrl): ?string
    {
        try {
            $response = Http::timeout(30)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible)'])
                ->get($imageUrl);

            if ($response->successful()) {
                $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                $extension = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? $extension : 'jpg';
                $filename = 'posts/' . date('Y/m/') . Str::random(20) . '.' . $extension;

                Storage::disk('public')->put($filename, $response->body());
                return $filename;
            }
        } catch (\Exception $e) {
            Log::error("Image download error: " . $e->getMessage());
        }
        return null;
    }

    /**
     * Rewrite article using AI API (non-streaming, reliable)
     */
    public function rewriteArticle(string $title, string $content): array
    {
        $cleanContent = strip_tags($content);
        $truncatedContent = Str::limit($cleanContent, 6000);

        $userMessage = <<<MSG
HÃY VIẾT LẠI BÀI VIẾT SAU. KHÔNG HỎI LẠI. THỰC HIỆN NGAY.

===== TIÊU ĐỀ GỐC =====
{$title}

===== NỘI DUNG GỐC =====
{$truncatedContent}

===== YÊU CẦU =====
Viết lại hoàn toàn bài viết trên với cấu trúc:
## Tiêu đề: [Tiêu đề mới]
## Nội dung:
[Nội dung HTML viết lại]
MSG;

        Log::info("AI Rewrite request: title={$title}, content_length=" . mb_strlen($cleanContent) . ", prompt_length=" . mb_strlen($userMessage));

        $response = Http::timeout(180)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])
            ->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => $this->systemPrompt],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'temperature' => $this->temperature,
                'max_tokens' => 4096,
            ]);

        if (!$response->successful()) {
            $errorBody = $response->body();
            Log::error("AI API error: HTTP {$response->status()} - {$errorBody}");
            throw new \Exception('AI API error (HTTP ' . $response->status() . '): ' . Str::limit($errorBody, 200));
        }

        $result = $response->json('choices.0.message.content', '');

        if (empty($result)) {
            throw new \Exception('AI trả về kết quả rỗng');
        }

        Log::info("AI response length: " . mb_strlen($result));

        return $this->parseAiResponse($result);
    }

    protected function parseAiResponse(string $response): array
    {
        $newTitle = '';
        $newContent = '';

        // Try to parse structured response: ## Tiêu đề: ...
        if (preg_match('/##?\s*(?:Tiêu đề|Title)\s*[:\-]\s*(.+?)(?:\n|$)/iu', $response, $m)) {
            $newTitle = trim($m[1]);
            $newTitle = preg_replace('/^["\'"「」【】\[\]]+|["\'"「」【】\[\]]+$/u', '', $newTitle);
        }

        // Find content after "## Nội dung:" marker
        if (preg_match('/##?\s*(?:Nội dung|Content)\s*[:\-]\s*\n?(.*)/siu', $response, $m)) {
            $newContent = trim($m[1]);
        } elseif ($newTitle) {
            // Content = everything after the title line
            $titlePos = mb_strpos($response, $newTitle);
            if ($titlePos !== false) {
                $afterTitle = mb_substr($response, $titlePos + mb_strlen($newTitle));
                $newContent = trim($afterTitle);
                $newContent = preg_replace('/^[\s\n]*##?\s*(?:Nội dung|Content)\s*[:\-]?\s*/iu', '', $newContent);
            }
        }

        // Fallback: first line is title, rest is content
        if (empty($newTitle)) {
            $lines = preg_split('/\n/', $response, 2);
            $newTitle = preg_replace('/^#+\s*/', '', trim($lines[0] ?? ''));
            $newTitle = preg_replace('/^["\'"]+|["\'"]+$/u', '', $newTitle);
            $newContent = trim($lines[1] ?? '');
        }

        // Validate - if title looks like AI is asking a question, it failed
        if (mb_strlen($newTitle) > 200 || str_contains($newTitle, '?') && str_contains(mb_strtolower($newTitle), 'bạn muốn')) {
            Log::error("AI returned invalid response (question instead of rewrite). Response: " . Str::limit($response, 500));
            throw new \Exception('AI trả lời không đúng format (hỏi ngược thay vì viết lại). Kiểm tra lại system prompt và API key.');
        }

        return [
            'title' => $newTitle ?: 'Untitled',
            'content' => $newContent ?: $response,
        ];
    }

    /**
     * Process entire pipeline for a single job
     */
    public function processJob(AiArticleJob $job, ?callable $onProgress = null): void
    {
        try {
            // Step 1: Crawl
            $this->notify($onProgress, $job, 'crawling', 'Đang crawl bài viết...');
            $job->update(['status' => 'crawling']);

            $article = $this->crawlArticle($job->source_url);

            $job->update([
                'source_title' => $article['title'],
                'source_content' => Str::limit($article['content'], 65000), // MySQL text limit
                'source_image' => $article['image'],
                'source_category' => $article['category'],
                'status' => 'crawled',
            ]);
            $this->notify($onProgress, $job, 'crawled', "Đã crawl: {$article['title']} (" . mb_strlen(strip_tags($article['content'])) . " ký tự)");

            // Step 2: Download image
            if ($article['image']) {
                $this->notify($onProgress, $job, 'crawled', 'Đang tải ảnh đại diện...');
                $localImage = $this->downloadImage($article['image']);
                if ($localImage) {
                    $job->update(['local_image' => $localImage]);
                    $this->notify($onProgress, $job, 'crawled', '✓ Đã tải ảnh: ' . $localImage);
                }
            }

            // Step 3: find or create category
            $category = PostCategory::firstOrCreate(
                ['name' => $article['category']],
                ['slug' => Str::slug($article['category']), 'is_active' => true, 'sort_order' => 0]
            );
            $job->update(['post_category_id' => $category->id]);

            // Step 4: Rewrite with AI
            $contentLength = mb_strlen(strip_tags($article['content']));
            if (empty($article['content']) || $contentLength < 50) {
                throw new \Exception("Nội dung bài viết quá ngắn ({$contentLength} ký tự) hoặc không crawl được.");
            }

            $this->notify($onProgress, $job, 'rewriting', "AI đang viết lại bài viết ({$contentLength} ký tự)...");
            $job->update(['status' => 'rewriting']);

            // Always use non-streaming for reliability, but notify via progress callback
            $aiResult = $this->rewriteArticle($article['title'], $article['content']);

            $job->update([
                'rewritten_title' => $aiResult['title'],
                'rewritten_content' => $aiResult['content'],
                'status' => 'rewritten',
            ]);
            $this->notify($onProgress, $job, 'rewritten', "Đã viết lại: {$aiResult['title']}");

            // Step 5: Create Post
            $slug = Str::slug($aiResult['title']);
            // Ensure unique slug
            $existingSlug = Post::where('slug', $slug)->exists();
            if ($existingSlug) {
                $slug .= '-' . Str::random(4);
            }

            $post = Post::create([
                'title' => $aiResult['title'],
                'slug' => $slug,
                'post_category_id' => $category->id,
                'user_id' => 1,
                'thumbnail' => $job->local_image,
                'excerpt' => Str::limit(strip_tags($aiResult['content']), 200),
                'content' => $aiResult['content'],
                'is_active' => true,
                'is_featured' => false,
                'published_at' => now(),
                'meta_title' => Str::limit($aiResult['title'], 60),
                'meta_description' => Str::limit(strip_tags($aiResult['content']), 160),
            ]);

            $job->update([
                'post_id' => $post->id,
                'status' => 'published',
            ]);
            $this->notify($onProgress, $job, 'published', "✅ Đã xuất bản: {$aiResult['title']}");

        } catch (\Exception $e) {
            $job->update([
                'status' => 'failed',
                'error_message' => Str::limit($e->getMessage(), 500),
                'retry_count' => $job->retry_count + 1,
            ]);
            $this->notify($onProgress, $job, 'failed', "❌ Lỗi: {$e->getMessage()}");
            Log::error("AI Article Job #{$job->id} failed: " . $e->getMessage());
        }
    }

    protected function notify(?callable $callback, AiArticleJob $job, string $status, string $message): void
    {
        if ($callback) {
            $callback([
                'job_id' => $job->id,
                'status' => $status,
                'type' => 'progress',
                'message' => $message,
                'url' => $job->source_url,
            ]);
        }
    }

    protected function extractBetween(string $html, string $start, string $end): ?string
    {
        $startPos = strpos($html, $start);
        if ($startPos === false) return null;
        $startPos += strlen($start);
        $endPos = strpos($html, $end, $startPos);
        if ($endPos === false) return null;
        return substr($html, $startPos, $endPos - $startPos);
    }

    protected function defaultSystemPrompt(): string
    {
        return <<<'PROMPT'
Bạn là chuyên gia viết lại bài viết SEO tiếng Việt chuyên nghiệp trong lĩnh vực thiết bị mã vạch, máy POS, giải pháp quản lý kho.

NHIỆM VỤ: Viết lại bài viết được cung cấp. KHÔNG HỎI LẠI. KHÔNG TỪ CHỐI. THỰC HIỆN NGAY LẬP TỨC.

Quy tắc viết lại:
1. Viết lại HOÀN TOÀN nội dung - KHÔNG sao chép nguyên văn
2. Giữ nguyên ý chính và thông tin kỹ thuật chính xác
3. Thay đổi cấu trúc câu, từ ngữ, cách trình bày
4. Sử dụng giọng văn chuyên nghiệp, dễ hiểu
5. Tối ưu SEO: sử dụng heading h2/h3, danh sách, từ khóa tự nhiên
6. Thay thế tên "Delfi" bằng "Mai Hoàng" nếu có đề cập
7. Độ dài bài viết tương đương hoặc dài hơn bài gốc
8. Viết bằng HTML đơn giản: <h2>, <h3>, <p>, <ul>, <li>, <strong>, <em>

Format trả lời BẮT BUỘC (PHẢI tuân thủ chính xác):
## Tiêu đề: [Tiêu đề mới đã viết lại]
## Nội dung:
[Nội dung HTML đã viết lại đầy đủ]
PROMPT;
    }
}
