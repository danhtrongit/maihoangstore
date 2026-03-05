<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeResource\Pages;
use App\Models\Office;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfficeResource extends Resource
{
    protected static ?string $model = Office::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Cài đặt';
    protected static ?string $modelLabel = 'Văn phòng';
    protected static ?string $pluralModelLabel = 'Văn phòng / Chi nhánh';
    protected static ?int $navigationSort = 60;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Tên văn phòng')->required(),
            Forms\Components\Textarea::make('address')->label('Địa chỉ')->required(),
            Forms\Components\TextInput::make('phone')->label('Hotline'),
            Forms\Components\TextInput::make('email')->label('Email'),
            Forms\Components\FileUpload::make('image')->label('Ảnh văn phòng')->image()->directory('offices'),
            Forms\Components\TextInput::make('map_url')->label('Link Google Maps')->url(),
            Forms\Components\Toggle::make('is_active')->label('Hiển thị')->default(true),
            Forms\Components\TextInput::make('sort_order')->label('Thứ tự')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Ảnh')->circular(),
                Tables\Columns\TextColumn::make('name')->label('Tên')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('Hotline'),
                Tables\Columns\IconColumn::make('is_active')->label('Hiển thị')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->label('Thứ tự')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffices::route('/'),
            'create' => Pages\CreateOffice::route('/create'),
            'edit' => Pages\EditOffice::route('/{record}/edit'),
        ];
    }
}
