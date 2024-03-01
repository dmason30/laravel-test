<?php

namespace Tests\Unit\Observers;

use Akaunting\Money\Money;
use App\Actions\CalculateOrderTotalAction;
use App\Models\Order;
use Tests\TestCase;

class OrderObserverTest extends TestCase
{
    public function testSaving()
    {
        $this->mock(CalculateOrderTotalAction::class)
            ->expects('execute')
            ->andReturn(Money::GBP(10412));

        $order = Order::factory()->create();

        $this->assertSame(104.12, $order->total_charge->getValue());
    }
}
