<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Mai Hoàng',
            'email' => 'admin@maihoang.vn',
            'password' => Hash::make('password'),
            'phone' => '0948 490 070',
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $customers = [
            ['name' => 'Nguyễn Văn An', 'email' => 'nguyenvanan@gmail.com', 'phone' => '0901234567', 'address' => '123 Nguyễn Huệ, Q1, TP.HCM'],
            ['name' => 'Trần Thị Bình', 'email' => 'tranthbinh@gmail.com', 'phone' => '0912345678', 'address' => '456 Lê Lợi, Q3, TP.HCM'],
            ['name' => 'Lê Hoàng Cường', 'email' => 'lehoangcuong@gmail.com', 'phone' => '0923456789', 'address' => '789 Pasteur, Q1, TP.HCM'],
            ['name' => 'Phạm Minh Đức', 'email' => 'phamminhduc@gmail.com', 'phone' => '0934567890', 'address' => '321 CMT8, Q10, TP.HCM'],
            ['name' => 'Hoàng Thị Em', 'email' => 'hoangthiem@gmail.com', 'phone' => '0945678901', 'address' => '654 Điện Biên Phủ, Bình Thạnh, TP.HCM'],
            ['name' => 'Vũ Quốc Phong', 'email' => 'vuquocphong@gmail.com', 'phone' => '0956789012', 'address' => '987 Hai Bà Trưng, Q1, TP.HCM'],
            ['name' => 'Đặng Thanh Giang', 'email' => 'dangthanhgiang@gmail.com', 'phone' => '0967890123', 'address' => '147 Võ Văn Tần, Q3, TP.HCM'],
            ['name' => 'Bùi Văn Hải', 'email' => 'buivanhai@gmail.com', 'phone' => '0978901234', 'address' => '258 Nguyễn Đình Chiểu, Q3, TP.HCM'],
        ];

        foreach ($customers as $customer) {
            User::create(array_merge($customer, [
                'password' => Hash::make('password'),
                'role' => 'customer',
                'is_active' => true,
                'email_verified_at' => now(),
            ]));
        }
    }
}
