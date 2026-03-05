@extends('layouts.app')
@section('title', $service->meta_title ?? $service->name . ' - Mai Hoàng Store')
@section('content')
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></a>
            <span>/</span><a href="{{ route('services.index') }}" class="hover:text-[#ea4335]">Kỹ thuật</a>
            <span>/</span><span class="text-gray-800 font-medium">{{ $service->name }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <h1 class="text-3xl font-bold text-[#ea4335] mb-6 uppercase">{{ $service->name }}</h1>
            @if($service->short_description)
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">{{ $service->short_description }}</p>
            @endif
            <div class="prose max-w-full">
                {!! $service->content !!}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Other Services -->
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="bg-[#1a1a2e] text-white px-6 py-4">
                    <h3 class="font-bold uppercase">DỊCH VỤ KHÁC</h3>
                </div>
                <div class="divide-y">
                    @foreach($otherServices as $other)
                    <a href="{{ route('services.show', $other) }}" class="block px-6 py-4 hover:bg-gray-50 transition">
                        <span class="font-medium text-[#1a1a2e] hover:text-[#ea4335]">{{ $other->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Contact Box -->
            <div class="border-2 border-[#ea4335] rounded-lg p-6 text-center">
                <h3 class="font-bold text-[#1a1a2e] uppercase mb-2">CẦN TƯ VẤN?</h3>
                <a href="tel:0948490070" class="block text-2xl font-bold text-[#ea4335] mb-2">0948 490 070</a>
                <p class="text-sm text-gray-500">Hỗ trợ T2-T7, 8:00 - 17:30</p>
            </div>
        </div>
    </div>
</div>
@endsection
