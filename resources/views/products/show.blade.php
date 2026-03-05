@extends('layouts.app')
@section('title', ($product->meta_title ?: $product->name) . ' - Mai Hoàng Store')
@section('meta_description', $product->meta_description ?: $product->short_description)

@section('content')
{{-- Breadcrumbs - Delfi style --}}
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335] transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            </a>
            <span>/</span>
            @if($product->category)
            <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-[#ea4335] transition">{{ $product->category->name }}</a>
            <span>/</span>
            @endif
            <span class="text-gray-800 font-medium truncate">{{ Str::limit($product->name, 50) }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Product Title - Delfi style --}}
    <h1 class="text-2xl md:text-3xl font-black text-[#ea4335] mb-8">{{ $product->name }}</h1>

    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Left: Image Gallery --}}
        <div class="lg:col-span-1" x-data="{ main: '{{ $product->thumbnail ? Storage::url($product->thumbnail) : '' }}' }">
            <div class="border border-gray-200 bg-white p-4 mb-4">
                <div class="aspect-square flex items-center justify-center">
                    @if($product->thumbnail)
                        <img :src="main" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
                    @else
                        <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    @endif
                </div>
            </div>
            @if($product->images && count(json_decode($product->images, true) ?? []) > 0)
            <div class="flex gap-2 overflow-x-auto">
                @if($product->thumbnail)
                <button @click="main = '{{ Storage::url($product->thumbnail) }}'" class="w-16 h-16 border border-gray-200 flex-shrink-0 bg-white flex items-center justify-center hover:border-[#ea4335] transition p-1">
                    <img src="{{ Storage::url($product->thumbnail) }}" class="max-h-full object-contain">
                </button>
                @endif
                @foreach(json_decode($product->images, true) ?? [] as $img)
                <button @click="main = '{{ Storage::url($img) }}'" class="w-16 h-16 border border-gray-200 flex-shrink-0 bg-white flex items-center justify-center hover:border-[#ea4335] transition p-1">
                    <img src="{{ Storage::url($img) }}" class="max-h-full object-contain">
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Middle: Product Info --}}
        <div class="lg:col-span-1">
            <h2 class="text-xl font-black text-[#1a1a2e] uppercase mb-4">{{ $product->name }}</h2>

            <table class="w-full text-sm mb-6">
                <tbody>
                    @if($product->sku)
                    <tr class="border-b border-gray-100">
                        <td class="font-bold text-gray-700 py-2 pr-4 whitespace-nowrap">Mã sản phẩm:</td>
                        <td class="py-2 text-gray-600">{{ $product->sku }}</td>
                    </tr>
                    @endif
                    @if($product->brand)
                    <tr class="border-b border-gray-100">
                        <td class="font-bold text-gray-700 py-2 pr-4 whitespace-nowrap">Thương Hiệu:</td>
                        <td class="py-2 text-gray-600">{{ $product->brand->name }}</td>
                    </tr>
                    @endif
                    @if($product->short_description)
                    <tr class="border-b border-gray-100">
                        <td class="font-bold text-gray-700 py-2 pr-4 whitespace-nowrap align-top">Đặc Điểm:</td>
                        <td class="py-2 text-gray-600">{{ $product->short_description }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            {{-- Price --}}
            @if($product->sale_price && $product->sale_price < $product->price)
            <div class="mb-4">
                <span class="text-2xl font-black text-[#ea4335]">{{ number_format($product->sale_price) }}₫</span>
                <span class="text-lg text-gray-400 line-through ml-2">{{ number_format($product->price) }}₫</span>
                <span class="ml-2 bg-[#ea4335] text-white text-xs font-bold px-2 py-0.5">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
            </div>
            @elseif($product->price)
            <div class="mb-4">
                <span class="text-2xl font-black text-gray-800">{{ number_format($product->price) }}₫</span>
            </div>
            @endif

            {{-- Actions --}}
            <div class="space-y-3">
                <a href="tel:0948490070" class="btn-dark block text-center w-full !py-3">BÁO GIÁ</a>
                <form action="{{ route('cart.add') }}" method="POST" x-data="addToCart()" @submit.prevent="submit($el)">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-primary block w-full !py-3" :disabled="loading">
                        <span x-show="!loading">THÊM VÀO GIỎ HÀNG</span>
                        <span x-show="loading">ĐANG THÊM...</span>
                    </button>
                </form>
            </div>

            {{-- Short description excerpt --}}
            @if($product->description)
            <div class="mt-6 p-4 bg-gray-50 border border-gray-200 text-sm text-gray-600 italic leading-relaxed line-clamp-4">
                {{ strip_tags($product->description) }}
            </div>
            @endif
        </div>

        {{-- Right Sidebar: Related posts / promotions --}}
        <div class="lg:col-span-1">
            <div class="border border-gray-200">
                <div class="sidebar-menu-header">ƯU ĐÃI VÀ KHUYẾN MÃI</div>
                <div class="p-4 space-y-4">
                    @if(isset($relatedProducts) && count($relatedProducts) > 0)
                        @foreach($relatedProducts->take(4) as $related)
                        <div class="flex gap-3 border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                            <div class="w-16 h-16 bg-gray-50 flex-shrink-0 flex items-center justify-center border border-gray-100">
                                @if($related->thumbnail)
                                    <img src="{{ Storage::url($related->thumbnail) }}" alt="" class="max-h-full max-w-full object-contain p-1">
                                @else
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('products.show', $related->slug) }}" class="text-xs font-bold text-gray-700 hover:text-[#ea4335] line-clamp-2 transition">{{ $related->name }}</a>
                                <a href="{{ route('products.show', $related->slug) }}" class="text-[10px] text-[#ea4335] font-semibold mt-1 block hover:underline">Chi tiết</a>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-400 text-center py-4">Đang cập nhật...</p>
                    @endif
                </div>
            </div>

            {{-- Contact Box --}}
            <div class="mt-6 border border-[#ea4335] p-5 text-center">
                <p class="font-bold text-[#1a1a2e] uppercase text-sm mb-2">Cần tư vấn?</p>
                <a href="tel:0948490070" class="text-xl font-black text-[#ea4335] block mb-2">0948 490 070</a>
                <p class="text-xs text-gray-500">Hỗ trợ T2-T7, 8:00 - 17:30</p>
            </div>
        </div>
    </div>

    {{-- Description & Specs Tabs --}}
    <div class="mt-12" x-data="{ tab: 'description' }">
        <div class="flex border-b border-gray-200">
            <button @click="tab = 'description'" :class="tab === 'description' ? 'border-[#ea4335] text-[#ea4335]' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-6 py-3 text-sm font-bold uppercase border-b-2 transition">Mô tả sản phẩm</button>
            <button @click="tab = 'specs'" :class="tab === 'specs' ? 'border-[#ea4335] text-[#ea4335]' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-6 py-3 text-sm font-bold uppercase border-b-2 transition">Thông số kỹ thuật</button>
        </div>
        <div class="py-6">
            <div x-show="tab === 'description'" class="prose max-w-none text-gray-700 text-sm leading-relaxed">
                {!! $product->description !!}
            </div>
            <div x-show="tab === 'specs'">
                @if($product->specifications)
                    @php $specs = is_string($product->specifications) ? json_decode($product->specifications, true) : $product->specifications; @endphp
                    @if(is_array($specs) && count($specs) > 0)
                    <table class="w-full border-collapse text-sm">
                        @foreach($specs as $key => $value)
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-4 font-bold text-gray-700 bg-gray-50 w-1/3">{{ $key }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <p class="text-sm text-gray-400">Đang cập nhật thông số kỹ thuật...</p>
                    @endif
                @else
                <p class="text-sm text-gray-400">Đang cập nhật thông số kỹ thuật...</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
    <section class="mt-12">
        <h2 class="section-heading">Sản Phẩm Liên Quan</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($relatedProducts->take(4) as $rp)
            <div class="product-card-list flex-col">
                <div class="h-36 bg-gray-50 flex items-center justify-center relative">
                    @if($rp->is_new) <span class="badge-new absolute top-0 left-0">NEW</span> @endif
                    @if($rp->thumbnail)
                        <img src="{{ Storage::url($rp->thumbnail) }}" alt="{{ $rp->name }}" class="max-h-full max-w-full object-contain p-3">
                    @else
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    @endif
                </div>
                <div class="p-3">
                    <a href="{{ route('products.show', $rp->slug) }}" class="text-xs font-bold text-[#ea4335] hover:underline line-clamp-2 mb-2 block">{{ $rp->name }}</a>
                    @if($rp->sale_price && $rp->sale_price < $rp->price)
                    <p class="text-sm font-bold text-[#ea4335]">{{ number_format($rp->sale_price) }}₫</p>
                    @elseif($rp->price)
                    <p class="text-sm font-bold text-gray-800">{{ number_format($rp->price) }}₫</p>
                    @else
                    <p class="text-xs font-bold text-[#ea4335]">Liên hệ</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
