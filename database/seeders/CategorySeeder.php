<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Main categories with subcategories (modeled after delfi.com.vn)
        $categories = [
            [
                'name' => 'Máy Kiểm Kho PDA',
                'icon' => 'heroicon-o-device-phone-mobile',
                'is_featured' => true,
                'sort_order' => 1,
                'description' => 'PDA/ Mobile Computer cho kiểm kho, logistics, bán hàng',
                'children' => [
                    ['name' => 'PDA Quản Lý Kho', 'sort_order' => 1, 'description' => 'Máy kiểm kho PDA chuyên dụng cho quản lý kho hàng'],
                    ['name' => 'PDA Y Tế / Bệnh Viện', 'sort_order' => 2, 'description' => 'PDA dùng trong môi trường y tế, bệnh viện'],
                    ['name' => 'PDA Quản Lý Kho Lạnh', 'sort_order' => 3, 'description' => 'PDA chịu nhiệt độ thấp cho kho lạnh'],
                    ['name' => 'PDA Giao Nhận / Logistics', 'sort_order' => 4, 'description' => 'PDA cho giao nhận, logistics, vận chuyển'],
                    ['name' => 'PDA Bán Hàng / Thanh Toán', 'sort_order' => 5, 'description' => 'PDA tích hợp thanh toán, bán hàng di động'],
                ],
            ],
            [
                'name' => 'Máy In Mã Vạch',
                'icon' => 'heroicon-o-printer',
                'is_featured' => true,
                'sort_order' => 2,
                'description' => 'Máy in mã vạch để bàn, công nghiệp, di động',
                'children' => [
                    ['name' => 'Máy In Mã Vạch Để Bàn', 'sort_order' => 1, 'description' => 'Máy in mã vạch desktop nhỏ gọn cho văn phòng'],
                    ['name' => 'Máy In Mã Vạch Công Nghiệp', 'sort_order' => 2, 'description' => 'Máy in công nghiệp tốc độ cao, bền bỉ'],
                    ['name' => 'Máy In Tem Vải', 'sort_order' => 3, 'description' => 'Máy in tem nhãn trên vải cho ngành may mặc'],
                    ['name' => 'Máy In Mã Vạch Di Động', 'sort_order' => 4, 'description' => 'Máy in mã vạch cầm tay, di động'],
                ],
            ],
            [
                'name' => 'Máy In Hóa Đơn',
                'icon' => 'heroicon-o-receipt-percent',
                'is_featured' => true,
                'sort_order' => 3,
                'description' => 'Máy in hóa đơn nhiệt, máy in bill cho POS',
                'children' => [
                    ['name' => 'Máy In Hóa Đơn Để Bàn', 'sort_order' => 1, 'description' => 'Máy in hóa đơn nhiệt để bàn'],
                    ['name' => 'Máy In Hóa Đơn Di Động', 'sort_order' => 2, 'description' => 'Máy in hóa đơn di động bluetooth'],
                    ['name' => 'Giấy In Hóa Đơn', 'sort_order' => 3, 'description' => 'Giấy in nhiệt, giấy in hóa đơn các loại'],
                ],
            ],
            [
                'name' => 'Máy Quét Mã Vạch',
                'icon' => 'heroicon-o-qr-code',
                'is_featured' => true,
                'sort_order' => 4,
                'description' => 'Máy quét barcode 1D/2D có dây và không dây',
                'children' => [
                    ['name' => 'Máy Quét Mã Vạch Có Dây', 'sort_order' => 1, 'description' => 'Máy quét có dây USB kết nối trực tiếp'],
                    ['name' => 'Máy Quét Mã Vạch Không Dây', 'sort_order' => 2, 'description' => 'Máy quét không dây bluetooth/wifi'],
                    ['name' => 'Máy Quét Mã Vạch Đa Tia', 'sort_order' => 3, 'description' => 'Máy quét đa tia tốc độ nhanh cho siêu thị'],
                    ['name' => 'Máy Quét Băng Chuyền', 'sort_order' => 4, 'description' => 'Máy quét tích hợp băng chuyền sản xuất'],
                ],
            ],
            [
                'name' => 'Máy POS Bán Hàng',
                'icon' => 'heroicon-o-computer-desktop',
                'is_featured' => true,
                'sort_order' => 5,
                'description' => 'Máy POS tính tiền cho nhà hàng, cửa hàng, siêu thị',
                'children' => [
                    ['name' => 'Máy POS Cố Định', 'sort_order' => 1, 'description' => 'Máy POS để bàn cho quầy thu ngân'],
                    ['name' => 'Máy POS Cầm Tay Di Động', 'sort_order' => 2, 'description' => 'Máy POS di động tích hợp thanh toán'],
                    ['name' => 'Thiết Bị Thanh Toán', 'sort_order' => 3, 'description' => 'Thiết bị thanh toán thẻ, QR code'],
                    ['name' => 'Ngăn Đựng Tiền', 'sort_order' => 4, 'description' => 'Ngăn kéo đựng tiền cho quầy thu ngân'],
                    ['name' => 'Màn Hình Phụ POS', 'sort_order' => 5, 'description' => 'Màn hình hiển thị phụ cho hệ thống POS'],
                ],
            ],
            [
                'name' => 'Decal In Mã Vạch',
                'icon' => 'heroicon-o-tag',
                'is_featured' => false,
                'sort_order' => 6,
                'description' => 'Giấy decal, tem nhãn in mã vạch các loại',
                'children' => [
                    ['name' => 'Decal Thường', 'sort_order' => 1],
                    ['name' => 'Decal Cảm Nhiệt', 'sort_order' => 2],
                    ['name' => 'Decal PVC', 'sort_order' => 3],
                ],
            ],
            [
                'name' => 'Mực In Mã Vạch',
                'icon' => 'heroicon-o-paint-brush',
                'is_featured' => false,
                'sort_order' => 7,
                'description' => 'Ribbon mực in mã vạch Wax, Wax/Resin, Resin',
                'children' => [
                    ['name' => 'Mực In Wax', 'sort_order' => 1],
                    ['name' => 'Mực In Wax/Resin', 'sort_order' => 2],
                    ['name' => 'Mực In Resin', 'sort_order' => 3],
                ],
            ],
            [
                'name' => 'Phần Mềm & Giải Pháp',
                'icon' => 'heroicon-o-command-line',
                'is_featured' => true,
                'sort_order' => 8,
                'description' => 'Phần mềm quản lý kho, kiểm kê, thiết kế tem nhãn',
                'children' => [
                    ['name' => 'Phần Mềm Kiểm Kê Kho', 'sort_order' => 1],
                    ['name' => 'Phần Mềm Thiết Kế Tem Nhãn', 'sort_order' => 2],
                    ['name' => 'Giải Pháp Quản Lý Kho ERP', 'sort_order' => 3],
                    ['name' => 'Giải Pháp Check-in Sự Kiện', 'sort_order' => 4],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $children = $catData['children'] ?? [];
            unset($catData['children']);

            $parent = Category::create(array_merge($catData, [
                'is_active' => true,
                'show_in_menu' => true,
            ]));

            foreach ($children as $child) {
                Category::create(array_merge($child, [
                    'parent_id' => $parent->id,
                    'is_active' => true,
                    'show_in_menu' => true,
                    'is_featured' => false,
                ]));
            }
        }
    }
}
