<?php

namespace App\Actions;

use Akaunting\Money\Money;

class CalculateOrderTotalAction
{
    public function execute(
        int $quantity,
        Money $unitCost,
        int $profitMarginPercentage,
        Money $deliveryCharge,
    ): Money {
        $cost = $quantity * $unitCost->getAmount();
        $charge = $cost / (1 - $profitMarginPercentage / 100);
        $total = $charge + $deliveryCharge->getAmount();

        return Money::GBP($total);
    }
}
