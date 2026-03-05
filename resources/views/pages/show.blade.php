@extends('layouts.app')
@section('title', $page->meta_title ?: $page->title . ' - ' . ($siteSettings['site_name'] ?? 'Mai Hoàng Store'))
@section('meta_description', $page->meta_description)

@section('content')
<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Trang chủ</a>
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            <span class="text-gray-900 font-medium">{{ $page->title }}</span>
        </nav>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">{{ $page->title }}</h1>
    <div class="prose max-w-none prose-headings:text-gray-900 prose-a:text-blue-600 bg-white rounded-2xl border border-gray-100 p-8">
        {!! $page->content !!}
    </div>
</div>
@endsection
