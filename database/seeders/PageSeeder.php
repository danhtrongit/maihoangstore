<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Giới thiệu Mai Hoàng Store',
                'content' => '<h2>Về Mai Hoàng Store</h2><p>Mai Hoàng Store là đơn vị hàng đầu trong lĩnh vực cung cấp thiết bị mã vạch, máy POS bán hàng và giải pháp quản lý kho tại Việt Nam.</p><h3>Sứ mệnh</h3><p>Mang đến cho doanh nghiệp Việt Nam những giải pháp công nghệ mã vạch tiên tiến nhất với giá cả hợp lý và dịch vụ chuyên nghiệp.</p><h3>Tầm nhìn</h3><p>Trở thành nhà phân phối thiết bị mã vạch và giải pháp công nghệ hàng đầu tại Việt Nam và khu vực Đông Nam Á.</p><h3>Giá trị cốt lõi</h3><ul><li>Chất lượng sản phẩm đảm bảo 100% chính hãng</li><li>Dịch vụ hậu mãi chuyên nghiệp, nhanh chóng</li><li>Đội ngũ tư vấn kỹ thuật giàu kinh nghiệm</li><li>Giá cả cạnh tranh nhất thị trường</li></ul>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Chính sách bảo hành',
                'content' => '<h2>Chính Sách Bảo Hành</h2><h3>1. Điều kiện bảo hành</h3><ul><li>Sản phẩm còn trong thời hạn bảo hành ghi trên phiếu</li><li>Tem bảo hành, serial number còn nguyên vẹn</li><li>Sản phẩm bị lỗi kỹ thuật do nhà sản xuất</li></ul><h3>2. Thời gian bảo hành</h3><ul><li>Máy kiểm kho PDA: 12-24 tháng</li><li>Máy in mã vạch: 12-24 tháng</li><li>Máy quét mã vạch: 12 tháng</li><li>Máy POS: 12-24 tháng</li><li>Linh kiện, phụ kiện: 3-6 tháng</li></ul><h3>3. Không bảo hành</h3><ul><li>Hư hỏng do tác động ngoại lực</li><li>Sửa chữa tại nơi không được ủy quyền</li><li>Hết thời hạn bảo hành</li></ul>',
                'sort_order' => 2,
            ],
            [
                'title' => 'Chính sách đổi trả',
                'content' => '<h2>Chính Sách Đổi Trả</h2><h3>1. Điều kiện đổi trả</h3><p>Mai Hoàng Store chấp nhận đổi trả trong vòng 7 ngày kể từ ngày nhận hàng với các điều kiện:</p><ul><li>Sản phẩm còn nguyên seal, chưa sử dụng</li><li>Còn đầy đủ phụ kiện, hộp đựng</li><li>Có hóa đơn mua hàng</li></ul><h3>2. Phí đổi trả</h3><ul><li>Lỗi từ nhà sản xuất: Miễn phí đổi trả</li><li>Đổi ý: Khách hàng chịu phí vận chuyển 2 chiều</li></ul>',
                'sort_order' => 3,
            ],
            [
                'title' => 'Chính sách vận chuyển',
                'content' => '<h2>Chính Sách Vận Chuyển</h2><h3>1. Phạm vi giao hàng</h3><p>Mai Hoàng Store giao hàng trên toàn quốc.</p><h3>2. Thời gian giao hàng</h3><ul><li>Nội thành TP.HCM, Hà Nội: 1-2 ngày</li><li>Các tỉnh thành khác: 2-5 ngày</li></ul><h3>3. Phí vận chuyển</h3><ul><li>Đơn hàng từ 500.000₫: Miễn phí ship nội thành</li><li>Đơn hàng dưới 500.000₫: 30.000₫</li><li>Tỉnh: Theo bảng giá GHTK/GHN</li></ul>',
                'sort_order' => 4,
            ],
            [
                'title' => 'Hướng dẫn mua hàng',
                'content' => '<h2>Hướng Dẫn Mua Hàng</h2><h3>Cách 1: Mua hàng Online</h3><ol><li>Tìm sản phẩm cần mua trên website</li><li>Nhấn "Thêm vào giỏ hàng"</li><li>Vào giỏ hàng, điền thông tin giao hàng</li><li>Chọn phương thức thanh toán</li><li>Xác nhận đơn hàng</li></ol><h3>Cách 2: Mua hàng qua điện thoại</h3><p>Gọi hotline: <strong>0948 490 070</strong></p><h3>Cách 3: Mua trực tiếp</h3><p>Đến showroom Mai Hoàng Store.</p>',
                'sort_order' => 5,
            ],
            [
                'title' => 'Chính sách thanh toán',
                'content' => '<h2>Phương Thức Thanh Toán</h2><h3>1. Thanh toán khi nhận hàng (COD)</h3><p>Khách hàng thanh toán cho nhân viên giao hàng khi nhận sản phẩm.</p><h3>2. Chuyển khoản ngân hàng</h3><p><strong>Ngân hàng:</strong> Vietcombank<br><strong>Số TK:</strong> 1234567890<br><strong>Chủ TK:</strong> CONG TY TNHH MAI HOANG<br><strong>Chi nhánh:</strong> TP.HCM</p><h3>3. Ví điện tử MoMo</h3><p>Quét mã QR hoặc chuyển đến số: 0948 490 070</p>',
                'sort_order' => 6,
            ],
        ];

        foreach ($pages as $page) {
            Page::create(array_merge($page, ['is_active' => true]));
        }
    }
}
