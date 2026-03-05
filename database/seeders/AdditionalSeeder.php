<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\Client;
use App\Models\Office;
use Illuminate\Database\Seeder;

class AdditionalSeeder extends Seeder
{
    public function run(): void
    {
        // Services (Kỹ thuật)
        $services = [
            [
                'name' => 'Bảo Hành Ủy Quyền',
                'icon' => 'shield-check',
                'short_description' => 'Dịch vụ bảo hành chính hãng cho tất cả thiết bị mã vạch, PDA, máy in tem nhãn. Đội ngũ kỹ thuật được đào tạo trực tiếp từ hãng.',
                'content' => '<h3>Dịch vụ bảo hành ủy quyền</h3><p>Mai Hoàng là trung tâm bảo hành ủy quyền chính thức của các hãng: Zebra, Honeywell, PointMobile, Bixolon, SATO. Chúng tôi cam kết thời gian bảo hành nhanh nhất với linh kiện chính hãng.</p><h4>Quy trình bảo hành</h4><ul><li>Tiếp nhận thiết bị và kiểm tra ban đầu</li><li>Báo lỗi và phương án xử lý cho khách hàng</li><li>Tiến hành sửa chữa/thay thế linh kiện</li><li>Kiểm tra chất lượng sau sửa chữa</li><li>Bàn giao thiết bị cho khách hàng</li></ul>',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Sửa Chữa Thiết Bị',
                'icon' => 'wrench',
                'short_description' => 'Dịch vụ sửa chữa thiết bị mã vạch ngoài bảo hành. Xử lý nhanh trong ngày với chi phí hợp lý.',
                'content' => '<h3>Dịch vụ sửa chữa thiết bị</h3><p>Đội ngũ kỹ thuật viên giàu kinh nghiệm, được đào tạo chuyên sâu từ hãng, sẵn sàng xử lý mọi sự cố của thiết bị mã vạch.</p><h4>Thiết bị hỗ trợ sửa chữa</h4><ul><li>Máy kiểm kho PDA</li><li>Máy quét mã vạch</li><li>Máy in tem nhãn mã vạch</li><li>Máy in hóa đơn</li><li>Máy POS bán hàng</li></ul>',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Bảo Trì Định Kỳ',
                'icon' => 'calendar',
                'short_description' => 'Chương trình bảo trì định kỳ giúp thiết bị hoạt động ổn định, kéo dài tuổi thọ và giảm chi phí sửa chữa.',
                'content' => '<h3>Dịch vụ bảo trì định kỳ</h3><p>Mai Hoàng cung cấp gói bảo trì định kỳ cho doanh nghiệp, giúp thiết bị luôn trong tình trạng tốt nhất.</p><h4>Nội dung bảo trì</h4><ul><li>Vệ sinh thiết bị chuyên dụng</li><li>Kiểm tra phần cứng</li><li>Cập nhật firmware/phần mềm</li><li>Hiệu chỉnh và tối ưu hoạt động</li><li>Báo cáo tình trạng thiết bị</li></ul>',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Cho Thuê Thiết Bị',
                'icon' => 'key',
                'short_description' => 'Dịch vụ cho thuê thiết bị mã vạch ngắn/dài hạn cho sự kiện, kiểm kê, triển lãm với giá cạnh tranh.',
                'content' => '<h3>Dịch vụ cho thuê thiết bị</h3><p>Giải pháp tiết kiệm chi phí cho doanh nghiệp cần thiết bị mã vạch trong thời gian ngắn.</p><h4>Thiết bị cho thuê</h4><ul><li>PDA kiểm kho Android</li><li>Máy quét mã vạch không dây</li><li>Máy in tem nhãn di động</li><li>Hệ thống POS di động</li></ul>',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];
        foreach ($services as $s) {
            Service::create($s);
        }

        // Project Categories
        $projCats = [
            ['name' => 'Dự Án Thiết Bị', 'sort_order' => 1],
            ['name' => 'Dự Án Check-in Sự Kiện', 'sort_order' => 2],
            ['name' => 'Ứng Dụng Phần Mềm', 'sort_order' => 3],
        ];
        foreach ($projCats as $pc) {
            ProjectCategory::create($pc);
        }

        // Projects
        $projects = [
            [
                'title' => 'Triển khai hệ thống kiểm kho PDA cho Vietnam Airlines',
                'project_category_id' => 1,
                'client_name' => 'Vietnam Airlines',
                'location' => 'TP. Hồ Chí Minh',
                'short_description' => 'Cung cấp và triển khai 50 thiết bị PDA Zebra MC3300x cho hệ thống quản lý kho phụ tùng máy bay của Vietnam Airlines.',
                'content' => '<h3>Tổng quan dự án</h3><p>Vietnam Airlines cần một giải pháp kiểm kho hiện đại để quản lý kho phụ tùng máy bay tại sân bay Tân Sơn Nhất. Mai Hoàng đã triển khai thành công hệ thống PDA kiểm kho với 50 thiết bị Zebra MC3300x.</p><h4>Phạm vi dự án</h4><ul><li>Cung cấp 50 thiết bị PDA Zebra MC3300x</li><li>Cài đặt phần mềm quản lý kho</li><li>Đào tạo nhân viên sử dụng</li><li>Hỗ trợ kỹ thuật 24/7</li></ul>',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Hệ thống mã vạch cho nhà máy Samsung Việt Nam',
                'project_category_id' => 1,
                'client_name' => 'Samsung Vietnam',
                'location' => 'Bắc Ninh',
                'short_description' => 'Triển khai hệ thống in và quét mã vạch toàn diện cho dây chuyền sản xuất Samsung tại Bắc Ninh.',
                'content' => '<h3>Tổng quan dự án</h3><p>Samsung Vietnam cần một hệ thống mã vạch đồng bộ cho toàn bộ dây chuyền sản xuất. Mai Hoàng đã cung cấp giải pháp end-to-end từ máy in, máy quét đến phần mềm quản lý.</p>',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Check-in sự kiện Vietnam DevSummit 2025',
                'project_category_id' => 2,
                'client_name' => 'TechEvents Vietnam',
                'location' => 'TP. Hồ Chí Minh',
                'short_description' => 'Triển khai hệ thống check-in tự động cho sự kiện công nghệ lớn nhất Việt Nam với 5000+ khách tham dự.',
                'content' => '<h3>Tổng quan dự án</h3><p>Hệ thống check-in sự kiện sử dụng QR code và thiết bị quét mã vạch di động, xử lý nhanh chóng 5000+ khách tham dự trong thời gian ngắn.</p>',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Hệ thống quản lý kho lạnh cho Ajinomoto',
                'project_category_id' => 1,
                'client_name' => 'Ajinomoto Vietnam',
                'location' => 'Đồng Nai',
                'short_description' => 'Triển khai PDA chịu lạnh cho hệ thống kho lạnh Ajinomoto, quản lý hàng hóa trong môi trường -25°C.',
                'content' => '<h3>Tổng quan dự án</h3><p>Ajinomoto cần thiết bị PDA có thể hoạt động ổn định trong môi trường kho lạnh -25°C. Mai Hoàng đã triển khai giải pháp PDA chuyên dụng kho lạnh.</p>',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'Giải pháp POS cho chuỗi cửa hàng Bách Hóa Xanh',
                'project_category_id' => 3,
                'client_name' => 'Bách Hóa Xanh',
                'location' => 'Toàn quốc',
                'short_description' => 'Cung cấp và triển khai hệ thống POS bán hàng cho 500+ cửa hàng Bách Hóa Xanh trên toàn quốc.',
                'content' => '<h3>Tổng quan dự án</h3><p>Mai Hoàng cung cấp giải pháp POS toàn diện cho chuỗi cửa hàng Bách Hóa Xanh, bao gồm máy POS, máy quét mã vạch và máy in hóa đơn.</p>',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Check-in sự kiện giải marathon TP.HCM 2025',
                'project_category_id' => 2,
                'client_name' => 'Ban tổ chức Marathon TP.HCM',
                'location' => 'TP. Hồ Chí Minh',
                'short_description' => 'Hệ thống check-in và tracking vận động viên cho giải marathon với 10,000+ người tham gia.',
                'content' => '<h3>Tổng quan dự án</h3><p>Hệ thống check-in sự kiện giải marathon sử dụng RFID và mã vạch để tracking vận động viên theo thời gian thực.</p>',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];
        foreach ($projects as $p) {
            Project::create($p);
        }

        // Certificates
        $certs = [
            ['title' => 'Chứng Nhận NPP Zebra', 'issuer' => 'Zebra Technologies', 'sort_order' => 1],
            ['title' => 'Chứng Nhận NPP Honeywell', 'issuer' => 'Honeywell', 'sort_order' => 2],
            ['title' => 'Trung Tâm Kỹ Thuật PointMobile', 'issuer' => 'PointMobile', 'sort_order' => 3],
            ['title' => 'Chứng Nhận NPP SATO', 'issuer' => 'SATO Vietnam', 'sort_order' => 4],
            ['title' => 'Chứng Nhận NPP Bixolon', 'issuer' => 'Bixolon', 'sort_order' => 5],
            ['title' => 'Giải Thưởng Top Growth Award', 'issuer' => 'Bixolon', 'sort_order' => 6],
        ];
        foreach ($certs as $c) {
            Certificate::create(array_merge($c, ['image' => 'certificates/placeholder.jpg']));
        }

        // Clients (Khách hàng tiêu biểu)
        $clients = [
            ['name' => 'Vietnam Airlines', 'sort_order' => 1, 'is_featured' => true],
            ['name' => 'Samsung', 'sort_order' => 2, 'is_featured' => true],
            ['name' => 'Bosch', 'sort_order' => 3, 'is_featured' => true],
            ['name' => 'Fujikura', 'sort_order' => 4, 'is_featured' => true],
            ['name' => 'Ajinomoto', 'sort_order' => 5, 'is_featured' => true],
            ['name' => 'FPT', 'sort_order' => 6, 'is_featured' => true],
            ['name' => 'Amway', 'sort_order' => 7, 'is_featured' => true],
            ['name' => 'Viettel', 'sort_order' => 8, 'is_featured' => true],
            ['name' => 'Essel Group', 'sort_order' => 9, 'is_featured' => false],
            ['name' => 'Toll Logistics', 'sort_order' => 10, 'is_featured' => false],
        ];
        foreach ($clients as $cl) {
            Client::create(array_merge($cl, ['logo' => 'clients/placeholder.png']));
        }

        // Offices
        $offices = [
            [
                'name' => 'Trụ Sở Hồ Chí Minh',
                'address' => '123 Nguyễn Thị Minh Khai, Phường Bến Thành, Quận 1, TP. Hồ Chí Minh',
                'phone' => '0948 490 070',
                'email' => 'info@maihoang.vn',
                'map_url' => 'https://maps.google.com',
                'sort_order' => 1,
            ],
            [
                'name' => 'Văn Phòng Hà Nội',
                'address' => 'Tòa nhà BT Office, Số 106 Tôn Đức Thắng, Phường Đống Đa, Hà Nội',
                'phone' => '0948 490 070',
                'email' => 'hanoi@maihoang.vn',
                'map_url' => 'https://maps.google.com',
                'sort_order' => 2,
            ],
            [
                'name' => 'Văn Phòng Đà Nẵng',
                'address' => 'Số 84 Châu Thị Vĩnh Tế, Phường Mỹ An, Quận Ngũ Hành Sơn, Đà Nẵng',
                'phone' => '0948 490 070',
                'email' => 'danang@maihoang.vn',
                'map_url' => 'https://maps.google.com',
                'sort_order' => 3,
            ],
        ];
        foreach ($offices as $o) {
            Office::create($o);
        }
    }
}
