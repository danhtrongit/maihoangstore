<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Máy Kiểm Kho PDA - Giải Pháp Quản Lý Kho Thông Minh',
                'subtitle' => 'Giảm đến 15% cho đơn hàng đầu tiên',
                'image' => '',
                'link' => '/danh-muc/may-kiem-kho-pda',
                'button_text' => 'Xem ngay',
                'position' => 'main_slider',
                'sort_order' => 1,
            ],
            [
                'title' => 'Máy In Mã Vạch Zebra - Chính Hãng 100%',
                'subtitle' => 'Bảo hành 24 tháng - Giao hàng toàn quốc',
                'image' => '',
                'link' => '/danh-muc/may-in-ma-vach',
                'button_text' => 'Mua ngay',
                'position' => 'main_slider',
                'sort_order' => 2,
            ],
            [
                'title' => 'Máy Quét Mã Vạch - Đa Dạng Mẫu Mã',
                'subtitle' => 'Từ 1.600.000₫ - Quét 1D/2D siêu nhanh',
                'image' => '',
                'link' => '/danh-muc/may-quet-ma-vach',
                'button_text' => 'Khám phá',
                'position' => 'main_slider',
                'sort_order' => 3,
            ],
            [
                'title' => 'Giải Pháp POS Bán Hàng Toàn Diện',
                'subtitle' => 'Cho nhà hàng, cửa hàng, siêu thị',
                'image' => '',
                'link' => '/danh-muc/may-pos-ban-hang',
                'button_text' => 'Tìm hiểu',
                'position' => 'main_slider',
                'sort_order' => 4,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create(array_merge($banner, ['is_active' => true]));
        }
    }
}
