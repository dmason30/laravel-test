<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrders extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.list-orders', [
            'orders' => Order::query()->latest()->paginate(5),
        ]);
    }
}
