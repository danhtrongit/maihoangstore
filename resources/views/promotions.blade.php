@extends('layouts.app')
@section('title', 'Khuyến Mãi - ' . ($siteSettings['site_name'] ?? 'Mai Hoàng Store'))
@section('content')
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></a>
            <span>/</span><span class="text-gray-800 font-medium">Khuyến mãi</span>
        </nav>
    </div>
</div>

<!-- Hero Banner -->
<section class="bg-gradient-to-r from-[#ea4335] to-[#c5221f] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-3 uppercase">🔥 Khuyến Mãi Hot</h1>
        <p class="text-xl opacity-90">Ưu đãi đặc biệt cho thiết bị mã vạch & POS</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div>
            <div class="bg-white border rounded-lg overflow-hidden sticky top-24">
                <div class="bg-[#1a1a2e] text-white px-6 py-4">
                    <h3 class="font-bold uppercase">DANH MỤC SẢN PHẨM</h3>
                </div>
                <div class="divide-y">
                    @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="sidebar-menu-item block px-6 py-3 hover:bg-gray-50 transition text-[#1a1a2e]">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                            {{ $category->name }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            <div class="flex items-center justify-between mb-8">
                <div class="bg-white border-l-4 border-[#ea4335] px-4 py-2">
                    <h2 class="text-xl font-bold text-[#1a1a2e] uppercase">SẢN PHẨM KHUYẾN MÃI</h2>
                </div>
                <span class="text-sm text-gray-500">{{ $products->total() }} sản phẩm</span>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition group">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <div class="h-48 bg-gray-100 flex items-center justify-center relative">
                            @if($product->thumbnail)
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4">
                            @else
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @endif
                            @if($product->discount_percent)
                            <span class="absolute top-3 right-3 badge-sale">-{{ $product->discount_percent }}%</span>
                            @endif
                        </div>
                    </a>
                    <div class="p-5">
                        <a href="{{ route('products.show', $product) }}" class="font-bold text-[#ea4335] group-hover:underline line-clamp-2 mb-2">{{ $product->name }}</a>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-[#ea4335]">{{ $product->formatted_sale_price }}</span>
                            <span class="text-sm text-gray-400 line-through">{{ $product->formatted_price }}</span>
                        </div>
                        <a href="{{ route('products.show', $product) }}" class="btn-dark mt-3 block text-center text-sm">XEM CHI TIẾT</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>Hiện chưa có sản phẩm khuyến mãi.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection
