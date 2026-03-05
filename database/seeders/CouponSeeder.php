<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            ['code' => 'WELCOME10', 'name' => 'Giảm 10% đơn đầu tiên', 'type' => 'percent', 'value' => 10, 'max_discount' => 500000, 'min_order' => 1000000, 'usage_limit' => 100],
            ['code' => 'MAIHOANG50K', 'name' => 'Giảm 50.000₫', 'type' => 'fixed', 'value' => 50000, 'min_order' => 500000, 'usage_limit' => 200],
            ['code' => 'FREESHIP', 'name' => 'Miễn phí giao hàng', 'type' => 'fixed', 'value' => 30000, 'min_order' => 300000, 'usage_limit' => null],
            ['code' => 'VIP20', 'name' => 'Giảm 20% cho khách VIP', 'type' => 'percent', 'value' => 20, 'max_discount' => 2000000, 'min_order' => 5000000, 'usage_limit' => 50],
            ['code' => 'SALE500K', 'name' => 'Giảm 500.000₫ đơn từ 5 triệu', 'type' => 'fixed', 'value' => 500000, 'min_order' => 5000000, 'usage_limit' => 30],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create(array_merge($coupon, [
                'is_active' => true,
                'start_date' => now()->subDays(10),
                'end_date' => now()->addMonths(3),
                'used_count' => rand(0, 15),
            ]));
        }
    }
}
