<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $goldCoffee = Product::updateOrCreate(
            ['name' => 'Gold Coffee'],
            ['profit_margin_percentage' => 25],
        );

        Product::updateOrCreate(
            ['name' => 'Arabic Coffee'],
            ['profit_margin_percentage' => 15],
        );

        Order::whereNull('product_id')->update([
            'product_id' => $goldCoffee->id,
        ]);
    }
}
