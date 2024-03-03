<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateOrder;
use App\Models\Order;
use App\Models\Product;
use Livewire\Livewire;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    public function testFormDataIsValidated()
    {
        Livewire::test(CreateOrder::class)
            ->call('save')
            ->assertHasErrors('productId')
            ->assertHasErrors('quantity')
            ->assertHasErrors('unitCost')
            ->assertViewHas('products')
            ->assertViewHas('totalCharge', '£0.00');
    }

    public function testCreatesOrder()
    {
        $product = Product::factory()->create([
            'profit_margin_percentage' => 25,
        ]);

        Livewire::test(CreateOrder::class)
            ->assertSet('productId', null)
            ->assertSet('quantity', null)
            ->assertSet('unitCost', null)
            ->assertSet('profitMarginPercentage', null)
            ->assertViewHas('products')
            ->assertViewHas('totalCharge', '£0.00')
            ->set('productId', $product->getKey())
            ->assertSet('profitMarginPercentage', 25)
            ->set('quantity', 10)
            ->set('unitCost', 12.50)
            ->assertViewHas('products')
            ->assertViewHas('totalCharge', '£176.67')
            ->call('save')
            ->assertRedirect(route('coffee.sales'));

        $order = Order::first();
        $this->assertSame(10, $order->quantity);
        $this->assertSame(12.5, $order->unit_cost->getValue());
        $this->assertSame(25, $order->profit_margin_percentage);
        $this->assertSame(10.0, $order->delivery_charge->getValue());
        $this->assertSame(176.67, $order->total_charge->getValue());
    }
}
