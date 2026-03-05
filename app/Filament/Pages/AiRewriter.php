<?php

namespace App\Filament\Pages;

use App\Models\AiArticleJob;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class AiRewriter extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'AI Viết Bài';
    protected static ?string $title = 'AI Article Rewriter';
    protected static ?string $navigationGroup = 'AI Tools';
    protected static ?int $navigationSort = 100;

    protected static string $view = 'filament.pages.ai-rewriter';

    public function getHeaderActions(): array
    {
        return [
            Action::make('settings')
                ->label('⚙️ Cấu hình AI')
                ->color('gray')
                ->modalHeading('Cấu hình AI')
                ->modalDescription('Cấu hình kết nối đến AI API (hỗ trợ proxy)')
                ->form([
                    Forms\Components\TextInput::make('api_url')
                        ->label('API URL (Proxy)')
                        ->placeholder('https://api.openai.com/v1/chat/completions')
                        ->default(config('services.ai.api_url'))
                        ->required()
                        ->url(),
                    Forms\Components\TextInput::make('api_key')
                        ->label('API Key')
                        ->placeholder('sk-...')
                        ->default(config('services.ai.api_key') ? '***' . substr(config('services.ai.api_key'), -4) : '')
                        ->password()
                        ->revealable(),
                    Forms\Components\TextInput::make('model')
                        ->label('Model')
                        ->placeholder('gpt-4o-mini')
                        ->default(config('services.ai.model', 'gpt-4o-mini'))
                        ->required(),
                    Forms\Components\TextInput::make('temperature')
                        ->label('Temperature')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(2)
                        ->step(0.1)
                        ->default(config('services.ai.temperature', 0.7)),
                    Forms\Components\Textarea::make('system_prompt')
                        ->label('System Prompt')
                        ->rows(6)
                        ->placeholder('Để trống sẽ dùng prompt mặc định'),
                ])
                ->action(function (array $data) {
                    try {
                        $response = Http::post(url('/api/ai-rewriter/config'), $data);
                        if ($response->successful()) {
                            Notification::make()->title('Đã lưu cấu hình AI!')->success()->send();
                        } else {
                            Notification::make()->title('Lỗi: ' . $response->json('message', 'Unknown'))->danger()->send();
                        }
                    } catch (\Exception $e) {
                        Notification::make()->title('Lỗi: ' . $e->getMessage())->danger()->send();
                    }
                }),
        ];
    }

    public function getStats(): array
    {
        return [
            'total' => AiArticleJob::count(),
            'pending' => AiArticleJob::where('status', 'pending')->count(),
            'crawled' => AiArticleJob::where('status', 'crawled')->count(),
            'rewriting' => AiArticleJob::where('status', 'rewriting')->count(),
            'published' => AiArticleJob::where('status', 'published')->count(),
            'failed' => AiArticleJob::where('status', 'failed')->count(),
        ];
    }

    public function getJobs()
    {
        return AiArticleJob::orderByDesc('id')->paginate(15);
    }
}
