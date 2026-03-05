<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Dịch vụ';
    protected static ?string $modelLabel = 'Dịch vụ kỹ thuật';
    protected static ?string $pluralModelLabel = 'Dịch vụ kỹ thuật';
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Thông tin dịch vụ')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên dịch vụ')->required()->maxLength(255)
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')->maxLength(255)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('icon')
                    ->label('Icon class')->placeholder('heroicon-o-shield-check'),
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Ảnh đại diện')->image()->directory('services'),
                Forms\Components\Textarea::make('short_description')
                    ->label('Mô tả ngắn')->rows(3),
                Forms\Components\RichEditor::make('content')
                    ->label('Nội dung chi tiết')->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Cài đặt')->schema([
                Forms\Components\Toggle::make('is_active')->label('Hiển thị')->default(true),
                Forms\Components\Toggle::make('is_featured')->label('Nổi bật'),
                Forms\Components\TextInput::make('sort_order')->label('Thứ tự')->numeric()->default(0),
            ])->columns(3),

            Forms\Components\Section::make('SEO')->schema([
                Forms\Components\TextInput::make('meta_title')->label('Meta Title'),
                Forms\Components\Textarea::make('meta_description')->label('Meta Description')->rows(2),
            ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')->label('Ảnh')->circular(),
                Tables\Columns\TextColumn::make('name')->label('Tên dịch vụ')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_active')->label('Hiển thị')->boolean(),
                Tables\Columns\IconColumn::make('is_featured')->label('Nổi bật')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->label('Thứ tự')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Cập nhật')->dateTime('d/m/Y')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Hiển thị'),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
