<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['group' => 'general', 'key' => 'site_name', 'value' => 'Mai Hoàng Store', 'type' => 'text', 'label' => 'Tên website'],
            ['group' => 'general', 'key' => 'site_tagline', 'value' => 'Giải pháp thiết bị mã vạch & POS hàng đầu', 'type' => 'text', 'label' => 'Slogan'],
            ['group' => 'general', 'key' => 'site_description', 'value' => 'Mai Hoàng Store - Chuyên cung cấp máy in mã vạch, máy kiểm kho PDA, máy quét mã vạch, máy POS bán hàng chính hãng giá tốt nhất.', 'type' => 'textarea', 'label' => 'Mô tả'],

            // Contact
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '0948 490 070', 'type' => 'text', 'label' => 'Số điện thoại'],
            ['group' => 'contact', 'key' => 'contact_hotline', 'value' => '1900 636 518', 'type' => 'text', 'label' => 'Hotline'],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'info@maihoang.vn', 'type' => 'text', 'label' => 'Email'],
            ['group' => 'contact', 'key' => 'contact_address', 'value' => '123 Nguyễn Thị Minh Khai, Phường Bến Nghé, Quận 1, TP. Hồ Chí Minh', 'type' => 'textarea', 'label' => 'Địa chỉ'],
            ['group' => 'contact', 'key' => 'contact_working_hours', 'value' => 'Thứ 2 - Thứ 7: 8:00 - 17:30', 'type' => 'text', 'label' => 'Giờ làm việc'],

            // Social
            ['group' => 'social', 'key' => 'social_facebook', 'value' => 'https://facebook.com/maihoangstore', 'type' => 'text', 'label' => 'Facebook'],
            ['group' => 'social', 'key' => 'social_youtube', 'value' => 'https://youtube.com/@maihoangstore', 'type' => 'text', 'label' => 'YouTube'],
            ['group' => 'social', 'key' => 'social_zalo', 'value' => '0948490070', 'type' => 'text', 'label' => 'Zalo'],

            // Sales
            ['group' => 'sales', 'key' => 'shipping_fee_default', 'value' => '30000', 'type' => 'text', 'label' => 'Phí ship mặc định'],
            ['group' => 'sales', 'key' => 'free_shipping_threshold', 'value' => '500000', 'type' => 'text', 'label' => 'Miễn phí ship từ'],
            ['group' => 'sales', 'key' => 'bank_info', 'value' => "Ngân hàng: Vietcombank\nSố TK: 1234567890\nChủ TK: CONG TY TNHH MAI HOANG\nChi nhánh: TP.HCM", 'type' => 'textarea', 'label' => 'TK Ngân hàng'],

            // SEO
            ['group' => 'seo', 'key' => 'seo_title', 'value' => 'Mai Hoàng Store - Thiết bị mã vạch, máy POS bán hàng chính hãng', 'type' => 'text', 'label' => 'SEO Title'],
            ['group' => 'seo', 'key' => 'seo_description', 'value' => 'Mai Hoàng Store chuyên cung cấp máy in mã vạch, máy kiểm kho PDA, máy quét mã vạch, máy POS từ Zebra, Honeywell, Datalogic. Bảo hành chính hãng, giao hàng toàn quốc.', 'type' => 'textarea', 'label' => 'SEO Description'],
            ['group' => 'seo', 'key' => 'seo_keywords', 'value' => 'máy in mã vạch, máy quét mã vạch, máy kiểm kho PDA, máy POS bán hàng, Mai Hoàng Store', 'type' => 'text', 'label' => 'SEO Keywords'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
