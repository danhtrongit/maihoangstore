@extends('layouts.app')
@section('title', 'Dự Án Tiêu Biểu - Mai Hoàng Store')
@section('content')
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></a>
            <span>/</span><span class="text-gray-800 font-medium">Dự án</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div>
            <div class="bg-white border rounded-lg overflow-hidden sticky top-24">
                <div class="bg-[#1a1a2e] text-white px-6 py-4">
                    <h3 class="font-bold uppercase">DANH MỤC DỰ ÁN</h3>
                </div>
                <div class="divide-y">
                    <a href="{{ route('projects.index') }}"
                       class="block px-6 py-3 hover:bg-gray-50 transition {{ !$category ? 'text-[#ea4335] font-bold bg-red-50' : 'text-[#1a1a2e]' }}">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ !$category ? 'bg-[#ea4335]' : 'bg-gray-300' }}"></span>
                            Tất cả dự án
                        </span>
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('projects.index', ['category' => $cat->slug]) }}"
                       class="block px-6 py-3 hover:bg-gray-50 transition {{ $category == $cat->slug ? 'text-[#ea4335] font-bold bg-red-50' : 'text-[#1a1a2e]' }}">
                        <span class="flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ $category == $cat->slug ? 'bg-[#ea4335]' : 'bg-gray-300' }}"></span>
                                {{ $cat->name }}
                            </span>
                            <span class="text-xs text-gray-400">({{ $cat->projects_count }})</span>
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="lg:col-span-3">
            <div class="flex items-center justify-between mb-8">
                <div class="bg-white border-l-4 border-[#ea4335] px-4 py-2">
                    <h1 class="text-xl font-bold text-[#1a1a2e] uppercase">DỰ ÁN TIÊU BIỂU</h1>
                </div>
                <span class="text-sm text-gray-500">{{ $projects->total() }} dự án</span>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition group">
                    <div class="h-48 bg-gray-100 flex items-center justify-center relative">
                        @if($project->thumbnail)
                        <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                        @else
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        @endif
                        @if($project->is_featured)
                        <span class="absolute top-3 left-3 bg-[#ea4335] text-white text-xs px-2 py-1 rounded font-bold">NỔI BẬT</span>
                        @endif
                    </div>
                    <div class="p-5">
                        @if($project->projectCategory)
                        <span class="text-xs text-[#ea4335] font-semibold uppercase">{{ $project->projectCategory->name }}</span>
                        @endif
                        <h3 class="font-bold text-[#1a1a2e] mt-1 mb-2 group-hover:text-[#ea4335] transition line-clamp-2">{{ $project->title }}</h3>
                        @if($project->client_name)
                        <p class="text-sm text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>
                            {{ $project->client_name }}
                        </p>
                        @endif
                        @if($project->location)
                        <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            {{ $project->location }}
                        </p>
                        @endif
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>Chưa có dự án nào trong danh mục này.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">{{ $projects->links() }}</div>
        </div>
    </div>
</div>
@endsection
