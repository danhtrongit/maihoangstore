<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Bán hàng';
    protected static ?string $navigationLabel = 'Đơn hàng';
    protected static ?string $modelLabel = 'Đơn hàng';
    protected static ?string $pluralModelLabel = 'Đơn hàng';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Thông tin khách hàng')
                        ->schema([
                            Forms\Components\TextInput::make('customer_name')
                                ->label('Tên khách hàng')
                                ->required(),
                            Forms\Components\TextInput::make('customer_email')
                                ->label('Email')
                                ->email(),
                            Forms\Components\TextInput::make('customer_phone')
                                ->label('Số điện thoại')
                                ->required(),
                            Forms\Components\Textarea::make('shipping_address')
                                ->label('Địa chỉ giao hàng')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('note')
                                ->label('Ghi chú')
                                ->rows(2)
                                ->columnSpanFull(),
                        ])->columns(2),
                    Forms\Components\Section::make('Sản phẩm')
                        ->schema([
                            Forms\Components\Repeater::make('items')
                                ->label('')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('product_id')
                                        ->label('Sản phẩm')
                                        ->relationship('product', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                                            if ($state) {
                                                $product = \App\Models\Product::find($state);
                                                if ($product) {
                                                    $set('product_name', $product->name);
                                                    $set('product_sku', $product->sku);
                                                    $set('price', $product->current_price);
                                                    $set('subtotal', $product->current_price);
                                                }
                                            }
                                        }),
                                    Forms\Components\Hidden::make('product_name'),
                                    Forms\Components\Hidden::make('product_sku'),
                                    Forms\Components\TextInput::make('price')
                                        ->label('Đơn giá')
                                        ->numeric()
                                        ->required()
                                        ->prefix('₫'),
                                    Forms\Components\TextInput::make('quantity')
                                        ->label('SL')
                                        ->numeric()
                                        ->default(1)
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(fn ($state, Forms\Get $get, Forms\Set $set) =>
                                            $set('subtotal', ($get('price') ?? 0) * ($state ?? 1))
                                        ),
                                    Forms\Components\TextInput::make('subtotal')
                                        ->label('Thành tiền')
                                        ->numeric()
                                        ->prefix('₫')
                                        ->disabled()
                                        ->dehydrated(),
                                ])
                                ->columns(4)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 2]),
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Trạng thái')
                        ->schema([
                            Forms\Components\TextInput::make('order_number')
                                ->label('Mã đơn hàng')
                                ->disabled()
                                ->dehydrated(),
                            Forms\Components\Select::make('status')
                                ->label('Trạng thái')
                                ->options([
                                    'pending' => 'Chờ xác nhận',
                                    'confirmed' => 'Đã xác nhận',
                                    'processing' => 'Đang xử lý',
                                    'shipping' => 'Đang giao hàng',
                                    'delivered' => 'Đã giao hàng',
                                    'cancelled' => 'Đã hủy',
                                ])
                                ->required(),
                            Forms\Components\Select::make('payment_method')
                                ->label('Phương thức thanh toán')
                                ->options([
                                    'cod' => 'COD',
                                    'bank_transfer' => 'Chuyển khoản',
                                    'momo' => 'MoMo',
                                    'vnpay' => 'VNPay',
                                ]),
                            Forms\Components\Select::make('payment_status')
                                ->label('Thanh toán')
                                ->options([
                                    'pending' => 'Chưa thanh toán',
                                    'paid' => 'Đã thanh toán',
                                    'failed' => 'Thất bại',
                                    'refunded' => 'Hoàn tiền',
                                ]),
                        ]),
                    Forms\Components\Section::make('Tổng tiền')
                        ->schema([
                            Forms\Components\TextInput::make('subtotal')
                                ->label('Tạm tính')
                                ->numeric()
                                ->prefix('₫'),
                            Forms\Components\TextInput::make('shipping_fee')
                                ->label('Phí ship')
                                ->numeric()
                                ->prefix('₫')
                                ->default(0),
                            Forms\Components\TextInput::make('discount')
                                ->label('Giảm giá')
                                ->numeric()
                                ->prefix('₫')
                                ->default(0),
                            Forms\Components\TextInput::make('total')
                                ->label('Tổng cộng')
                                ->numeric()
                                ->prefix('₫'),
                        ]),
                ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Mã ĐH')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('SĐT')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Tổng tiền')
                    ->money('VND')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'processing' => 'primary',
                        'shipping' => 'info',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'processing' => 'Đang xử lý',
                        'shipping' => 'Đang giao',
                        'delivered' => 'Đã giao',
                        'cancelled' => 'Đã hủy',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Thanh toán')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Chưa TT',
                        'paid' => 'Đã TT',
                        'failed' => 'Thất bại',
                        'refunded' => 'Hoàn tiền',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'processing' => 'Đang xử lý',
                        'shipping' => 'Đang giao hàng',
                        'delivered' => 'Đã giao hàng',
                        'cancelled' => 'Đã hủy',
                    ]),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Thanh toán')
                    ->options([
                        'pending' => 'Chưa thanh toán',
                        'paid' => 'Đã thanh toán',
                        'failed' => 'Thất bại',
                        'refunded' => 'Hoàn tiền',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
