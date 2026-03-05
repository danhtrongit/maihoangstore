<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Sản phẩm';
    protected static ?string $navigationLabel = 'Sản phẩm';
    protected static ?string $modelLabel = 'Sản phẩm';
    protected static ?string $pluralModelLabel = 'Sản phẩm';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Thông tin sản phẩm')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Tên sản phẩm')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true),
                            Forms\Components\TextInput::make('slug')
                                ->label('Slug')
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            Forms\Components\TextInput::make('sku')
                                ->label('Mã SKU')
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            Forms\Components\Select::make('category_id')
                                ->label('Danh mục')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Forms\Components\Select::make('brand_id')
                                ->label('Thương hiệu')
                                ->relationship('brand', 'name')
                                ->searchable()
                                ->preload(),
                            Forms\Components\TextInput::make('warranty')
                                ->label('Bảo hành'),
                            Forms\Components\TextInput::make('origin')
                                ->label('Xuất xứ'),
                        ])->columns(2),
                    Forms\Components\Section::make('Mô tả')
                        ->schema([
                            Forms\Components\Textarea::make('short_description')
                                ->label('Mô tả ngắn')
                                ->rows(3),
                            Forms\Components\RichEditor::make('description')
                                ->label('Mô tả chi tiết')
                                ->columnSpanFull(),
                        ]),
                    Forms\Components\Section::make('Hình ảnh')
                        ->schema([
                            Forms\Components\FileUpload::make('thumbnail')
                                ->label('Ảnh đại diện')
                                ->image()
                                ->directory('products/thumbnails')
                                ->columnSpanFull(),
                            Forms\Components\Repeater::make('images')
                                ->label('Bộ sưu tập ảnh')
                                ->relationship()
                                ->schema([
                                    Forms\Components\FileUpload::make('image')
                                        ->label('Ảnh')
                                        ->image()
                                        ->directory('products/gallery')
                                        ->required(),
                                    Forms\Components\TextInput::make('alt')
                                        ->label('Alt text'),
                                    Forms\Components\TextInput::make('sort_order')
                                        ->label('Thứ tự')
                                        ->numeric()
                                        ->default(0),
                                ])
                                ->columns(3)
                                ->collapsible()
                                ->columnSpanFull(),
                        ]),
                    Forms\Components\Section::make('Thông số kỹ thuật')
                        ->schema([
                            Forms\Components\Repeater::make('attributes')
                                ->label('')
                                ->relationship()
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Thuộc tính')
                                        ->required(),
                                    Forms\Components\TextInput::make('value')
                                        ->label('Giá trị')
                                        ->required(),
                                    Forms\Components\TextInput::make('sort_order')
                                        ->label('Thứ tự')
                                        ->numeric()
                                        ->default(0),
                                ])
                                ->columns(3)
                                ->collapsible()
                                ->columnSpanFull(),
                        ])->collapsed(),
                    Forms\Components\Section::make('SEO')
                        ->schema([
                            Forms\Components\TextInput::make('meta_title')
                                ->label('Meta Title')
                                ->maxLength(255),
                            Forms\Components\Textarea::make('meta_description')
                                ->label('Meta Description')
                                ->rows(2),
                        ])->collapsed(),
                ])->columnSpan(['lg' => 2]),

            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Giá')
                        ->schema([
                            Forms\Components\TextInput::make('price')
                                ->label('Giá gốc (₫)')
                                ->required()
                                ->numeric()
                                ->prefix('₫'),
                            Forms\Components\TextInput::make('sale_price')
                                ->label('Giá khuyến mãi (₫)')
                                ->numeric()
                                ->prefix('₫'),
                        ]),
                    Forms\Components\Section::make('Kho hàng')
                        ->schema([
                            Forms\Components\TextInput::make('quantity')
                                ->label('Số lượng tồn kho')
                                ->numeric()
                                ->default(0),
                        ]),
                    Forms\Components\Section::make('Trạng thái')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')
                                ->label('Kích hoạt')
                                ->default(true),
                            Forms\Components\Toggle::make('is_featured')
                                ->label('Sản phẩm nổi bật'),
                            Forms\Components\Toggle::make('is_new')
                                ->label('Sản phẩm mới'),
                            Forms\Components\Toggle::make('is_bestseller')
                                ->label('Bán chạy'),
                        ]),
                    Forms\Components\Section::make('Sắp xếp')
                        ->schema([
                            Forms\Components\TextInput::make('sort_order')
                                ->label('Thứ tự')
                                ->numeric()
                                ->default(0),
                        ]),
                ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->square()
                    ->size(60),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Thương hiệu')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Giá KM')
                    ->money('VND')
                    ->sortable()
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Tồn kho')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match(true) {
                        $state === 0 => 'danger',
                        $state < 10 => 'warning',
                        default => 'success',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('KH')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('NB')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Danh mục')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable(),
                Tables\Filters\SelectFilter::make('brand_id')
                    ->label('Thương hiệu')
                    ->relationship('brand', 'name')
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_active')->label('Kích hoạt'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Nổi bật'),
                Tables\Filters\TernaryFilter::make('is_new')->label('Mới'),
                Tables\Filters\Filter::make('on_sale')
                    ->label('Đang giảm giá')
                    ->query(fn ($query) => $query->whereNotNull('sale_price')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
