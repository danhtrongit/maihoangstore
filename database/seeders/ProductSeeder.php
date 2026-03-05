<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $zebra = Brand::where('name', 'Zebra')->first();
        $honeywell = Brand::where('name', 'Honeywell')->first();
        $datalogic = Brand::where('name', 'Datalogic')->first();
        $tsc = Brand::where('name', 'TSC')->first();
        $godex = Brand::where('name', 'Godex')->first();
        $epson = Brand::where('name', 'Epson')->first();
        $bixolon = Brand::where('name', 'Bixolon')->first();
        $pointmobile = Brand::where('name', 'PointMobile')->first();
        $newland = Brand::where('name', 'Newland')->first();

        $products = [
            // PDA Quản Lý Kho
            [
                'name' => 'Zebra MC3300x - Máy Kiểm Kho Android',
                'sku' => 'ZBR-MC3300X',
                'category' => 'PDA Quản Lý Kho',
                'brand_id' => $zebra->id,
                'price' => 25000000,
                'sale_price' => 22500000,
                'quantity' => 15,
                'is_featured' => true,
                'is_bestseller' => true,
                'short_description' => 'Máy kiểm kho PDA Zebra MC3300x chạy Android, màn hình 4 inch, quét 1D/2D, WiFi, Bluetooth',
                'description' => '<h3>Zebra MC3300x - Máy Kiểm Kho Chuyên Nghiệp</h3><p>Zebra MC3300x là thiết bị kiểm kho PDA cao cấp dành cho doanh nghiệp vừa và lớn. Với hệ điều hành Android, màn hình cảm ứng 4 inch rõ nét, máy hỗ trợ quét mã vạch 1D/2D tốc độ cao.</p><ul><li>Hệ điều hành Android 11</li><li>Quét mã vạch 1D/2D siêu nhanh</li><li>Pin dung lượng lớn 7000mAh</li><li>WiFi 6, Bluetooth 5.1</li><li>Bộ nhớ 4GB RAM / 32GB ROM</li></ul>',
                'warranty' => '12 tháng',
                'origin' => 'Mỹ',
                'attrs' => [
                    ['name' => 'Hệ điều hành', 'value' => 'Android 11'],
                    ['name' => 'CPU', 'value' => 'Qualcomm Snapdragon 660'],
                    ['name' => 'RAM / ROM', 'value' => '4GB / 32GB'],
                    ['name' => 'Màn hình', 'value' => '4.0 inch, 800x480'],
                    ['name' => 'Quét mã vạch', 'value' => '1D/2D (SE4770)'],
                    ['name' => 'Kết nối', 'value' => 'WiFi 6, Bluetooth 5.1, USB-C'],
                    ['name' => 'Pin', 'value' => '7000mAh'],
                    ['name' => 'Trọng lượng', 'value' => '490g'],
                ],
            ],
            [
                'name' => 'Honeywell CT60 XP - PDA Kiểm Kho Cao Cấp',
                'sku' => 'HW-CT60XP',
                'category' => 'PDA Quản Lý Kho',
                'brand_id' => $honeywell->id,
                'price' => 28000000,
                'sale_price' => null,
                'quantity' => 8,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'PDA Honeywell CT60 XP với cấu hình mạnh mẽ, quét FlexRange™, dành cho môi trường khắc nghiệt',
                'description' => '<h3>Honeywell CT60 XP - Kiểm Kho Đẳng Cấp</h3><p>CT60 XP là thiết bị mobile computer thế hệ mới từ Honeywell, được thiết kế cho môi trường kho vận khắc nghiệt với khả năng quét FlexRange™ độc quyền.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Mỹ',
                'attrs' => [
                    ['name' => 'Hệ điều hành', 'value' => 'Android 11'],
                    ['name' => 'CPU', 'value' => 'Qualcomm Snapdragon 660'],
                    ['name' => 'RAM / ROM', 'value' => '4GB / 32GB'],
                    ['name' => 'Màn hình', 'value' => '4.7 inch Full HD'],
                    ['name' => 'Quét mã vạch', 'value' => 'FlexRange™ 1D/2D'],
                    ['name' => 'Chuẩn chống', 'value' => 'IP67, rơi 1.8m'],
                ],
            ],
            [
                'name' => 'PointMobile PM451 - PDA Kho Hàng',
                'sku' => 'PM-PM451',
                'category' => 'PDA Quản Lý Kho',
                'brand_id' => $pointmobile->id,
                'price' => 18000000,
                'sale_price' => 16500000,
                'quantity' => 20,
                'is_featured' => false,
                'short_description' => 'PDA PointMobile PM451 Android, bàn phím vật lý, giá tốt cho doanh nghiệp',
                'description' => '<h3>PointMobile PM451</h3><p>Thiết bị kiểm kho giá tốt từ Hàn Quốc.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Hàn Quốc',
                'attrs' => [
                    ['name' => 'Hệ điều hành', 'value' => 'Android 10'],
                    ['name' => 'Màn hình', 'value' => '4.3 inch'],
                    ['name' => 'Pin', 'value' => '5800mAh'],
                ],
            ],
            // Máy In Mã Vạch Để Bàn
            [
                'name' => 'Zebra ZD421 - Máy In Mã Vạch Để Bàn',
                'sku' => 'ZBR-ZD421',
                'category' => 'Máy In Mã Vạch Để Bàn',
                'brand_id' => $zebra->id,
                'price' => 8500000,
                'sale_price' => 7800000,
                'quantity' => 30,
                'is_featured' => true,
                'is_bestseller' => true,
                'short_description' => 'Máy in mã vạch để bàn Zebra ZD421, in nhiệt trực tiếp và truyền nhiệt, USB, WiFi',
                'description' => '<h3>Zebra ZD421</h3><p>Máy in mã vạch để bàn thế hệ mới thay thế ZD420. Thiết kế nhỏ gọn, dễ sử dụng.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Trung Quốc',
                'attrs' => [
                    ['name' => 'Công nghệ in', 'value' => 'Nhiệt trực tiếp / Truyền nhiệt'],
                    ['name' => 'Độ phân giải', 'value' => '203 dpi / 300 dpi'],
                    ['name' => 'Tốc độ in', 'value' => '152mm/s'],
                    ['name' => 'Chiều rộng in', 'value' => '104mm'],
                    ['name' => 'Kết nối', 'value' => 'USB, WiFi, Bluetooth, Ethernet'],
                ],
            ],
            [
                'name' => 'TSC TE210 - Máy In Tem Nhãn Để Bàn',
                'sku' => 'TSC-TE210',
                'category' => 'Máy In Mã Vạch Để Bàn',
                'brand_id' => $tsc->id,
                'price' => 4200000,
                'sale_price' => 3800000,
                'quantity' => 50,
                'is_featured' => false,
                'is_bestseller' => true,
                'short_description' => 'Máy in tem nhãn mã vạch TSC TE210 giá rẻ, phù hợp doanh nghiệp nhỏ',
                'description' => '<h3>TSC TE210</h3><p>Máy in mã vạch giá tốt nhất phân khúc, phù hợp cho cửa hàng và doanh nghiệp nhỏ.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Đài Loan',
                'attrs' => [
                    ['name' => 'Độ phân giải', 'value' => '203 dpi'],
                    ['name' => 'Tốc độ in', 'value' => '127mm/s'],
                    ['name' => 'Kết nối', 'value' => 'USB'],
                ],
            ],
            [
                'name' => 'Godex G530 - Máy In Mã Vạch 300dpi',
                'sku' => 'GDX-G530',
                'category' => 'Máy In Mã Vạch Để Bàn',
                'brand_id' => $godex->id,
                'price' => 5500000,
                'sale_price' => null,
                'quantity' => 25,
                'is_featured' => false,
                'short_description' => 'Máy in mã vạch Godex G530, độ phân giải 300dpi, in sắc nét',
                'description' => '<h3>Godex G530</h3><p>Máy in mã vạch 300dpi cho chất lượng in sắc nét.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Đài Loan',
                'attrs' => [
                    ['name' => 'Độ phân giải', 'value' => '300 dpi'],
                    ['name' => 'Tốc độ in', 'value' => '127mm/s'],
                ],
            ],
            // Máy In Công Nghiệp
            [
                'name' => 'Zebra ZT411 - Máy In Công Nghiệp 203dpi',
                'sku' => 'ZBR-ZT411',
                'category' => 'Máy In Mã Vạch Công Nghiệp',
                'brand_id' => $zebra->id,
                'price' => 32000000,
                'sale_price' => 29500000,
                'quantity' => 10,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'Máy in mã vạch công nghiệp Zebra ZT411, tốc độ cao, bền bỉ cho nhà máy sản xuất',
                'description' => '<h3>Zebra ZT411</h3><p>Máy in công nghiệp hàng đầu, phù hợp cho nhà máy sản xuất với nhu cầu in số lượng lớn.</p>',
                'warranty' => '24 tháng',
                'origin' => 'Mỹ',
                'attrs' => [
                    ['name' => 'Độ phân giải', 'value' => '203 dpi'],
                    ['name' => 'Tốc độ in', 'value' => '356mm/s'],
                    ['name' => 'Chiều rộng in', 'value' => '104mm'],
                    ['name' => 'Màn hình', 'value' => 'LCD màu cảm ứng 4.3 inch'],
                ],
            ],
            // Máy Quét Mã Vạch Có Dây
            [
                'name' => 'Honeywell Voyager 1472g - Máy Quét 2D Có Dây',
                'sku' => 'HW-1472G',
                'category' => 'Máy Quét Mã Vạch Có Dây',
                'brand_id' => $honeywell->id,
                'price' => 3200000,
                'sale_price' => 2900000,
                'quantity' => 100,
                'is_featured' => true,
                'is_bestseller' => true,
                'short_description' => 'Máy quét mã vạch 2D Honeywell Voyager 1472g, quét nhanh, bền bỉ',
                'description' => '<h3>Honeywell Voyager 1472g</h3><p>Máy quét mã vạch 2D bán chạy nhất, phù hợp cho mọi loại hình kinh doanh.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Mỹ',
                'attrs' => [
                    ['name' => 'Loại quét', 'value' => '1D/2D'],
                    ['name' => 'Kết nối', 'value' => 'USB có dây'],
                    ['name' => 'Tốc độ quét', 'value' => '1500 lần/giây'],
                ],
            ],
            [
                'name' => 'Zebra DS2208 - Máy Quét Mã Vạch 2D',
                'sku' => 'ZBR-DS2208',
                'category' => 'Máy Quét Mã Vạch Có Dây',
                'brand_id' => $zebra->id,
                'price' => 2800000,
                'sale_price' => null,
                'quantity' => 80,
                'is_featured' => false,
                'short_description' => 'Máy quét mã vạch Zebra DS2208, thiết kế ergonomic, giá cạnh tranh',
                'description' => '<h3>Zebra DS2208</h3><p>Máy quét mã vạch entry-level của Zebra.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Mỹ',
                'attrs' => [
                    ['name' => 'Loại quét', 'value' => '1D/2D'],
                    ['name' => 'Kết nối', 'value' => 'USB'],
                ],
            ],
            [
                'name' => 'Datalogic QuickScan QD2590 - Quét 2D',
                'sku' => 'DL-QD2590',
                'category' => 'Máy Quét Mã Vạch Có Dây',
                'brand_id' => $datalogic->id,
                'price' => 3500000,
                'sale_price' => 3200000,
                'quantity' => 40,
                'is_featured' => false,
                'short_description' => 'Máy quét mã vạch Datalogic QuickScan, hiệu năng cao',
                'description' => '<h3>Datalogic QD2590</h3><p>Máy quét 2D từ Datalogic, dòng QuickScan nổi tiếng.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Ý',
                'attrs' => [
                    ['name' => 'Loại quét', 'value' => '2D Megapixel'],
                    ['name' => 'Khoảng cách quét', 'value' => '0 - 40cm'],
                ],
            ],
            // Máy Quét Không Dây
            [
                'name' => 'Zebra DS2278 - Máy Quét Không Dây Bluetooth',
                'sku' => 'ZBR-DS2278',
                'category' => 'Máy Quét Mã Vạch Không Dây',
                'brand_id' => $zebra->id,
                'price' => 4500000,
                'sale_price' => 4100000,
                'quantity' => 35,
                'is_featured' => true,
                'short_description' => 'Máy quét không dây Zebra DS2278, Bluetooth, pin bền',
                'description' => '<h3>Zebra DS2278</h3><p>Máy quét mã vạch không dây Bluetooth tiện lợi.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Mỹ',
                'attrs' => [
                    ['name' => 'Kết nối', 'value' => 'Bluetooth 4.0'],
                    ['name' => 'Pin', 'value' => '2500mAh, 57000 lần quét/sạc'],
                ],
            ],
            // Máy POS Cố Định
            [
                'name' => 'Máy POS Bán Hàng MH-T1580 15.6"',
                'sku' => 'MH-T1580',
                'category' => 'Máy POS Cố Định',
                'brand_id' => null,
                'price' => 12000000,
                'sale_price' => 10800000,
                'quantity' => 20,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'Máy POS bán hàng màn hình cảm ứng 15.6 inch, Windows, phù hợp nhà hàng, cửa hàng',
                'description' => '<h3>Máy POS MH-T1580</h3><p>Giải pháp POS tất cả trong một cho cửa hàng bán lẻ và nhà hàng.</p>',
                'warranty' => '24 tháng',
                'origin' => 'Trung Quốc',
                'attrs' => [
                    ['name' => 'Màn hình', 'value' => '15.6 inch Full HD cảm ứng'],
                    ['name' => 'CPU', 'value' => 'Intel Celeron J4125'],
                    ['name' => 'RAM / SSD', 'value' => '8GB / 128GB SSD'],
                    ['name' => 'HĐH', 'value' => 'Windows 10 IoT'],
                ],
            ],
            // Máy In Hóa Đơn
            [
                'name' => 'Epson TM-T82III - Máy In Hóa Đơn Nhiệt',
                'sku' => 'EPS-TMT82III',
                'category' => 'Máy In Hóa Đơn Để Bàn',
                'brand_id' => $epson->id,
                'price' => 4800000,
                'sale_price' => 4200000,
                'quantity' => 60,
                'is_featured' => true,
                'is_bestseller' => true,
                'short_description' => 'Máy in hóa đơn nhiệt Epson TM-T82III, tốc độ in 250mm/s, tự động cắt giấy',
                'description' => '<h3>Epson TM-T82III</h3><p>Máy in hóa đơn POS bán chạy nhất từ Epson.</p>',
                'warranty' => '24 tháng',
                'origin' => 'Indonesia',
                'attrs' => [
                    ['name' => 'Tốc độ in', 'value' => '250mm/s'],
                    ['name' => 'Độ rộng giấy', 'value' => '58mm / 80mm'],
                    ['name' => 'Cắt giấy', 'value' => 'Tự động'],
                    ['name' => 'Kết nối', 'value' => 'USB + Ethernet'],
                ],
            ],
            [
                'name' => 'Bixolon SRP-350III - In Bill POS',
                'sku' => 'BXL-SRP350III',
                'category' => 'Máy In Hóa Đơn Để Bàn',
                'brand_id' => $bixolon->id,
                'price' => 3900000,
                'sale_price' => null,
                'quantity' => 45,
                'is_featured' => false,
                'short_description' => 'Máy in hóa đơn Bixolon SRP-350III, thiết kế đẹp, bền bỉ',
                'description' => '<h3>Bixolon SRP-350III</h3><p>Máy in hóa đơn chất lượng Hàn Quốc.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Hàn Quốc',
                'attrs' => [
                    ['name' => 'Tốc độ in', 'value' => '300mm/s'],
                    ['name' => 'Kết nối', 'value' => 'USB + Serial'],
                ],
            ],
            // Máy In Hóa Đơn Di Động
            [
                'name' => 'Zebra ZQ520 - Máy In Di Động 4 Inch',
                'sku' => 'ZBR-ZQ520',
                'category' => 'Máy In Hóa Đơn Di Động',
                'brand_id' => $zebra->id,
                'price' => 14000000,
                'sale_price' => 12500000,
                'quantity' => 12,
                'is_featured' => true,
                'short_description' => 'Máy in hóa đơn di động Zebra ZQ520, chống nước IP54, Bluetooth + WiFi',
                'description' => '<h3>Zebra ZQ520</h3><p>Máy in di động chuyên nghiệp cho giao nhận, logistics.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Mỹ',
                'attrs' => [
                    ['name' => 'Chiều rộng in', 'value' => '4 inch (104mm)'],
                    ['name' => 'Chống nước', 'value' => 'IP54'],
                    ['name' => 'Pin', 'value' => '4900mAh'],
                ],
            ],
            // Decal
            [
                'name' => 'Decal Thường 100x50mm (1000 tem/cuộn)',
                'sku' => 'DCL-100X50',
                'category' => 'Decal Thường',
                'brand_id' => null,
                'price' => 85000,
                'sale_price' => null,
                'quantity' => 500,
                'is_featured' => false,
                'short_description' => 'Cuộn giấy decal thường kích thước 100x50mm, 1000 tem/cuộn',
                'description' => '<p>Decal thường dùng cho máy in mã vạch truyền nhiệt.</p>',
                'warranty' => 'Không bảo hành',
                'origin' => 'Việt Nam',
                'attrs' => [
                    ['name' => 'Kích thước', 'value' => '100 x 50mm'],
                    ['name' => 'Số lượng', 'value' => '1000 tem/cuộn'],
                ],
            ],
            [
                'name' => 'Decal Cảm Nhiệt 75x73mm (500 tem/cuộn)',
                'sku' => 'DCL-75X73CN',
                'category' => 'Decal Cảm Nhiệt',
                'brand_id' => null,
                'price' => 65000,
                'sale_price' => null,
                'quantity' => 800,
                'is_featured' => false,
                'short_description' => 'Decal cảm nhiệt dùng cho máy in nhiệt trực tiếp',
                'description' => '<p>Giấy decal cảm nhiệt, không cần mực in.</p>',
                'warranty' => 'Không bảo hành',
                'origin' => 'Việt Nam',
                'attrs' => [
                    ['name' => 'Kích thước', 'value' => '75 x 73mm'],
                    ['name' => 'Số lượng', 'value' => '500 tem/cuộn'],
                ],
            ],
            // Mực In
            [
                'name' => 'Ribbon Wax 110x300m - Mực In Mã Vạch',
                'sku' => 'RBN-WAX-110',
                'category' => 'Mực In Wax',
                'brand_id' => null,
                'price' => 120000,
                'sale_price' => null,
                'quantity' => 300,
                'is_featured' => false,
                'short_description' => 'Ribbon Wax 110x300m, dùng cho máy in mã vạch để bàn',
                'description' => '<p>Mực in Wax phổ thông cho giấy decal thường.</p>',
                'warranty' => 'Không bảo hành',
                'origin' => 'Trung Quốc',
                'attrs' => [
                    ['name' => 'Kích thước', 'value' => '110mm x 300m'],
                    ['name' => 'Loại', 'value' => 'Wax'],
                ],
            ],
            // Newland Scanner
            [
                'name' => 'Newland HR22 Dorada II - Máy Quét 2D',
                'sku' => 'NL-HR22',
                'category' => 'Máy Quét Mã Vạch Có Dây',
                'brand_id' => $newland->id,
                'price' => 1800000,
                'sale_price' => 1600000,
                'quantity' => 120,
                'is_featured' => false,
                'is_bestseller' => true,
                'short_description' => 'Máy quét mã vạch 2D giá rẻ nhất thị trường, chất lượng tốt',
                'description' => '<h3>Newland HR22 Dorada II</h3><p>Máy quét mã vạch giá rẻ cho doanh nghiệp nhỏ.</p>',
                'warranty' => '12 tháng',
                'origin' => 'Trung Quốc',
                'attrs' => [
                    ['name' => 'Loại quét', 'value' => '1D/2D CMOS'],
                    ['name' => 'Kết nối', 'value' => 'USB HID'],
                ],
            ],
            // Ngăn Đựng Tiền
            [
                'name' => 'Ngăn Đựng Tiền MH-410 - Két Tiền POS',
                'sku' => 'MH-CD410',
                'category' => 'Ngăn Đựng Tiền',
                'brand_id' => null,
                'price' => 950000,
                'sale_price' => 850000,
                'quantity' => 70,
                'is_featured' => false,
                'short_description' => 'Két tiền POS 4 ngăn tiền giấy, 5 ngăn tiền xu',
                'description' => '<p>Ngăn kéo đựng tiền cho máy POS bán hàng.</p>',
                'warranty' => '6 tháng',
                'origin' => 'Trung Quốc',
                'attrs' => [
                    ['name' => 'Ngăn tiền giấy', 'value' => '4 ngăn'],
                    ['name' => 'Ngăn tiền xu', 'value' => '5 ngăn'],
                    ['name' => 'Kết nối', 'value' => 'RJ11 (tự động mở)'],
                ],
            ],
        ];

        foreach ($products as $pData) {
            $categoryName = $pData['category'];
            $attrs = $pData['attrs'] ?? [];
            unset($pData['category'], $pData['attrs']);

            $category = Category::where('name', $categoryName)->first();
            $pData['category_id'] = $category ? $category->id : null;
            $pData['is_active'] = true;
            $pData['is_featured'] = $pData['is_featured'] ?? false;
            $pData['is_new'] = $pData['is_new'] ?? false;
            $pData['is_bestseller'] = $pData['is_bestseller'] ?? false;

            $product = Product::create($pData);

            foreach ($attrs as $i => $attr) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'name' => $attr['name'],
                    'value' => $attr['value'],
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
