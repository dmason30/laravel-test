<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ListOrders;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;
use Tests\TestCase;

class ListOrdersTest extends TestCase
{
    public function testNoOrdersExist()
    {
        $orders = Livewire::test(ListOrders::class)
            ->assertViewHas('orders')
            ->viewData('orders');

        $this->assertCount(0, $orders);
    }

    public function testFindsOrders()
    {
        Order::factory(6)->create();

        /** @var LengthAwarePaginator $orders */
        $orders = Livewire::test(ListOrders::class)
            ->assertViewHas('orders')
            ->viewData('orders');

        $this->assertCount(5, $orders);
        $this->assertTrue($orders->hasMorePages());
    }
}
