<?php

namespace App\Livewire;

use Akaunting\Money\Money;
use App\Actions\CalculateOrderTotalAction;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateOrder extends Component
{
    #[Validate(['required', 'integer', 'exists:products,id'])]
    public ?int $productId = null;

    #[Validate(['required', 'integer', 'min:1'])]
    public ?int $quantity = null;

    #[Validate(['required', 'numeric', 'decimal:0,2', 'min:0.01'])]
    public float|string|null $unitCost = null;

    #[Locked]
    public int $deliveryCharge = 1000;

    #[Locked]
    public ?int $profitMarginPercentage = null;

    public function render()
    {
        return view('livewire.create-order', [
            'products' => Product::orderBy('name')->get(),
            'totalCharge' => $this->totalCharge(),
        ]);
    }

    public function save(): void
    {
        $this->validate();

        Order::create([
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'unit_cost' => Money::GBP($this->unitCost, true),
            'profit_margin_percentage' => $this->profitMarginPercentage,
            'delivery_charge' => Money::GBP($this->deliveryCharge),
            'total_charge' => $this->totalCharge(),
        ]);

        $this->redirect(route('coffee.sales'));
    }

    public function totalCharge(): Money
    {
        $total = Money::GBP(0);

        if (is_null($this->profitMarginPercentage)) {
            return $total;
        }

        if ($this->quantity && $this->unitCost) {
            $total = app(CalculateOrderTotalAction::class)->execute(
                quantity: $this->quantity,
                unitCost: Money::GBP($this->unitCost, true),
                profitMarginPercentage: $this->profitMarginPercentage,
                deliveryCharge: Money::GBP($this->deliveryCharge),
            );
        }

        return $total;
    }

    public function updatedProductId()
    {
        $this->profitMarginPercentage = null;

        if ($this->productId) {
            $product = Product::find($this->productId);

            $this->profitMarginPercentage = $product->profit_margin_percentage;
        }
    }
}
