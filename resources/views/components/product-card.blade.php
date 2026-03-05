@props(['product'])

<div class="product-card-list flex-col">
    <div class="relative w-full">
        @if($product->is_new) <span class="badge-new absolute top-0 left-0 z-10">NEW</span> @endif
        @if($product->is_hot) <span class="badge-hot absolute top-0 left-0 z-10 {{ $product->is_new ? 'top-6' : '' }}">HOT</span> @endif
        @if($product->sale_price && $product->sale_price < $product->price)
            <span class="badge-sale absolute top-0 right-0 z-10">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
        @endif
        <div class="h-44 bg-gray-50 flex items-center justify-center">
            @if($product->thumbnail)
                <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain p-3">
            @else
                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            @endif
        </div>
    </div>
    <div class="pt-3">
        <a href="{{ route('products.show', $product->slug) }}" class="text-sm font-bold text-[#ea4335] hover:underline line-clamp-2 mb-2 block">{{ $product->name }}</a>
        @if($product->short_description)
        <p class="text-xs text-gray-500 line-clamp-2 mb-3"><strong>Đặc Điểm:</strong> {{ Str::limit($product->short_description, 100) }}</p>
        @endif
        @if($product->sale_price && $product->sale_price < $product->price)
        <p class="text-sm font-bold text-[#ea4335] mb-3">{{ number_format($product->sale_price) }}₫ <span class="text-gray-400 line-through text-xs font-normal">{{ number_format($product->price) }}₫</span></p>
        @elseif($product->price)
        <p class="text-sm font-bold text-gray-800 mb-3">{{ number_format($product->price) }}₫</p>
        @else
        <p class="text-sm font-bold text-[#ea4335] mb-3">Liên hệ</p>
        @endif
        <a href="{{ route('products.show', $product->slug) }}" class="btn-dark text-xs !py-1.5">XEM CHI TIẾT</a>
    </div>
</div>
