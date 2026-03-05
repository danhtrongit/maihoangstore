<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Bán hàng';
    protected static ?string $navigationLabel = 'Mã giảm giá';
    protected static ?string $modelLabel = 'Mã giảm giá';
    protected static ?string $pluralModelLabel = 'Mã giảm giá';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Thông tin')
                ->schema([
                    Forms\Components\TextInput::make('code')
                        ->label('Mã giảm giá')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\TextInput::make('name')
                        ->label('Tên')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->label('Mô tả')
                        ->rows(2)
                        ->columnSpanFull(),
                ])->columns(2),
            Forms\Components\Section::make('Giá trị')
                ->schema([
                    Forms\Components\Select::make('type')
                        ->label('Loại')
                        ->options([
                            'fixed' => 'Số tiền cố định (₫)',
                            'percent' => 'Phần trăm (%)',
                        ])
                        ->default('fixed')
                        ->required(),
                    Forms\Components\TextInput::make('value')
                        ->label('Giá trị')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('min_order')
                        ->label('Đơn hàng tối thiểu')
                        ->numeric()
                        ->prefix('₫'),
                    Forms\Components\TextInput::make('max_discount')
                        ->label('Giảm tối đa')
                        ->numeric()
                        ->prefix('₫'),
                ])->columns(2),
            Forms\Components\Section::make('Giới hạn')
                ->schema([
                    Forms\Components\TextInput::make('usage_limit')
                        ->label('Số lần sử dụng tối đa')
                        ->numeric(),
                    Forms\Components\TextInput::make('used_count')
                        ->label('Đã sử dụng')
                        ->numeric()
                        ->disabled()
                        ->default(0),
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Ngày bắt đầu'),
                    Forms\Components\DatePicker::make('end_date')
                        ->label('Ngày kết thúc'),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Kích hoạt')
                        ->default(true)
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Mã')
                    ->searchable()
                    ->weight('bold')
                    ->copyable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('type')
                    ->label('Loại')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'fixed' ? 'Cố định' : 'Phần trăm'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Giá trị')
                    ->formatStateUsing(fn ($record): string =>
                        $record->type === 'percent' ? $record->value . '%' : number_format($record->value) . '₫'
                    ),
                Tables\Columns\TextColumn::make('used_count')
                    ->label('Đã dùng')
                    ->formatStateUsing(fn ($record): string =>
                        $record->used_count . '/' . ($record->usage_limit ?? '∞')
                    ),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('KH')
                    ->boolean(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Hết hạn')
                    ->date('d/m/Y')
                    ->placeholder('Không giới hạn'),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
