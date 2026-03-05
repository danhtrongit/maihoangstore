<?php

use App\Http\Controllers\Api\AiRewriterController;
use Illuminate\Support\Facades\Route;

// AI Article Rewriter API
Route::prefix('ai-rewriter')->group(function () {
    Route::post('/fetch-sitemap', [AiRewriterController::class, 'fetchSitemap']);
    Route::get('/stats', [AiRewriterController::class, 'stats']);
    Route::get('/jobs', [AiRewriterController::class, 'jobs']);
    Route::post('/jobs/{aiArticleJob}/process', [AiRewriterController::class, 'processJob']);
    Route::delete('/jobs/{aiArticleJob}', [AiRewriterController::class, 'deleteJob']);
    Route::post('/process-batch', [AiRewriterController::class, 'processBatch']);
    Route::post('/process-next', [AiRewriterController::class, 'processNext']);
    Route::post('/process-all', [AiRewriterController::class, 'processAll']);
    Route::post('/retry-failed', [AiRewriterController::class, 'retryFailed']);
    Route::post('/clear-all', [AiRewriterController::class, 'clearAll']);
    Route::get('/config', [AiRewriterController::class, 'getConfig']);
    Route::post('/config', [AiRewriterController::class, 'updateConfig']);
});
