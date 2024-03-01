<?php

namespace Tests\Unit\Actions;

use Akaunting\Money\Money;
use App\Actions\CalculateOrderTotalAction;
use Tests\TestCase;

class CalculateOrderTotalActionTest extends TestCase
{
    public function testExecuteWithZeroProfitMarginPercentage()
    {
        $action = new CalculateOrderTotalAction();

        $result = $action->execute(
            quantity: 5,
            unitCost: Money::GBP(1000),
            profitMarginPercentage: 0,
            deliveryCharge: Money::GBP(500),
        );

        $this->assertSame(55.0, $result->getValue());
    }

    public function testExecuteWithOneQuantity()
    {
        $action = new CalculateOrderTotalAction();

        $result = $action->execute(
            quantity: 1,
            unitCost: Money::GBP(1, true),
            profitMarginPercentage: 0,
            deliveryCharge: Money::GBP(500),
        );

        $this->assertSame(6.0, $result->getValue());
    }

    public function testExecuteWithMultipleQuantity()
    {
        $action = new CalculateOrderTotalAction();

        $result = $action->execute(
            quantity: 5,
            unitCost: Money::GBP(1000),
            profitMarginPercentage: 10,
            deliveryCharge: Money::GBP(500),
        );

        $this->assertSame(60.56, $result->getValue());
    }
}
