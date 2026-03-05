{{-- Footer - Delfi style dark --}}
<footer class="bg-[#1a1a2e] text-gray-300 mt-16">
    {{-- Main Footer --}}
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Company Info --}}
            <div>
                <div class="flex items-center gap-2 mb-5">
                    @if(!empty($siteSettings['site_logo']))
                        <img src="{{ Storage::url($siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Mai Hoàng' }}" class="h-10 brightness-0 invert">
                    @else
                        <div class="w-10 h-10 bg-[#ea4335] rounded flex items-center justify-center">
                            <span class="text-white font-black text-lg">M</span>
                        </div>
                        <div>
                            <span class="text-lg font-black text-white tracking-tight">{{ $siteSettings['site_name'] ?? 'Mai Hoàng' }}</span>
                            <span class="block text-[10px] uppercase tracking-[0.15em] text-gray-400 font-semibold -mt-0.5">Barcode & POS Solutions</span>
                        </div>
                    @endif
                </div>
                <p class="text-sm leading-relaxed text-gray-400 mb-4">
                    Chuyên cung cấp thiết bị mã vạch, máy POS bán hàng, giải pháp quản lý kho chính hãng tại Việt Nam.
                </p>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-[#ea4335] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        <span class="text-gray-400">{{ $siteSettings['contact_address'] ?? '123 Nguyễn Thị Minh Khai, Q1, TP.HCM' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#ea4335] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone'] ?? '0948490070') }}" class="text-gray-400 hover:text-white transition">{{ $siteSettings['contact_phone'] ?? '0948 490 070' }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#ea4335] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@maihoang.vn' }}" class="text-gray-400 hover:text-white transition">{{ $siteSettings['contact_email'] ?? 'info@maihoang.vn' }}</a>
                    </div>
                </div>
            </div>

            {{-- Product Categories --}}
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-5">Danh mục sản phẩm</h4>
                <ul class="space-y-2.5">
                    @php $footerCategories = \App\Models\Category::whereNull('parent_id')->where('is_active', true)->orderBy('sort_order')->limit(8)->get(); @endphp
                    @foreach($footerCategories as $cat)
                    <li>
                        <a href="{{ route('categories.show', $cat->slug) }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition flex items-center gap-2">
                            <span class="w-1 h-1 bg-[#ea4335] rounded-full"></span>
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Policies --}}
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-5">Chính sách</h4>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Giới thiệu {{ $siteSettings['site_name'] ?? 'Mai Hoàng' }}</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Dịch vụ kỹ thuật</a></li>
                    <li><a href="{{ route('projects.index') }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Dự án tiêu biểu</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Chính sách bảo hành</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Chính sách đổi trả</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Hướng dẫn mua hàng</a></li>
                </ul>
            </div>

            {{-- Support & Social --}}
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-5">Hỗ trợ khách hàng</h4>
                <ul class="space-y-2.5 mb-6">
                    <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Liên hệ tư vấn</a></li>
                    <li><a href="{{ route('posts.index') }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Tin tức & Hướng dẫn</a></li>
                    <li><a href="{{ route('dealer.index') }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Đăng ký đại lý</a></li>
                    <li><a href="{{ route('promotions') }}" class="text-sm text-gray-400 hover:text-[#ea4335] transition">Khuyến mãi</a></li>
                </ul>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-3">Kết nối</h4>
                <div class="flex items-center gap-3">
                    <a href="{{ $siteSettings['social_facebook'] ?? '#' }}" target="_blank" class="w-9 h-9 bg-[#2d2d44] hover:bg-[#ea4335] transition rounded flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ $siteSettings['social_youtube'] ?? '#' }}" target="_blank" class="w-9 h-9 bg-[#2d2d44] hover:bg-[#ea4335] transition rounded flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="https://zalo.me/{{ $siteSettings['social_zalo'] ?? '' }}" target="_blank" class="w-9 h-9 bg-[#2d2d44] hover:bg-[#ea4335] transition rounded flex items-center justify-center">
                        <span class="text-white text-xs font-bold">Zalo</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Offices --}}
    @php $footerOffices = \App\Models\Office::active()->orderBy('sort_order')->get(); @endphp
    @if($footerOffices->count())
    <div class="border-t border-[#2d2d44]">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-6 text-center">Văn Phòng & Chi Nhánh</h4>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($footerOffices as $office)
                <div class="text-center">
                    <h5 class="text-white font-bold text-sm mb-2">{{ $office->name }}</h5>
                    <p class="text-gray-400 text-xs mb-1">{{ $office->address }}</p>
                    @if($office->phone)<p class="text-xs"><a href="tel:{{ $office->phone }}" class="text-[#ea4335] font-bold">{{ $office->phone }}</a></p>@endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Bottom Bar --}}
    <div class="border-t border-[#2d2d44]">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-500">© {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Mai Hoàng Store' }}. All rights reserved.</p>
            <div class="flex items-center gap-4 text-xs text-gray-500">
                <span>Hỗ trợ thanh toán:</span>
                <span class="px-3 py-1 border border-gray-600 text-gray-400 font-bold text-[10px]">COD</span>
                <span class="px-3 py-1 border border-gray-600 text-gray-400 font-bold text-[10px]">BANK</span>
                <span class="px-3 py-1 border border-gray-600 text-gray-400 font-bold text-[10px]">MOMO</span>
            </div>
        </div>
    </div>
</footer>

{{-- Floating Buttons --}}
<div class="fixed bottom-6 right-6 flex flex-col gap-3 z-50">
    <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone'] ?? '0948490070') }}" class="w-12 h-12 bg-[#ea4335] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition animate-pulse">
        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
    </a>
    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center shadow-lg hover:bg-[#ea4335] transition opacity-0 invisible" aria-label="Back to top">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
    </button>
</div>
