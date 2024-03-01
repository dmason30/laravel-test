<?php

namespace Database\Factories;

use Akaunting\Money\Money;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_cost' => Money::GBP($this->faker->numberBetween(5000, 30000)),
            'delivery_charge' => Money::GBP($this->faker->numberBetween(10000, 20000)),
            'profit_margin_percentage' => $this->faker->numberBetween(10, 30),
            'total_charge' => Money::GBP($this->faker->numberBetween(50000, 100000)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
