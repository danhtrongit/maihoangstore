<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Zebra', 'description' => 'Thương hiệu hàng đầu về máy in mã vạch và máy quét công nghiệp', 'website' => 'https://www.zebra.com', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Honeywell', 'description' => 'Giải pháp công nghệ tự động hóa và thiết bị quét mã vạch chuyên nghiệp', 'website' => 'https://www.honeywell.com', 'is_featured' => true, 'sort_order' => 2],
            ['name' => 'Datalogic', 'description' => 'Nhà sản xuất thiết bị thu thập dữ liệu tự động hàng đầu thế giới', 'website' => 'https://www.datalogic.com', 'is_featured' => true, 'sort_order' => 3],
            ['name' => 'TSC', 'description' => 'Hãng sản xuất máy in mã vạch công nghiệp từ Đài Loan', 'website' => 'https://www.tscprinters.com', 'is_featured' => true, 'sort_order' => 4],
            ['name' => 'Godex', 'description' => 'Máy in tem nhãn mã vạch chất lượng cao', 'website' => 'https://www.godex.com', 'is_featured' => false, 'sort_order' => 5],
            ['name' => 'Epson', 'description' => 'Thương hiệu Nhật Bản nổi tiếng với máy in hóa đơn, máy in POS', 'website' => 'https://www.epson.com', 'is_featured' => true, 'sort_order' => 6],
            ['name' => 'Bixolon', 'description' => 'Nhà sản xuất máy in di động và máy in POS hàng đầu Hàn Quốc', 'website' => 'https://www.bixolon.com', 'is_featured' => false, 'sort_order' => 7],
            ['name' => 'PointMobile', 'description' => 'Thiết bị PDA kiểm kho từ Hàn Quốc', 'website' => 'https://www.pointmobile.com', 'is_featured' => true, 'sort_order' => 8],
            ['name' => 'Newland', 'description' => 'Thiết bị quét mã vạch và POS từ Trung Quốc', 'website' => 'https://www.newlandaidc.com', 'is_featured' => false, 'sort_order' => 9],
            ['name' => 'Urovo', 'description' => 'Giải pháp PDA và thiết bị di động doanh nghiệp', 'website' => 'https://www.urovo.com', 'is_featured' => false, 'sort_order' => 10],
        ];

        foreach ($brands as $brand) {
            Brand::create(array_merge($brand, ['is_active' => true]));
        }
    }
}
