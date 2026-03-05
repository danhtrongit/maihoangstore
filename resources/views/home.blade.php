@extends('layouts.app')
@section('title', 'Mai Hoàng Store - Thiết Bị Mã Vạch & POS Hàng Đầu Việt Nam')

@section('content')
{{-- Hero Banner Slider - Delfi style full width --}}
<section class="relative bg-[#f5f0ea] overflow-hidden" x-data="{ slide: 0, total: {{ count($banners) > 0 ? count($banners) : 3 }} }" x-init="setInterval(() => slide = (slide + 1) % total, 5000)">
    <div class="relative min-h-[420px] md:min-h-[480px]">
        @if(count($banners) > 0)
            @foreach($banners as $i => $banner)
            <div x-show="slide === {{ $i }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
            </div>
            @endforeach
        @else
            {{-- Default banner --}}
            <div x-show="slide === 0" x-transition class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-4 w-full grid md:grid-cols-2 items-center gap-8">
                    <div>
                        <div class="inline-block px-4 py-1 bg-[#ea4335] text-white text-xs font-bold uppercase tracking-wider mb-4">Sản phẩm nổi bật</div>
                        <h2 class="text-4xl md:text-5xl font-black text-[#1a1a2e] leading-tight mb-4">Máy Kiểm Kho PDA<br>Chính Hãng</h2>
                        <p class="text-gray-600 mb-6">Thiết bị tích hợp sẵn phần mềm kiểm kho • Luôn sẵn máy • Dễ dàng sử dụng</p>
                        <a href="{{ route('products.index') }}" class="btn-primary">Xem sản phẩm →</a>
                    </div>
                    <div class="hidden md:flex justify-center">
                        <div class="w-80 h-80 bg-white/50 rounded-full flex items-center justify-center">
                            <svg class="w-40 h-40 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="slide === 1" x-transition class="absolute inset-0 flex items-center bg-gradient-to-r from-[#1a1a2e] to-[#2d2d44]">
                <div class="max-w-7xl mx-auto px-4 w-full">
                    <div class="max-w-xl">
                        <div class="inline-block px-4 py-1 bg-[#ea4335] text-white text-xs font-bold uppercase tracking-wider mb-4">Khuyến mãi</div>
                        <h2 class="text-4xl md:text-5xl font-black text-white leading-tight mb-4">Máy In Mã Vạch<br>Giảm Đến 20%</h2>
                        <p class="text-gray-300 mb-6">Dòng máy in đa dạng từ để bàn đến công nghiệp, phù hợp mọi nhu cầu.</p>
                        <a href="{{ route('products.index') }}" class="btn-primary">Xem ngay →</a>
                    </div>
                </div>
            </div>
            <div x-show="slide === 2" x-transition class="absolute inset-0 flex items-center bg-[#f5f0ea]">
                <div class="max-w-7xl mx-auto px-4 w-full grid md:grid-cols-2 items-center gap-8">
                    <div>
                        <div class="inline-block px-4 py-1 bg-[#ea4335] text-white text-xs font-bold uppercase tracking-wider mb-4">Giải pháp</div>
                        <h2 class="text-4xl md:text-5xl font-black text-[#1a1a2e] leading-tight mb-4">Giải Pháp Quản Lý<br>Kho Thông Minh</h2>
                        <p class="text-gray-600 mb-6">Tối ưu hóa quy trình kiểm kho với công nghệ hiện đại nhất.</p>
                        <a href="{{ route('contact') }}" class="btn-primary">Tư vấn miễn phí →</a>
                    </div>
                    <div class="hidden md:flex justify-center">
                        <div class="w-80 h-80 bg-white/50 rounded-full flex items-center justify-center">
                            <svg class="w-40 h-40 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- Slider arrows & dots --}}
    <button @click="slide = (slide - 1 + total) % total" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 hover:bg-white rounded-full flex items-center justify-center shadow transition z-10">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="slide = (slide + 1) % total" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 hover:bg-white rounded-full flex items-center justify-center shadow transition z-10">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
        <template x-for="i in total" :key="i">
            <button @click="slide = i - 1" :class="slide === i - 1 ? 'bg-[#ea4335] w-6' : 'bg-gray-400 w-2'" class="h-2 rounded-full transition-all"></button>
        </template>
    </div>
</section>

{{-- USP Bar - checkmarks like Delfi --}}
<section class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center gap-2 text-sm">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                <span class="font-semibold text-[#ea4335]">Thiết bị tích hợp sẵn phần mềm</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                <span class="font-semibold text-[#ea4335]">Luôn sẵn máy</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                <span class="font-semibold text-[#ea4335]">Dễ dàng sử dụng</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                <span class="font-semibold text-[#ea4335]">Kiểm kê ngay</span>
            </div>
        </div>
    </div>
</section>

{{-- Partner Logos - Delfi style scrolling --}}
@if(isset($brands) && count($brands) > 0)
<section class="bg-white py-4 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center gap-6 overflow-x-auto scrollbar-hide py-2">
            <span class="text-xs text-gray-400 font-semibold whitespace-nowrap flex-shrink-0">Đối tác của Mai Hoàng:</span>
            @foreach($brands as $brand)
            <div class="flex-shrink-0 px-3 grayscale hover:grayscale-0 transition opacity-60 hover:opacity-100">
                @if($brand->logo)
                    <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="h-8 object-contain">
                @else
                    <span class="text-sm font-bold text-gray-400 uppercase">{{ $brand->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- About Section - Delfi style --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-2xl md:text-3xl font-black text-[#ea4335] mb-4">Mai Hoàng Store - Giải pháp và thiết bị mã vạch</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                Mai Hoàng là đơn vị chuyên cung cấp các thiết bị Máy kiểm kho, Máy in mã vạch, Máy quét mã vạch, Máy POS bán hàng và giải pháp phần mềm Kiểm kho chính hãng tại Việt Nam.
            </p>
            <p class="text-gray-600 leading-relaxed mb-6">
                Với hơn 10 năm kinh nghiệm, Mai Hoàng đã phục vụ hơn 5000+ doanh nghiệp trên toàn quốc, mang đến giải pháp quản lý kho hàng tối ưu và hiệu quả.
            </p>
            <a href="{{ route('contact') }}" class="btn-dark">Tìm hiểu thêm →</a>
        </div>
        <div class="bg-gray-100 rounded-lg h-72 flex items-center justify-center">
            <div class="text-center">
                <div class="w-20 h-20 bg-[#ea4335]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <p class="text-gray-400 text-sm font-medium">Mai Hoàng Office</p>
            </div>
        </div>
    </div>
</section>

{{-- Category Grid - Delfi style with images --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="section-heading">Các Thiết Bị Mã Vạch</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="block bg-[#f1f1f1] hover:shadow-lg transition group text-center p-6">
                <div class="h-40 flex items-center justify-center mb-4">
                    @if($category->image)
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition">
                    @else
                        <svg class="w-16 h-16 text-gray-300 group-hover:text-[#ea4335] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    @endif
                </div>
                <h3 class="font-bold text-sm uppercase text-gray-700 group-hover:text-[#ea4335] transition tracking-wide">{{ $category->name }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Featured Products - Delfi list style --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="section-heading">Sản Phẩm Nổi Bật</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProducts as $product)
            <div class="product-card-list">
                <div class="w-32 flex-shrink-0 relative">
                    @if($product->is_new) <span class="badge-new absolute top-0 left-0 z-10">NEW</span> @endif
                    @if($product->is_hot) <span class="badge-hot absolute top-0 left-0 z-10">HOT</span> @endif
                    <div class="h-32 bg-gray-50 flex items-center justify-center">
                        @if($product->thumbnail)
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain p-2">
                        @else
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        @endif
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{ route('products.show', $product->slug) }}" class="text-sm font-bold text-[#ea4335] hover:underline line-clamp-2 mb-2">{{ $product->name }}</a>
                    @if($product->short_description)
                    <p class="text-xs text-gray-500 line-clamp-3 mb-3"><strong>Đặc Điểm:</strong> {{ $product->short_description }}</p>
                    @endif
                    @if($product->sale_price && $product->sale_price < $product->price)
                    <p class="text-sm font-bold text-[#ea4335] mb-2">{{ number_format($product->sale_price) }}₫ <span class="text-gray-400 line-through text-xs font-normal ml-1">{{ number_format($product->price) }}₫</span></p>
                    @elseif($product->price)
                    <p class="text-sm font-bold text-gray-800 mb-2">{{ number_format($product->price) }}₫</p>
                    @else
                    <p class="text-sm font-bold text-[#ea4335] mb-2">Liên hệ báo giá</p>
                    @endif
                    <a href="{{ route('products.show', $product->slug) }}" class="btn-dark text-xs !py-1.5 !px-4">XEM CHI TIẾT</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('products.index') }}" class="btn-primary">Xem tất cả sản phẩm →</a>
        </div>
    </div>
</section>

{{-- Trusted By - Delfi style logos grid --}}
@if(isset($brands) && count($brands) > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="section-heading">Đối Tác Chiến Lược</h2>
        <div class="grid grid-cols-3 md:grid-cols-5 gap-4">
            @foreach($brands as $brand)
            <div class="bg-white border border-gray-200 p-6 flex items-center justify-center h-24 hover:border-[#ea4335] transition">
                @if($brand->logo)
                    <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="max-h-12 max-w-full object-contain">
                @else
                    <span class="text-sm font-bold text-gray-400 uppercase">{{ $brand->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- KHÁCH HÀNG TIÊU BIỂU - Delfi style --}}
@if(isset($clients) && count($clients) > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="section-heading">Khách Hàng Tiêu Biểu</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($clients as $client)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 flex items-center justify-center h-28 hover:shadow-lg hover:border-[#ea4335] transition">
                @if($client->logo && $client->logo !== 'clients/placeholder.png')
                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}" class="max-h-12 max-w-full object-contain">
                @else
                    <span class="text-gray-700 font-bold text-sm uppercase text-center">{{ $client->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- GIẢI THƯỞNG VÀ CHỨNG NHẬN - Delfi style --}}
@if(isset($certificates) && count($certificates) > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="section-heading">Giải Thưởng & Chứng Nhận</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($certificates as $cert)
            <div class="bg-white border rounded-lg p-4 text-center hover:shadow-lg hover:border-[#ea4335] transition">
                <div class="h-36 bg-gray-50 rounded mb-3 flex items-center justify-center">
                    @if($cert->image && $cert->image !== 'certificates/placeholder.jpg')
                        <img src="{{ Storage::url($cert->image) }}" alt="{{ $cert->title }}" class="max-h-full max-w-full object-contain p-2">
                    @else
                        <svg class="w-14 h-14 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    @endif
                </div>
                <h4 class="text-xs font-bold text-[#1a1a2e] uppercase leading-tight">{{ $cert->title }}</h4>
                @if($cert->issuer)<p class="text-[10px] text-gray-500 mt-1">{{ $cert->issuer }}</p>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Services Preview - Delfi style --}}
@if(isset($services) && count($services) > 0)
<section class="py-16 bg-[#1a1a2e] text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-black uppercase mb-3">DỊCH VỤ KỸ THUẬT</h2>
            <div class="w-12 h-1 bg-[#ea4335] mx-auto"></div>
            <p class="text-gray-400 mt-4">Đội ngũ kỹ thuật chuyên nghiệp, hỗ trợ nhanh chóng</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $svc)
            <a href="{{ route('services.show', $svc) }}" class="bg-[#2d2d44] rounded-lg p-6 text-center hover:bg-[#3a3a55] transition group">
                <div class="w-14 h-14 bg-[#ea4335]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#ea4335] transition">
                    <svg class="w-7 h-7 text-[#ea4335] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($svc->icon == 'shield-check')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        @elseif($svc->icon == 'wrench')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        @elseif($svc->icon == 'calendar')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        @endif
                    </svg>
                </div>
                <h3 class="font-bold uppercase text-sm mb-2">{{ $svc->name }}</h3>
                <p class="text-xs text-gray-400 line-clamp-2">{{ Str::limit($svc->short_description, 80) }}</p>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('services.index') }}" class="inline-block border-2 border-white text-white px-8 py-3 font-bold uppercase text-sm hover:bg-white hover:text-[#1a1a2e] transition">Xem Tất Cả Dịch Vụ →</a>
        </div>
    </div>
</section>
@endif

{{-- Contact/Consultation Form - Delfi style --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-2xl font-black text-[#1a1a2e] uppercase mb-2">Tư Vấn Cho Tôi</h2>
                <p class="text-gray-500 mb-6">Hiện đang phục vụ các doanh nghiệp trên toàn quốc.</p>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-gray-700 flex items-center gap-1 mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Họ và tên <span class="text-[#ea4335]">(*)</span>
                        </label>
                        <input type="text" name="name" placeholder="Nhập họ và tên" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 flex items-center gap-1 mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Số điện thoại <span class="text-[#ea4335]">(*)</span>
                        </label>
                        <input type="tel" name="phone" placeholder="Nhập số điện thoại" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-1 block">Nội dung</label>
                        <textarea name="message" rows="3" placeholder="Bạn cần tư vấn gì?" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]"></textarea>
                    </div>
                    <button type="submit" class="btn-dark">NHẬN TƯ VẤN</button>
                </form>
            </div>
            <div class="hidden md:block bg-gray-100 rounded-lg h-80 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center text-gray-300">
                        <svg class="w-24 h-24 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm">Phục vụ toàn quốc</p>
                    </div>
                </div>
                <div class="absolute top-8 right-12 text-[#ea4335] text-xs font-bold">HÀ NỘI</div>
                <div class="absolute bottom-20 left-12 text-[#ea4335] text-xs font-bold">ĐÀ NẴNG</div>
                <div class="absolute bottom-8 right-16 text-[#ea4335] text-xs font-bold">TP. HỒ CHÍ MINH</div>
            </div>
        </div>
    </div>
</section>

{{-- TIN TỨC + DỰ ÁN - Delfi dual column style --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Tin tức --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-[#1a1a2e] uppercase flex items-center gap-2">
                        <span class="w-1 h-6 bg-[#ea4335]"></span> TIN TỨC MỚI
                    </h2>
                    <a href="{{ route('posts.index') }}" class="text-[#ea4335] text-sm font-bold hover:underline">Xem tất cả →</a>
                </div>
                @if(isset($latestPosts) && count($latestPosts) > 0)
                <div class="space-y-4">
                    @foreach($latestPosts->take(3) as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="flex gap-4 bg-white border rounded-lg p-4 hover:shadow-md hover:border-[#ea4335] transition group">
                        <div class="w-28 h-20 bg-gray-100 rounded flex-shrink-0 overflow-hidden">
                            @if($post->thumbnail)
                                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                            @else
                                <div class="w-full h-full flex items-center justify-center"><svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg></div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-800 group-hover:text-[#ea4335] transition line-clamp-2 mb-1">{{ $post->title }}</h3>
                            <p class="text-xs text-gray-400">{{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Dự án --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-[#1a1a2e] uppercase flex items-center gap-2">
                        <span class="w-1 h-6 bg-[#ea4335]"></span> DỰ ÁN TIÊU BIỂU
                    </h2>
                    <a href="{{ route('projects.index') }}" class="text-[#ea4335] text-sm font-bold hover:underline">Xem tất cả →</a>
                </div>
                @if(isset($featuredProjects) && count($featuredProjects) > 0)
                <div class="space-y-4">
                    @foreach($featuredProjects->take(3) as $project)
                    <a href="{{ route('projects.show', $project) }}" class="flex gap-4 bg-white border rounded-lg p-4 hover:shadow-md hover:border-[#ea4335] transition group">
                        <div class="w-28 h-20 bg-gray-100 rounded flex-shrink-0 overflow-hidden flex items-center justify-center">
                            @if($project->thumbnail)
                                <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                            @else
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-800 group-hover:text-[#ea4335] transition line-clamp-2 mb-1">{{ $project->title }}</h3>
                            <div class="flex items-center gap-3 text-xs text-gray-400">
                                @if($project->client_name)<span>{{ $project->client_name }}</span>@endif
                                @if($project->location)<span>📍 {{ $project->location }}</span>@endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

