@extends('layouts.app')
@section('title', 'Liên Hệ - ' . ($siteSettings['site_name'] ?? 'Mai Hoàng Store'))

@section('content')
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg></a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">Liên hệ</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="section-heading">Liên Hệ Với Chúng Tôi</h1>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Contact Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 p-8">
                <h2 class="text-xl font-black text-[#1a1a2e] uppercase mb-6">Gửi yêu cầu tư vấn</h2>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Họ và tên <span class="text-[#ea4335]">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]" required>
                            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Email <span class="text-[#ea4335]">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]" required>
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Số điện thoại <span class="text-[#ea4335]">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]" required>
                            @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Tiêu đề</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-1 block">Nội dung <span class="text-[#ea4335]">*</span></label>
                        <textarea name="message" rows="5" class="w-full px-4 py-2.5 border border-gray-300 text-sm focus:outline-none focus:border-[#ea4335]" required>{{ old('message') }}</textarea>
                        @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="btn-dark">GỬI LIÊN HỆ</button>
                </form>
            </div>
        </div>

        {{-- Contact Info --}}
        <aside>
            <div class="border border-gray-200 mb-6">
                <div class="sidebar-menu-header">Thông Tin Liên Hệ</div>
                <div class="p-5 space-y-5">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#ea4335] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        <div>
                            <p class="text-sm font-bold text-gray-700">Địa chỉ</p>
                            <p class="text-sm text-gray-500">{{ $siteSettings['contact_address'] ?? '123 Nguyễn Thị Minh Khai, Q1, TP.HCM' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#ea4335] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                        <div>
                            <p class="text-sm font-bold text-gray-700">Điện thoại</p>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone'] ?? '0948490070') }}" class="text-sm text-[#ea4335] font-semibold hover:underline">{{ $siteSettings['contact_phone'] ?? '0948 490 070' }}</a>
                            <br>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_hotline'] ?? '0973382111') }}" class="text-sm text-gray-500 hover:text-[#ea4335]">{{ $siteSettings['contact_hotline'] ?? '0973 382 111' }}</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#ea4335] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        <div>
                            <p class="text-sm font-bold text-gray-700">Email</p>
                            <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@maihoang.vn' }}" class="text-sm text-gray-500 hover:text-[#ea4335]">{{ $siteSettings['contact_email'] ?? 'info@maihoang.vn' }}</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#ea4335] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                        <div>
                            <p class="text-sm font-bold text-gray-700">Giờ làm việc</p>
                            <p class="text-sm text-gray-500">T2 - T7: 8:00 - 17:30</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
