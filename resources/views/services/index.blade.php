@extends('layouts.app')
@section('title', 'Dịch Vụ Kỹ Thuật - ' . ($siteSettings['site_name'] ?? 'Mai Hoàng Store'))
@section('content')
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></a>
            <span>/</span><span class="text-gray-800 font-medium">Kỹ thuật</span>
        </nav>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="section-heading mb-12"><h2>DỊCH VỤ KỸ THUẬT</h2></div>
        <p class="text-center text-gray-600 max-w-3xl mx-auto mb-12">
            Mai Hoàng cung cấp đầy đủ dịch vụ kỹ thuật chuyên nghiệp cho thiết bị mã vạch & POS.
            Đội ngũ kỹ thuật viên được đào tạo trực tiếp từ hãng, sẵn sàng hỗ trợ bạn.
        </p>

        <div class="grid md:grid-cols-2 gap-8">
            @foreach($services as $service)
            <a href="{{ route('services.show', $service) }}" class="bg-white border rounded-lg p-8 hover:shadow-xl transition group">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 bg-[#ea4335]/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-[#ea4335] transition">
                        <svg class="w-8 h-8 text-[#ea4335] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($service->icon == 'shield-check')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            @elseif($service->icon == 'wrench')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            @elseif($service->icon == 'calendar')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            @endif
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#1a1a2e] mb-3 group-hover:text-[#ea4335] transition uppercase">{{ $service->name }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $service->short_description }}</p>
                        <span class="inline-flex items-center gap-1 text-[#ea4335] font-semibold mt-4 text-sm uppercase">
                            Xem chi tiết
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-[#1a1a2e] text-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-4 uppercase">Cần Hỗ Trợ Kỹ Thuật?</h2>
        <p class="text-gray-300 mb-8">Liên hệ ngay để được tư vấn và hỗ trợ kỹ thuật nhanh nhất</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone'] ?? '0948490070') }}" class="bg-[#ea4335] hover:bg-[#c5221f] text-white px-8 py-4 rounded font-bold uppercase transition">
                📞 {{ $siteSettings['contact_phone'] ?? '0948 490 070' }}
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-[#1a1a2e] px-8 py-4 rounded font-bold uppercase transition">
                Gửi Yêu Cầu
            </a>
        </div>
    </div>
</section>
@endsection
