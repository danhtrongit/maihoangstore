@extends('layouts.app')
@section('title', 'Tin Tức & Hướng Dẫn - Mai Hoàng Store')

@section('content')
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg></a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">Tin tức</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="section-heading">Tin Tức & Hướng Dẫn</h1>

    <div class="grid lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($posts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="block bg-white border border-gray-200 hover:border-[#ea4335] hover:shadow-lg transition group overflow-hidden">
                    <div class="h-52 bg-gray-100 overflow-hidden">
                        @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 group-hover:text-[#ea4335] transition line-clamp-2 mb-2">{{ $post->title }}</h3>
                        @if($post->excerpt)
                        <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ $post->excerpt }}</p>
                        @endif
                        <div class="flex items-center gap-4 text-xs text-gray-400">
                            <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                            <span>{{ number_format($post->views) }} lượt xem</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-500">Chưa có bài viết nào</p>
                </div>
                @endforelse
            </div>
            <div class="mt-8">{{ $posts->links() }}</div>
        </div>

        {{-- Sidebar --}}
        <aside class="lg:col-span-1">
            <div class="border border-gray-200">
                <div class="sidebar-menu-header">Danh mục bài viết</div>
                @php $postCategories = \App\Models\PostCategory::where('is_active', true)->orderBy('sort_order')->get(); @endphp
                @foreach($postCategories as $pc)
                <a href="{{ route('posts.index', ['category' => $pc->id]) }}" class="sidebar-menu-item !text-xs !font-medium !normal-case">
                    {{ $pc->name }}
                </a>
                @endforeach
            </div>
        </aside>
    </div>
</div>
@endsection
