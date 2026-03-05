@extends('layouts.app')
@section('title', 'Giỏ hàng - ' . ($siteSettings['site_name'] ?? 'Mai Hoàng Store'))

@section('content')
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-[#ea4335]"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg></a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">Giỏ hàng</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="section-heading">Giỏ Hàng</h1>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 text-sm font-medium">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            {{-- Cart Table --}}
            <div class="border border-gray-200 bg-white overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-[#1a1a2e] text-white text-xs uppercase">
                            <th class="py-3 px-4 text-left font-bold">Sản phẩm</th>
                            <th class="py-3 px-4 text-center font-bold">Đơn giá</th>
                            <th class="py-3 px-4 text-center font-bold">Số lượng</th>
                            <th class="py-3 px-4 text-right font-bold">Thành tiền</th>
                            <th class="py-3 px-4 text-center font-bold w-12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                        <tr class="border-b border-gray-100">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-50 flex items-center justify-center flex-shrink-0 border border-gray-100">
                                        @if(!empty($item['image']))
                                            <img src="{{ $item['image'] }}" alt="" class="max-w-full max-h-full object-contain p-1">
                                        @else
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                        @endif
                                    </div>
                                    <a href="{{ route('products.show', $item['slug'] ?? '#') }}" class="font-bold text-[#ea4335] hover:underline text-xs line-clamp-2">{{ $item['name'] }}</a>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center text-xs font-semibold">{{ number_format($item['price']) }}₫</td>
                            <td class="py-4 px-4 text-center">
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-14 text-center py-1 border border-gray-300 text-xs focus:outline-none focus:border-[#ea4335]" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="py-4 px-4 text-right font-bold text-xs text-[#ea4335]">{{ number_format($item['price'] * $item['quantity']) }}₫</td>
                            <td class="py-4 px-4 text-center">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="text-gray-400 hover:text-[#ea4335] transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Order Summary --}}
        <div>
            <div class="border border-gray-200 bg-white">
                <div class="sidebar-menu-header">Tóm Tắt Đơn Hàng</div>
                <div class="p-5">
                    @php $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)); @endphp
                    <div class="space-y-3 text-sm mb-6">
                        <div class="flex justify-between"><span class="text-gray-500">Tạm tính</span><span class="font-semibold">{{ number_format($total) }}₫</span></div>
                        <div class="flex justify-between"><span class="text-gray-500">Phí vận chuyển</span><span class="text-green-600 font-semibold">Miễn phí</span></div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between font-black text-lg">
                            <span>Tổng cộng</span>
                            <span class="text-[#ea4335]">{{ number_format($total) }}₫</span>
                        </div>
                    </div>
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone'] ?? '0948490070') }}" class="btn-dark block text-center w-full !py-3 mb-3">LIÊN HỆ ĐẶT HÀNG</a>
                    <a href="{{ route('products.index') }}" class="text-center text-xs text-gray-500 hover:text-[#ea4335] block transition">← Tiếp tục mua hàng</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-20">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
        <p class="text-gray-500 mb-4">Giỏ hàng trống</p>
        <a href="{{ route('products.index') }}" class="btn-primary">BẮT ĐẦU MUA SẮM</a>
    </div>
    @endif
</div>
@endsection
