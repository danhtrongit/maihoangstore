@extends('layouts.app')
@section('title', ($post->meta_title ?: $post->title) . ' - ' . ($siteSettings['site_name'] ?? 'Mai Hoàng Store'))

@section('content')
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg></a>
            <span>/</span>
            <a href="{{ route('posts.index') }}" class="hover:text-[#ea4335]">Tin tức</a>
            <span>/</span>
            <span class="text-gray-800 font-medium truncate">{{ Str::limit($post->title, 50) }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-3 gap-8">
        <article class="lg:col-span-2">
            <h1 class="text-2xl md:text-3xl font-black text-[#ea4335] mb-4">{{ $post->title }}</h1>
            <div class="flex items-center gap-4 text-sm text-gray-400 mb-6 pb-6 border-b border-gray-200">
                @if($post->author)
                <span>{{ $post->author->name }}</span>
                @endif
                <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                <span>{{ number_format($post->views) }} lượt xem</span>
            </div>
            <div class="prose max-w-none text-gray-700 text-sm leading-relaxed">
                {!! $post->content !!}
            </div>
        </article>

        {{-- Sidebar --}}
        <aside>
            <div class="border border-gray-200 mb-6">
                <div class="sidebar-menu-header">Bài viết liên quan</div>
                <div class="p-4 space-y-4">
                    @if(isset($relatedPosts) && count($relatedPosts) > 0)
                        @foreach($relatedPosts as $rp)
                        <div class="flex gap-3 border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                            <div class="w-20 h-16 bg-gray-100 flex-shrink-0 overflow-hidden">
                                @if($rp->thumbnail)
                                    <img src="{{ Storage::url($rp->thumbnail) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('posts.show', $rp->slug) }}" class="text-xs font-bold text-gray-700 hover:text-[#ea4335] line-clamp-2 transition">{{ $rp->title }}</a>
                                <span class="text-[10px] text-gray-400 block mt-1">{{ $rp->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-400 text-center py-4">Chưa có bài viết liên quan</p>
                    @endif
                </div>
            </div>

            {{-- Contact Box --}}
            <div class="border border-[#ea4335] p-5 text-center">
                <p class="font-bold text-[#1a1a2e] uppercase text-sm mb-2">Cần tư vấn?</p>
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone'] ?? '0948490070') }}" class="text-xl font-black text-[#ea4335] block mb-2">{{ $siteSettings['contact_phone'] ?? '0948 490 070' }}</a>
                <p class="text-xs text-gray-500">Hỗ trợ T2-T7, 8:00 - 17:30</p>
            </div>
        </aside>
    </div>
</div>
@endsection
