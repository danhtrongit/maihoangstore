<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class SiteSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Hệ thống';
    protected static ?string $navigationLabel = 'Cài đặt website';
    protected static ?string $title = 'Cài đặt website';
    protected static ?int $navigationSort = 10;

    protected static string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Thông tin chung')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Tên website')
                                    ->default('Mai Hoàng Store'),
                                Forms\Components\TextInput::make('site_tagline')
                                    ->label('Slogan'),
                                Forms\Components\Textarea::make('site_description')
                                    ->label('Mô tả website')
                                    ->rows(3),
                                Forms\Components\FileUpload::make('site_logo')
                                    ->label('Logo')
                                    ->image()
                                    ->directory('settings'),
                                Forms\Components\FileUpload::make('site_favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->directory('settings'),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make('Liên hệ')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\TextInput::make('contact_phone')
                                    ->label('Số điện thoại')
                                    ->tel(),
                                Forms\Components\TextInput::make('contact_hotline')
                                    ->label('Hotline')
                                    ->tel(),
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Email')
                                    ->email(),
                                Forms\Components\Textarea::make('contact_address')
                                    ->label('Địa chỉ')
                                    ->rows(2),
                                Forms\Components\TextInput::make('contact_working_hours')
                                    ->label('Giờ làm việc'),
                                Forms\Components\TextInput::make('contact_map_embed')
                                    ->label('Google Maps Embed URL'),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make('Mạng xã hội')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\TextInput::make('social_facebook')
                                    ->label('Facebook')
                                    ->url(),
                                Forms\Components\TextInput::make('social_youtube')
                                    ->label('YouTube')
                                    ->url(),
                                Forms\Components\TextInput::make('social_instagram')
                                    ->label('Instagram')
                                    ->url(),
                                Forms\Components\TextInput::make('social_tiktok')
                                    ->label('TikTok')
                                    ->url(),
                                Forms\Components\TextInput::make('social_zalo')
                                    ->label('Zalo'),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make('Bán hàng')
                            ->icon('heroicon-o-shopping-cart')
                            ->schema([
                                Forms\Components\TextInput::make('shipping_fee_default')
                                    ->label('Phí ship mặc định (₫)')
                                    ->numeric()
                                    ->default(30000),
                                Forms\Components\TextInput::make('free_shipping_threshold')
                                    ->label('Miễn phí ship từ (₫)')
                                    ->numeric()
                                    ->default(500000),
                                Forms\Components\Textarea::make('bank_info')
                                    ->label('Thông tin chuyển khoản')
                                    ->rows(4),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->label('Meta Title'),
                                Forms\Components\Textarea::make('seo_description')
                                    ->label('Meta Description')
                                    ->rows(3),
                                Forms\Components\TextInput::make('seo_keywords')
                                    ->label('Meta Keywords'),
                                Forms\Components\Textarea::make('google_analytics')
                                    ->label('Google Analytics Code')
                                    ->rows(3),
                                Forms\Components\Textarea::make('head_scripts')
                                    ->label('Scripts trong <head>')
                                    ->rows(3),
                                Forms\Components\Textarea::make('body_scripts')
                                    ->label('Scripts trước </body>')
                                    ->rows(3),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => $this->getGroupForKey($key),
                ]
            );
        }

        Notification::make()
            ->title('Đã lưu cài đặt thành công')
            ->success()
            ->send();

        Cache::forget('site_settings');
    }

    private function getGroupForKey(string $key): string
    {
        return match (true) {
            str_starts_with($key, 'site_') => 'general',
            str_starts_with($key, 'contact_') => 'contact',
            str_starts_with($key, 'social_') => 'social',
            str_starts_with($key, 'shipping_') || str_starts_with($key, 'free_') || $key === 'bank_info' => 'sales',
            str_starts_with($key, 'seo_') || str_contains($key, 'analytics') || str_contains($key, 'scripts') => 'seo',
            default => 'general',
        };
    }
}
