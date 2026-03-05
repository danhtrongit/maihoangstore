@extends('layouts.app')
@section('title', $category->meta_title ?: $category->name . ' - Mai Hoàng Store')

@section('content')
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg></a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#ea4335]">Thiết bị</a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">{{ $category->name }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-4 gap-8">
        {{-- Sidebar --}}
        <aside class="lg:col-span-1">
            <div class="border border-gray-200 mb-6">
                <div class="sidebar-menu-header">Danh Mục Sản Phẩm</div>
                @php $sidebarCats = \App\Models\Category::whereNull('parent_id')->where('is_active', true)->orderBy('sort_order')->get(); @endphp
                @foreach($sidebarCats as $cat)
                <a href="{{ route('categories.show', $cat->slug) }}" class="sidebar-menu-item {{ $cat->id == $category->id ? '!bg-red-50 !text-[#ea4335]' : '' }}">
                    <span class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-[#ea4335] rounded-full"></span>
                        {{ $cat->name }}
                    </span>
                    @if($cat->children->count())
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    @endif
                </a>
                @endforeach
            </div>
        </aside>

        <div class="lg:col-span-3">
            <div class="category-bar mb-6">
                <span>{{ $category->name }}</span>
                <span class="text-xs text-gray-500 font-normal normal-case">{{ $products->total() }} sản phẩm</span>
            </div>

            {{-- Subcategories --}}
            @if($category->children->count())
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($category->children as $child)
                <a href="{{ route('categories.show', $child->slug) }}" class="px-4 py-2 text-xs font-semibold uppercase border border-gray-200 hover:border-[#ea4335] hover:text-[#ea4335] transition">{{ $child->name }}</a>
                @endforeach
            </div>
            @endif

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($products as $product)
                <div class="product-card-list flex-col">
                    <div class="relative w-full">
                        @if($product->is_new) <span class="badge-new absolute top-0 left-0 z-10">NEW</span> @endif
                        @if($product->is_hot) <span class="badge-hot absolute top-0 left-0 z-10 {{ $product->is_new ? 'top-6' : '' }}">HOT</span> @endif
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
                        <p class="text-sm font-bold text-[#ea4335] mb-3">{{ number_format($product->sale_price) }}₫</p>
                        @elseif($product->price)
                        <p class="text-sm font-bold text-gray-800 mb-3">{{ number_format($product->price) }}₫</p>
                        @endif
                        <a href="{{ route('products.show', $product->slug) }}" class="btn-dark text-xs !py-1.5">XEM CHI TIẾT</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-500">Chưa có sản phẩm trong danh mục này</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection
