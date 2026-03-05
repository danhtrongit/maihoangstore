<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $categories = [
            ['name' => 'Tin tức công nghệ', 'sort_order' => 1],
            ['name' => 'Hướng dẫn sử dụng', 'sort_order' => 2],
            ['name' => 'Đánh giá sản phẩm', 'sort_order' => 3],
            ['name' => 'Khuyến mãi', 'sort_order' => 4],
            ['name' => 'Kiến thức mã vạch', 'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            PostCategory::create(array_merge($cat, ['is_active' => true]));
        }

        $tinTuc = PostCategory::where('name', 'Tin tức công nghệ')->first();
        $huongDan = PostCategory::where('name', 'Hướng dẫn sử dụng')->first();
        $danhGia = PostCategory::where('name', 'Đánh giá sản phẩm')->first();
        $kienThuc = PostCategory::where('name', 'Kiến thức mã vạch')->first();

        $posts = [
            [
                'title' => 'Hướng dẫn chọn mua máy in mã vạch phù hợp cho doanh nghiệp',
                'post_category_id' => $huongDan->id,
                'excerpt' => 'Bài viết hướng dẫn chi tiết cách chọn máy in mã vạch phù hợp với nhu cầu sử dụng, ngân sách và quy mô doanh nghiệp.',
                'content' => '<h2>Cách chọn máy in mã vạch</h2><p>Việc chọn mua máy in mã vạch phù hợp là rất quan trọng cho doanh nghiệp. Dưới đây là các tiêu chí cần xem xét:</p><h3>1. Công nghệ in</h3><p>Có 2 công nghệ chính: In nhiệt trực tiếp và In truyền nhiệt. Mỗi loại có ưu nhược điểm riêng.</p><h3>2. Độ phân giải</h3><p>Thường có 203dpi, 300dpi và 600dpi. Chọn phù hợp với kích thước tem nhãn.</p><h3>3. Tốc độ in</h3><p>Tùy theo nhu cầu in số lượng ít hay nhiều.</p>',
                'is_featured' => true,
                'views' => 1250,
            ],
            [
                'title' => 'So sánh chi tiết Zebra MC3300x và Honeywell CT60 XP',
                'post_category_id' => $danhGia->id,
                'excerpt' => 'So sánh 2 máy kiểm kho PDA hàng đầu: Zebra MC3300x và Honeywell CT60 XP từ thiết kế, hiệu năng đến giá cả.',
                'content' => '<h2>So sánh Zebra MC3300x vs Honeywell CT60 XP</h2><p>Cả hai đều là PDA kiểm kho cao cấp, phù hợp cho doanh nghiệp lớn.</p><table><tr><th>Tiêu chí</th><th>Zebra MC3300x</th><th>Honeywell CT60 XP</th></tr><tr><td>Giá</td><td>22.500.000₫</td><td>28.000.000₫</td></tr><tr><td>Màn hình</td><td>4.0 inch</td><td>4.7 inch</td></tr><tr><td>Pin</td><td>7000mAh</td><td>4040mAh</td></tr></table>',
                'is_featured' => true,
                'views' => 890,
            ],
            [
                'title' => 'Mã vạch là gì? Phân loại và ứng dụng mã vạch trong quản lý',
                'post_category_id' => $kienThuc->id,
                'excerpt' => 'Tìm hiểu về mã vạch, các loại mã vạch phổ biến (1D, 2D, QR Code) và ứng dụng trong quản lý doanh nghiệp.',
                'content' => '<h2>Mã vạch là gì?</h2><p>Mã vạch (barcode) là phương pháp lưu trữ dữ liệu dưới dạng hình ảnh có thể đọc được bằng máy quét.</p><h3>Các loại mã vạch phổ biến</h3><ul><li><strong>Mã vạch 1D:</strong> Code 128, Code 39, EAN-13, UPC</li><li><strong>Mã vạch 2D:</strong> QR Code, DataMatrix, PDF417</li></ul>',
                'is_featured' => false,
                'views' => 2100,
            ],
            [
                'title' => 'Top 5 máy quét mã vạch bán chạy nhất 2026',
                'post_category_id' => $tinTuc->id,
                'excerpt' => 'Tổng hợp 5 máy quét mã vạch bán chạy nhất tại Mai Hoàng Store trong năm 2026.',
                'content' => '<h2>Top 5 máy quét mã vạch bán chạy</h2><p>Danh sách được tổng hợp dựa trên số lượng bán ra và đánh giá của khách hàng.</p><ol><li>Honeywell Voyager 1472g</li><li>Newland HR22 Dorada II</li><li>Zebra DS2208</li><li>Datalogic QuickScan QD2590</li><li>Zebra DS2278</li></ol>',
                'is_featured' => true,
                'views' => 560,
            ],
            [
                'title' => 'Hướng dẫn cài đặt và sử dụng máy in Epson TM-T82III',
                'post_category_id' => $huongDan->id,
                'excerpt' => 'Hướng dẫn từng bước cài đặt driver và sử dụng máy in hóa đơn Epson TM-T82III.',
                'content' => '<h2>Cài đặt Epson TM-T82III</h2><h3>Bước 1: Tải driver</h3><p>Truy cập website Epson để tải driver mới nhất.</p><h3>Bước 2: Kết nối máy in</h3><p>Kết nối cáp USB hoặc Ethernet vào máy tính.</p><h3>Bước 3: Cài đặt driver</h3><p>Chạy file setup và làm theo hướng dẫn.</p>',
                'is_featured' => false,
                'views' => 780,
            ],
            [
                'title' => 'Giải pháp quản lý kho bằng mã vạch cho doanh nghiệp vừa và nhỏ',
                'post_category_id' => $kienThuc->id,
                'excerpt' => 'Tại sao doanh nghiệp vừa và nhỏ nên áp dụng hệ thống quản lý kho bằng mã vạch?',
                'content' => '<h2>Quản lý kho bằng mã vạch</h2><p>Hệ thống quản lý kho bằng mã vạch giúp tối ưu hóa quy trình xuất nhập kho, giảm sai sót và tiết kiệm thời gian.</p><h3>Lợi ích</h3><ul><li>Giảm 90% lỗi nhập liệu</li><li>Tăng 50% tốc độ kiểm kê</li><li>Theo dõi realtime hàng tồn kho</li></ul>',
                'is_featured' => false,
                'views' => 1500,
            ],
        ];

        foreach ($posts as $post) {
            Post::create(array_merge($post, [
                'user_id' => $admin->id,
                'is_active' => true,
                'published_at' => now()->subDays(rand(1, 60)),
            ]));
        }
    }
}
