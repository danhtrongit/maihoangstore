<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AiArticleJobResource\Pages;
use App\Models\AiArticleJob;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AiArticleJobResource extends Resource
{
    protected static ?string $model = AiArticleJob::class;
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationLabel = 'AI Jobs';
    protected static ?string $navigationGroup = 'AI Tools';
    protected static ?int $navigationSort = 101;
    protected static ?string $modelLabel = 'AI Job';
    protected static ?string $pluralModelLabel = 'AI Jobs';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Source')->schema([
                Forms\Components\TextInput::make('source_url')->url()->required(),
                Forms\Components\TextInput::make('source_title'),
                Forms\Components\TextInput::make('source_category'),
                Forms\Components\TextInput::make('source_image'),
            ])->columns(2),

            Forms\Components\Section::make('Rewritten')->schema([
                Forms\Components\TextInput::make('rewritten_title'),
                Forms\Components\RichEditor::make('rewritten_content'),
            ]),

            Forms\Components\Section::make('Status')->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'crawling' => 'Crawling',
                        'crawled' => 'Crawled',
                        'rewriting' => 'Rewriting',
                        'rewritten' => 'Rewritten',
                        'published' => 'Published',
                        'failed' => 'Failed',
                    ]),
                Forms\Components\Textarea::make('error_message'),
                Forms\Components\TextInput::make('retry_count')->numeric(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('source_url')
                    ->limit(50)
                    ->searchable()
                    ->url(fn ($record) => $record->source_url, shouldOpenInNewTab: true),
                Tables\Columns\TextColumn::make('source_title')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('source_category')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'crawling', 'crawled' => 'info',
                        'rewriting' => 'primary',
                        'rewritten' => 'success',
                        'published' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('rewritten_title')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('post_id')
                    ->label('Post')
                    ->url(fn ($record) => $record->post_id ? route('filament.admin.resources.posts.edit', $record->post_id) : null),
                Tables\Columns\TextColumn::make('retry_count'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'crawled' => 'Crawled',
                        'rewriting' => 'Rewriting',
                        'published' => 'Published',
                        'failed' => 'Failed',
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAiArticleJobs::route('/'),
            'edit' => Pages\EditAiArticleJob::route('/{record}/edit'),
        ];
    }
}
