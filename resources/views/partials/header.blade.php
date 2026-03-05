{{-- Top Bar - Dark, Hotline style like Delfi --}}
<div class="bg-[#1a1a2e] text-white text-sm">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-10">
        <div class="flex items-center gap-6">
            <a href="tel:0948490070" class="flex items-center gap-1.5 hover:text-[#ea4335] transition">
                <svg class="w-4 h-4 text-[#ea4335]" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                <span class="font-semibold">HOTLINE TƯ VẤN: 0948 490 070</span>
            </a>
            <a href="tel:0973382111" class="hidden md:flex items-center gap-1.5 hover:text-[#ea4335] transition">
                <svg class="w-4 h-4 text-[#ea4335]" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                <span class="font-semibold">HOTLINE BẢO HÀNH: 0973 382 111</span>
            </a>
        </div>
        <div class="hidden md:flex items-center gap-4 text-xs text-gray-300">
            <a href="mailto:info@maihoang.vn" class="hover:text-white transition">info@maihoang.vn</a>
            <span>|</span>
            <span>T2 - T7: 8:00 - 17:30</span>
        </div>
    </div>
</div>

{{-- Main Header --}}
<header class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ mobileMenu: false, searchOpen: false }">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-[70px]">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex-shrink-0">
            <div class="flex items-center gap-2">
                @if(!empty($siteSettings['site_logo']))
                    <img src="{{ Storage::url($siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Mai Hoàng' }}" class="h-10">
                @else
                    <div class="w-10 h-10 bg-[#ea4335] rounded flex items-center justify-center">
                        <span class="text-white font-black text-lg">M</span>
                    </div>
                    <div>
                        <span class="text-xl font-black text-[#1a1a2e] tracking-tight">Mai Hoàng</span>
                        <span class="block text-[10px] uppercase tracking-[0.15em] text-gray-400 font-semibold -mt-0.5">Barcode & POS Solutions</span>
                    </div>
                @endif
            </div>
        </a>

        {{-- Navigation - Desktop - Matching Delfi menu order --}}
        <nav class="hidden xl:flex items-center gap-0.5">
            <a href="{{ route('about') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-gray-700 hover:text-[#ea4335] transition">Giới thiệu</a>

            {{-- Thiết bị dropdown --}}
            <div class="relative group">
                <a href="{{ route('products.index') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-gray-700 hover:text-[#ea4335] transition flex items-center gap-1">
                    Thiết bị
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </a>
                <div class="absolute top-full left-0 w-[600px] bg-white border border-gray-200 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="grid grid-cols-2 gap-0">
                        @php $navCategories = \App\Models\Category::whereNull('parent_id')->where('is_active', true)->orderBy('sort_order')->limit(10)->get(); @endphp
                        @foreach($navCategories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 hover:text-[#ea4335] text-sm font-semibold text-gray-700 border-b border-gray-100 transition">
                            <span class="w-2 h-2 bg-[#ea4335] rounded-full flex-shrink-0"></span>
                            {{ $cat->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Kỹ thuật dropdown --}}
            <div class="relative group">
                <a href="{{ route('services.index') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-gray-700 hover:text-[#ea4335] transition flex items-center gap-1">
                    Kỹ thuật
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </a>
                <div class="absolute top-full left-0 w-[280px] bg-white border border-gray-200 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    @php $navServices = \App\Models\Service::active()->orderBy('sort_order')->get(); @endphp
                    @foreach($navServices as $svc)
                    <a href="{{ route('services.show', $svc) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 hover:text-[#ea4335] text-sm font-semibold text-gray-700 border-b border-gray-100 transition">
                        <span class="w-2 h-2 bg-[#ea4335] rounded-full flex-shrink-0"></span>
                        {{ $svc->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Dự án dropdown --}}
            <div class="relative group">
                <a href="{{ route('projects.index') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-gray-700 hover:text-[#ea4335] transition flex items-center gap-1">
                    Dự án
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </a>
                <div class="absolute top-full left-0 w-[280px] bg-white border border-gray-200 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    @php $navProjCats = \App\Models\ProjectCategory::active()->orderBy('sort_order')->get(); @endphp
                    @foreach($navProjCats as $pc)
                    <a href="{{ route('projects.index', ['category' => $pc->slug]) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 hover:text-[#ea4335] text-sm font-semibold text-gray-700 border-b border-gray-100 transition">
                        <span class="w-2 h-2 bg-[#ea4335] rounded-full flex-shrink-0"></span>
                        {{ $pc->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('dealer.index') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-gray-700 hover:text-[#ea4335] transition">Đăng ký đại lý</a>
            <a href="{{ route('promotions') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-[#ea4335] hover:text-[#c5221f] transition relative">
                Khuyến mãi
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-[#ea4335] rounded-full animate-pulse"></span>
            </a>
            <a href="{{ route('posts.index') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-gray-700 hover:text-[#ea4335] transition">Tin tức</a>
            <a href="{{ route('contact') }}" class="px-3 py-2 text-[13px] font-bold uppercase tracking-wide text-gray-700 hover:text-[#ea4335] transition">Liên hệ</a>
        </nav>

        {{-- Right - Search + Cart --}}
        <div class="flex items-center gap-3">
            {{-- Search --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 text-gray-600 hover:text-[#ea4335] transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                <div x-show="open" x-transition @click.outside="open = false" class="absolute right-0 top-12 w-80 bg-white border border-gray-200 shadow-xl p-3 z-50">
                    <form action="{{ route('products.index') }}" method="GET" class="flex">
                        <input type="text" name="search" placeholder="Tìm sản phẩm..." class="flex-1 px-3 py-2 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]">
                        <button type="submit" class="px-4 py-2 bg-[#ea4335] text-white text-sm font-semibold hover:bg-[#c5221f] transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-[#ea4335] transition" x-data="{ count: {{ count(session('cart', [])) }} }" x-on:cart-updated.window="count = $event.detail.cartCount">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                <span x-show="count > 0" x-text="count" class="absolute -top-1 -right-1 w-5 h-5 bg-[#ea4335] text-white text-[10px] font-bold rounded-full flex items-center justify-center"></span>
            </a>

            {{-- Mobile Toggle --}}
            <button @click="mobileMenu = !mobileMenu" class="xl:hidden p-2 text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenu" x-transition class="xl:hidden border-t border-gray-200 bg-white">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Trang chủ</a>
            <a href="{{ route('about') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Giới thiệu</a>
            <a href="{{ route('products.index') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Thiết bị</a>
            @php $mobileCategories = \App\Models\Category::whereNull('parent_id')->where('is_active', true)->orderBy('sort_order')->limit(8)->get(); @endphp
            @foreach($mobileCategories as $cat)
            <a href="{{ route('categories.show', $cat->slug) }}" class="block py-2 pl-4 text-sm text-gray-500 hover:text-[#ea4335]">• {{ $cat->name }}</a>
            @endforeach
            <a href="{{ route('services.index') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Kỹ thuật</a>
            <a href="{{ route('projects.index') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Dự án</a>
            <a href="{{ route('dealer.index') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Đăng ký đại lý</a>
            <a href="{{ route('promotions') }}" class="block py-2.5 text-sm font-bold uppercase text-[#ea4335]">Khuyến mãi 🔥</a>
            <a href="{{ route('posts.index') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Tin tức</a>
            <a href="{{ route('contact') }}" class="block py-2.5 text-sm font-bold uppercase text-gray-700 hover:text-[#ea4335]">Liên hệ</a>
        </div>
    </div>
</header>
