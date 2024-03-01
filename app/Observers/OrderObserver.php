<?php

namespace App\Observers;

use App\Actions\CalculateOrderTotalAction;
use App\Models\Order;

class OrderObserver
{
    public function __construct(private CalculateOrderTotalAction $calculateOrderTotalAction)
    {
    }

    public function saving(Order $order)
    {
        $order->total_charge = $this->calculateOrderTotalAction->execute(
            quantity: $order->quantity,
            unitCost: $order->unit_cost,
            profitMarginPercentage: $order->profit_margin_percentage,
            deliveryCharge: $order->delivery_charge,
        );
    }
}
