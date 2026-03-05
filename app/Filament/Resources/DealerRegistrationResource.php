<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DealerRegistrationResource\Pages;
use App\Models\DealerRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DealerRegistrationResource extends Resource
{
    protected static ?string $model = DealerRegistration::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationGroup = 'Quản lý';
    protected static ?string $modelLabel = 'Đăng ký đại lý';
    protected static ?string $pluralModelLabel = 'Đăng ký đại lý';
    protected static ?int $navigationSort = 50;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Thông tin đăng ký')->schema([
                Forms\Components\TextInput::make('company_name')->label('Tên công ty')->required(),
                Forms\Components\TextInput::make('contact_person')->label('Người liên hệ')->required(),
                Forms\Components\TextInput::make('phone')->label('Số điện thoại')->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email(),
                Forms\Components\TextInput::make('address')->label('Địa chỉ'),
                Forms\Components\TextInput::make('city')->label('Thành phố'),
                Forms\Components\Textarea::make('products_interested')->label('Sản phẩm quan tâm'),
                Forms\Components\Textarea::make('message')->label('Ghi chú'),
            ])->columns(2),

            Forms\Components\Section::make('Xử lý')->schema([
                Forms\Components\Select::make('status')->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ xử lý',
                        'contacted' => 'Đã liên hệ',
                        'approved' => 'Đã duyệt',
                        'rejected' => 'Từ chối',
                    ])->default('pending'),
                Forms\Components\Textarea::make('admin_notes')->label('Ghi chú admin'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')->label('Công ty')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('contact_person')->label('Người LH')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('SĐT'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('city')->label('TP'),
                Tables\Columns\BadgeColumn::make('status')->label('Trạng thái')
                    ->colors(['warning' => 'pending', 'info' => 'contacted', 'success' => 'approved', 'danger' => 'rejected']),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày gửi')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Trạng thái')
                    ->options(['pending' => 'Chờ xử lý', 'contacted' => 'Đã liên hệ', 'approved' => 'Đã duyệt', 'rejected' => 'Từ chối']),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\ViewAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDealerRegistrations::route('/'),
            'create' => Pages\CreateDealerRegistration::route('/create'),
            'edit' => Pages\EditDealerRegistration::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }
}
