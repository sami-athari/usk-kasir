<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset Database
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ==========================================
        // INPUT PRODUK DENGAN STOK
        // ==========================================

        Product::create(['name' => 'Espresso Single', 'price' => 15000, 'stock' => 50, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Iced Americano', 'price' => 18000, 'stock' => 60, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Kopi Susu Gula Aren', 'price' => 25000, 'stock' => 40, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Caffe Latte', 'price' => 28000, 'stock' => 45, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Signature Dark Chocolate', 'price' => 28000, 'stock' => 35, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Uji Matcha Latte', 'price' => 30000, 'stock' => 30, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Iced Lemon Tea', 'price' => 18000, 'stock' => 50, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Iced Green Tea', 'price' => 16000, 'stock' => 55, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'French Toast', 'price' => 35000, 'stock' => 25, 'image' => null, 'is_available' => true]);
        Product::create(['name' => 'Crispy Potato Wedges', 'price' => 22000, 'stock' => 40, 'image' => null, 'is_available' => true]);
    }
}
