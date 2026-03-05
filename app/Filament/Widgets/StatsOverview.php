<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todayOrders = Order::whereDate('created_at', today())->count();
        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->sum('total');
        $monthRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        return [
            Stat::make('Doanh thu tháng', number_format($monthRevenue) . '₫')
                ->description('Tháng ' . now()->month)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('Đơn hàng hôm nay', $todayOrders)
                ->description('Doanh thu: ' . number_format($todayRevenue) . '₫')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),
            Stat::make('Đơn chờ xử lý', Order::where('status', 'pending')->count())
                ->description('Cần xác nhận')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Tổng sản phẩm', Product::count())
                ->description('Hết hàng: ' . Product::where('quantity', 0)->count())
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),
            Stat::make('Khách hàng', User::where('role', 'customer')->count())
                ->description('Tổng người dùng')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            Stat::make('Liên hệ mới', Contact::unread()->count())
                ->description('Chưa đọc')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
