<?php

namespace App\Livewire;

use App\Livewire\Forms\OrderForm;
use Livewire\Component;

class CreateOrder extends Component
{
    public OrderForm $form;

    public function render()
    {
        return view('livewire.create-order', [
            'totalCharge' => $this->form->totalCharge()->format(),
        ]);
    }

    public function save(): void
    {
        $this->form->store();

        $this->redirect(route('coffee.sales'));
    }
}
