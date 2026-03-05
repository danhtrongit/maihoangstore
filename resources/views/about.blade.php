@extends('layouts.app')

@section('title', 'Giới Thiệu - ' . ($siteSettings['site_name'] ?? 'Mai Hoàng Store'))
@section('description', 'Mai Hoàng - Nhà phân phối thiết bị mã vạch & POS hàng đầu Việt Nam. Với hơn 15 năm kinh nghiệm, chúng tôi cung cấp giải pháp toàn diện cho doanh nghiệp.')

@section('content')
<!-- Breadcrumbs -->
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
            </a>
            <span>/</span>
            <span class="text-gray-800 font-medium">Giới thiệu</span>
        </nav>
    </div>
</div>

<!-- Hero About -->
<section class="relative bg-[#1a1a2e] text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-gradient-to-r from-[#ea4335]/20 to-transparent"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 uppercase">Về Mai Hoàng</h1>
            <p class="text-xl text-gray-300 leading-relaxed">
                Công Ty TNHH Mai Hoàng là nhà phân phối thiết bị mã vạch và giải pháp POS hàng đầu Việt Nam.
                Với hơn 15 năm kinh nghiệm, chúng tôi tự hào mang đến các sản phẩm và dịch vụ chất lượng cao nhất cho doanh nghiệp.
            </p>
        </div>
    </div>
</section>

<!-- Stats Counters -->
<section class="bg-white py-12 border-b">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-[#ea4335] mb-2">15+</div>
                <div class="text-gray-600 uppercase text-sm font-semibold">Năm kinh nghiệm</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-[#ea4335] mb-2">500+</div>
                <div class="text-gray-600 uppercase text-sm font-semibold">Dự án triển khai</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-[#ea4335] mb-2">1000+</div>
                <div class="text-gray-600 uppercase text-sm font-semibold">Khách hàng</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-[#ea4335] mb-2">3</div>
                <div class="text-gray-600 uppercase text-sm font-semibold">Văn phòng</div>
            </div>
        </div>
    </div>
</section>

<!-- Company Story -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="section-heading mb-12">
            <h2>CÂU CHUYỆN CỦA CHÚNG TÔI</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="bg-gray-200 rounded-lg h-80 flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#1a1a2e] mb-4">Nhà phân phối thiết bị mã vạch hàng đầu</h3>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Mai Hoàng được thành lập với sứ mệnh mang đến các giải pháp công nghệ mã vạch &
                    POS tiên tiến nhất cho doanh nghiệp Việt Nam. Chúng tôi là nhà phân phối ủy quyền chính thức
                    của các thương hiệu hàng đầu thế giới: Zebra Technologies, Honeywell, PointMobile, Bixolon, SATO.
                </p>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Với đội ngũ chuyên gia giàu kinh nghiệm và trung tâm kỹ thuật hiện đại,
                    chúng tôi cam kết mang đến dịch vụ tốt nhất từ tư vấn, triển khai đến bảo hành, sửa chữa.
                </p>
                <h4 class="font-bold text-[#1a1a2e] mb-3">Giá trị cốt lõi</h4>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-center gap-2"><svg class="w-5 h-5 text-[#ea4335]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Chất lượng sản phẩm chính hãng</li>
                    <li class="flex items-center gap-2"><svg class="w-5 h-5 text-[#ea4335]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Dịch vụ kỹ thuật chuyên nghiệp</li>
                    <li class="flex items-center gap-2"><svg class="w-5 h-5 text-[#ea4335]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Hỗ trợ khách hàng tận tâm</li>
                    <li class="flex items-center gap-2"><svg class="w-5 h-5 text-[#ea4335]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Giải pháp tùy chỉnh cho doanh nghiệp</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Certificates -->
@if($certificates->count())
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="section-heading mb-12">
            <h2>GIẢI THƯỞNG VÀ CHỨNG NHẬN</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($certificates as $cert)
            <div class="bg-gray-50 border rounded-lg p-4 text-center hover:shadow-lg transition">
                <div class="h-40 bg-gray-100 rounded mb-3 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h4 class="text-xs font-bold text-[#1a1a2e] uppercase">{{ $cert->title }}</h4>
                @if($cert->issuer)<p class="text-xs text-gray-500 mt-1">{{ $cert->issuer }}</p>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Clients Grid -->
@if($clients->count())
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="section-heading mb-12">
            <h2>KHÁCH HÀNG TIÊU BIỂU</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($clients as $client)
            <div class="bg-white border rounded-lg p-6 flex items-center justify-center h-28 hover:shadow-lg transition">
                <span class="text-gray-700 font-bold text-lg uppercase">{{ $client->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Offices -->
@if($offices->count())
<section class="py-16 bg-[#1a1a2e] text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="section-heading mb-12">
            <h2 class="!text-white">VĂN PHÒNG & CHI NHÁNH</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($offices as $office)
            <div class="bg-[#2d2d44] rounded-lg overflow-hidden">
                <div class="h-48 bg-[#3a3a55] flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold uppercase mb-3">{{ $office->name }}</h3>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            {{ $office->address }}
                        </p>
                        @if($office->phone)
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            <a href="tel:{{ $office->phone }}" class="text-[#ea4335] hover:underline">{{ $office->phone }}</a>
                        </p>
                        @endif
                        @if($office->map_url)
                        <a href="{{ $office->map_url }}" target="_blank" class="inline-flex items-center gap-1 text-[#ea4335] hover:underline mt-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"/></svg>
                            Xem bản đồ
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
