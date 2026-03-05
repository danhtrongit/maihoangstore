<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', $siteSettings['site_description'] ?? 'Mai Hoàng Store - Chuyên cung cấp thiết bị mã vạch, máy POS, giải pháp quản lý kho hàng đầu Việt Nam')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($siteSettings['seo_title'] ?? 'Mai Hoàng Store') . ' - Thiết Bị Mã Vạch & POS')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if(!empty($siteSettings['site_favicon']))
        <link rel="icon" href="{{ Storage::url($siteSettings['site_favicon']) }}" type="image/png">
    @endif
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    {{-- Toast Notifications --}}
    <div x-data="toastNotification()" x-on:cart-updated.window="show($event.detail.message)" class="fixed top-20 right-4 z-[100] space-y-2">
        <template x-for="(toast, index) in toasts" :key="toast.id">
            <div x-show="toast.visible"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-8"
                 class="flex items-center gap-3 px-5 py-3 bg-white border border-green-200 shadow-lg text-sm font-medium text-green-700 min-w-[280px]">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span x-text="toast.message"></span>
            </div>
        </template>
    </div>

    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
