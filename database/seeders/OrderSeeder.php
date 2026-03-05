<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();
        $statuses = ['pending', 'confirmed', 'processing', 'shipping', 'delivered', 'cancelled'];
        $paymentMethods = ['cod', 'bank_transfer', 'momo'];
        $paymentStatuses = ['pending', 'paid'];

        for ($i = 0; $i < 25; $i++) {
            $customer = $customers->random();
            $status = $statuses[array_rand($statuses)];
            $paymentStatus = $status === 'delivered' ? 'paid' : $paymentStatuses[array_rand($paymentStatuses)];

            $order = Order::create([
                'order_number' => 'MH' . now()->subDays(rand(0, 30))->format('ymd') . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'user_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'customer_phone' => $customer->phone,
                'shipping_address' => $customer->address ?? '123 Đường ABC, Q1, TP.HCM',
                'status' => $status,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_status' => $paymentStatus,
                'subtotal' => 0,
                'shipping_fee' => rand(0, 1) ? 30000 : 0,
                'discount' => 0,
                'total' => 0,
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);

            $itemCount = rand(1, 3);
            $subtotal = 0;

            for ($j = 0; $j < $itemCount; $j++) {
                $product = $products->random();
                $qty = rand(1, 3);
                $price = $product->current_price;
                $itemSubtotal = $price * $qty;
                $subtotal += $itemSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'price' => $price,
                    'quantity' => $qty,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $order->shipping_fee - $order->discount,
            ]);
        }
    }
}
