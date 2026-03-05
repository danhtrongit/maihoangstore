<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Nội dung';
    protected static ?string $navigationLabel = 'Banner / Slider';
    protected static ?string $modelLabel = 'Banner';
    protected static ?string $pluralModelLabel = 'Banner';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Thông tin Banner')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Tiêu đề')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('subtitle')
                        ->label('Phụ đề')
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('image')
                        ->label('Hình ảnh')
                        ->image()
                        ->directory('banners')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('link')
                        ->label('Liên kết')
                        ->url()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('button_text')
                        ->label('Nút bấm')
                        ->maxLength(255),
                    Forms\Components\Select::make('position')
                        ->label('Vị trí')
                        ->options([
                            'main_slider' => 'Slider chính',
                            'sidebar' => 'Sidebar',
                            'popup' => 'Popup',
                            'bottom' => 'Cuối trang',
                            'category' => 'Trang danh mục',
                        ])
                        ->default('main_slider'),
                ])->columns(2),
            Forms\Components\Section::make('Cài đặt')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Kích hoạt')
                        ->default(true),
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Thứ tự')
                        ->numeric()
                        ->default(0),
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Ngày bắt đầu'),
                    Forms\Components\DatePicker::make('end_date')
                        ->label('Ngày kết thúc'),
                ])->columns(4),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Ảnh')
                    ->height(60),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('position')
                    ->label('Vị trí')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'main_slider' => 'Slider chính',
                        'sidebar' => 'Sidebar',
                        'popup' => 'Popup',
                        'bottom' => 'Cuối trang',
                        'category' => 'Danh mục',
                        default => $state,
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('KH')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->label('Vị trí')
                    ->options([
                        'main_slider' => 'Slider chính',
                        'sidebar' => 'Sidebar',
                        'popup' => 'Popup',
                        'bottom' => 'Cuối trang',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
