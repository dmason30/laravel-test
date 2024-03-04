<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Sales Agent',
            'email' => 'sales@coffee.shop',
        ]);

        $this->call(ProductSeeder::class);

        $productIds = Product::query()
            ->take(5)
            ->get()
            ->map(fn (Product $product) => [
                'product_id' => $product->getKey(),
            ])
            ->toArray();

        Order::factory(5)->sequence(...$productIds)->create();
    }
}
