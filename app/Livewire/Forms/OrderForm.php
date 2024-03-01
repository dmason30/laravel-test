<?php

namespace App\Livewire\Forms;

use Akaunting\Money\Money;
use App\Actions\CalculateOrderTotalAction;
use App\Models\Order;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderForm extends Form
{
    #[Validate(['required', 'integer', 'min:1'])]
    public ?int $quantity = null;

    #[Validate(['required', 'numeric', 'decimal:0,2', 'min:0.01'])]
    public float|string|null $unitCost = null;

    #[Locked]
    public int $deliveryCharge = 1000;

    #[Locked]
    public int $profitMarginPercentage = 25;

    public function store(): void
    {
        $this->validate();

        Order::create([
            'quantity' => $this->quantity,
            'unit_cost' => Money::GBP($this->unitCost, true),
            'profit_margin_percentage' => $this->profitMarginPercentage,
            'delivery_charge' => Money::GBP($this->deliveryCharge),
        ]);
    }

    public function totalCharge(): string
    {
        $total = Money::GBP(0);

        if ($this->quantity && $this->unitCost) {
            $total = app(CalculateOrderTotalAction::class)->execute(
                quantity: $this->quantity,
                unitCost: Money::GBP($this->unitCost, true),
                profitMarginPercentage: $this->profitMarginPercentage,
                deliveryCharge: Money::GBP($this->deliveryCharge),
            );
        }

        return $total->format();
    }
}
