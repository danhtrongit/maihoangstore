<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            ['name' => 'Nguyễn Chí Thanh', 'email' => 'thanhnc@company.com', 'phone' => '0901111222', 'subject' => 'Hỏi về máy in mã vạch Zebra', 'message' => 'Tôi cần tư vấn máy in mã vạch Zebra cho nhà máy sản xuất khoảng 5000 tem/ngày. Xin cho báo giá.', 'is_read' => false],
            ['name' => 'Trần Thị Lan', 'email' => 'lanttt@gmail.com', 'phone' => '0912222333', 'subject' => 'Mua số lượng lớn máy quét', 'message' => 'Công ty tôi cần mua 50 máy quét mã vạch cho hệ thống siêu thị. Có chính sách giá đại lý không?', 'is_read' => true, 'reply' => 'Chào chị Lan, cảm ơn chị đã quan tâm. Chúng tôi có chính sách giá đặc biệt cho đơn hàng số lượng lớn. Nhân viên kinh doanh sẽ liên hệ chị trong hôm nay.'],
            ['name' => 'Phạm Đức Minh', 'email' => 'minhpd@logistics.vn', 'phone' => '0923333444', 'subject' => 'Giải pháp kiểm kho cho logistics', 'message' => 'Chúng tôi đang tìm giải pháp PDA kiểm kho phù hợp cho công ty logistics. Có demo được không?', 'is_read' => false],
            ['name' => 'Lê Hồng Sơn', 'email' => 'sonlh@restaurant.com', 'phone' => '0934444555', 'subject' => 'Hỏi máy POS cho nhà hàng', 'message' => 'Tôi muốn mua bộ máy POS tính tiền cho nhà hàng 100 bàn. Tư vấn giúp tôi giải pháp phù hợp.', 'is_read' => false],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
