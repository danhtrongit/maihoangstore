<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_article_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('source_url')->unique();
            $table->string('source_title')->nullable();
            $table->text('source_content')->nullable();
            $table->string('source_image')->nullable();
            $table->string('source_category')->nullable();

            $table->string('rewritten_title')->nullable();
            $table->text('rewritten_content')->nullable();
            $table->string('local_image')->nullable();

            $table->foreignId('post_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('post_category_id')->nullable()->constrained()->nullOnDelete();

            $table->enum('status', ['pending', 'crawling', 'crawled', 'rewriting', 'rewritten', 'published', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->integer('retry_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_article_jobs');
    }
};
