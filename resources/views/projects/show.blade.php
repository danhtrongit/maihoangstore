@extends('layouts.app')
@section('title', ($project->meta_title ?? $project->title) . ' - Mai Hoàng Store')
@section('content')
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></a>
            <span>/</span><a href="{{ route('projects.index') }}" class="hover:text-[#ea4335]">Dự án</a>
            @if($project->projectCategory)<span>/</span><a href="{{ route('projects.index', ['category' => $project->projectCategory->slug]) }}" class="hover:text-[#ea4335]">{{ $project->projectCategory->name }}</a>@endif
            <span>/</span><span class="text-gray-800 font-medium line-clamp-1">{{ $project->title }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <h1 class="text-3xl font-bold text-[#ea4335] mb-4">{{ $project->title }}</h1>

            <div class="flex flex-wrap gap-4 mb-8 text-sm text-gray-500">
                @if($project->projectCategory)
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/></svg>
                    {{ $project->projectCategory->name }}
                </span>
                @endif
                @if($project->client_name)
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2H4a1 1 0 110-2V4z" clip-rule="evenodd"/></svg>
                    {{ $project->client_name }}
                </span>
                @endif
                @if($project->location)
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    {{ $project->location }}
                </span>
                @endif
            </div>

            @if($project->thumbnail)
            <div class="mb-8 rounded-lg overflow-hidden">
                <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-full">
            </div>
            @endif

            @if($project->short_description)
            <div class="bg-gray-50 border-l-4 border-[#ea4335] p-6 mb-8 rounded-r-lg">
                <p class="text-gray-700 leading-relaxed">{{ $project->short_description }}</p>
            </div>
            @endif

            <div class="prose max-w-full">
                {!! $project->content !!}
            </div>

            @if($project->images && count($project->images))
            <div class="mt-8">
                <h3 class="text-xl font-bold text-[#1a1a2e] mb-4 uppercase">Hình Ảnh Dự Án</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($project->images as $image)
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($image) }}" class="w-full h-48 object-cover hover:scale-105 transition">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            @if($relatedProjects->count())
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="bg-[#1a1a2e] text-white px-6 py-4">
                    <h3 class="font-bold uppercase">DỰ ÁN LIÊN QUAN</h3>
                </div>
                <div class="divide-y">
                    @foreach($relatedProjects as $related)
                    <a href="{{ route('projects.show', $related) }}" class="flex items-center gap-4 p-4 hover:bg-gray-50 transition">
                        <div class="w-16 h-16 bg-gray-100 rounded flex-shrink-0 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#1a1a2e] line-clamp-2">{{ $related->title }}</h4>
                            <span class="text-xs text-[#ea4335]">Chi tiết</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="border-2 border-[#ea4335] rounded-lg p-6 text-center">
                <h3 class="font-bold text-[#1a1a2e] uppercase mb-2">CẦN TƯ VẤN?</h3>
                <a href="tel:0948490070" class="block text-2xl font-bold text-[#ea4335] mb-2">0948 490 070</a>
                <p class="text-sm text-gray-500">Hỗ trợ T2-T7, 8:00 - 17:30</p>
            </div>
        </div>
    </div>
</div>
@endsection
