@extends('layouts.app')
@section('title', 'Đăng Ký Đại Lý - Mai Hoàng Store')
@section('content')
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></a>
            <span>/</span><span class="text-gray-800 font-medium">Đăng ký đại lý</span>
        </nav>
    </div>
</div>

<!-- Hero -->
<section class="bg-[#1a1a2e] text-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4 uppercase">Đăng Ký Đại Lý</h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            Trở thành đối tác phân phối của Mai Hoàng. Nhận ưu đãi đặc biệt về giá, hỗ trợ marketing và đào tạo kỹ thuật.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Benefits -->
    <div class="grid md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white border rounded-lg p-6 text-center">
            <div class="w-12 h-12 bg-[#ea4335]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="font-bold text-[#1a1a2e] mb-2">Giá Đại Lý Đặc Biệt</h3>
            <p class="text-sm text-gray-500">Chiết khấu hấp dẫn cho đại lý chính thức</p>
        </div>
        <div class="bg-white border rounded-lg p-6 text-center">
            <div class="w-12 h-12 bg-[#ea4335]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            </div>
            <h3 class="font-bold text-[#1a1a2e] mb-2">Đào Tạo Kỹ Thuật</h3>
            <p class="text-sm text-gray-500">Được đào tạo kỹ thuật chuyên sâu từ hãng</p>
        </div>
        <div class="bg-white border rounded-lg p-6 text-center">
            <div class="w-12 h-12 bg-[#ea4335]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <h3 class="font-bold text-[#1a1a2e] mb-2">Hỗ Trợ Marketing</h3>
            <p class="text-sm text-gray-500">Tài liệu marketing và hỗ trợ truyền thông</p>
        </div>
        <div class="bg-white border rounded-lg p-6 text-center">
            <div class="w-12 h-12 bg-[#ea4335]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-bold text-[#1a1a2e] mb-2">Hỗ Trợ Bán Hàng</h3>
            <p class="text-sm text-gray-500">Đội ngũ sales hỗ trợ đại lý bán hàng</p>
        </div>
    </div>

    <!-- Form -->
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white border rounded-lg p-8">
                <h2 class="text-2xl font-bold text-[#1a1a2e] mb-6 uppercase">Đăng Ký Trở Thành Đại Lý</h2>

                @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('dealer.store') }}" method="POST">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tên công ty <span class="text-red-500">*</span></label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" required class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">
                            @error('company_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Người liên hệ <span class="text-red-500">*</span></label>
                            <input type="text" name="contact_person" value="{{ old('contact_person') }}" required class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">
                            @error('contact_person')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">
                            @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Thành phố</label>
                            <input type="text" name="city" value="{{ old('city') }}" class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sản phẩm quan tâm</label>
                        <textarea name="products_interested" rows="3" class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">{{ old('products_interested') }}</textarea>
                    </div>
                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ghi chú thêm</label>
                        <textarea name="message" rows="3" class="w-full border rounded-lg px-4 py-3 focus:border-[#ea4335] focus:ring-1 focus:ring-[#ea4335] outline-none">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="mt-6 w-full bg-[#1a1a2e] hover:bg-[#ea4335] text-white font-bold py-4 rounded-lg uppercase transition">
                        Gửi Đăng Ký
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="bg-[#1a1a2e] text-white px-6 py-4">
                    <h3 class="font-bold uppercase">LIÊN HỆ NHANH</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#ea4335] mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                        <div>
                            <p class="font-bold text-[#1a1a2e]">Hotline Đại Lý</p>
                            <a href="tel:0948490070" class="text-[#ea4335] font-bold text-lg">0948 490 070</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#ea4335] mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                        <div>
                            <p class="font-bold text-[#1a1a2e]">Email</p>
                            <a href="mailto:dealer@maihoang.vn" class="text-gray-600">dealer@maihoang.vn</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#ea4335] mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        <div>
                            <p class="font-bold text-[#1a1a2e]">Giờ làm việc</p>
                            <p class="text-gray-600">T2 - T7: 8:00 - 17:30</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
