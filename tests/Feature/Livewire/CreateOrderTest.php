<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateOrder;
use App\Models\Order;
use Livewire\Livewire;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    public function testFormDataIsValidated()
    {
        Livewire::test(CreateOrder::class)
            ->call('save')
            ->assertHasErrors('form.quantity')
            ->assertHasErrors('form.unitCost')
            ->assertViewHas('totalCharge', '£0.00');
    }

    public function testCreatesOrder()
    {
        Livewire::test(CreateOrder::class)
            ->assertSet('form.quantity', null)
            ->assertSet('form.unitCost', null)
            ->assertViewHas('totalCharge', '£0.00')
            ->set('form.quantity', 10)
            ->set('form.unitCost', 12.50)
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
