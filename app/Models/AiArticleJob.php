<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiArticleJob extends Model
{
    protected $fillable = [
        'source_url', 'source_title', 'source_content', 'source_image', 'source_category',
        'rewritten_title', 'rewritten_content', 'local_image',
        'post_id', 'post_category_id',
        'status', 'error_message', 'retry_count',
    ];

    protected $casts = [
        'retry_count' => 'integer',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending' => '⏳ Chờ xử lý',
            'crawling' => '🔍 Đang crawl',
            'crawled' => '📄 Đã crawl',
            'rewriting' => '✍️ Đang viết lại',
            'rewritten' => '✅ Đã viết lại',
            'published' => '🚀 Đã xuất bản',
            'failed' => '❌ Lỗi',
            default => $this->status,
        };
    }
}
