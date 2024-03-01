<div class="flex flex-col gap-5">
    <x-auth-validation-errors :errors="$errors" />
    <form wire:submit="save" class="grid md:grid-cols-4 gap-2 w-full">
        <div class="flex flex-col">
            <strong>{{ __('Quantity') }}</strong>
            <x-input type="number" step="1" wire:model.live.debounce="form.quantity"/>
        </div>
        <div class="flex flex-col">
            <strong>{{ __('Unit Cost (£)') }}</strong>
            <x-input type="number" step="0.01" wire:model.live.debounce="form.unitCost" />
        </div>
        <div class="flex flex-col gap-2">
            <strong>{{ __('Selling Price') }}</strong>
            <div class="flex h-full">
                {{ $totalCharge }}
            </div>
        </div>
        <div class="flex justify-center items-center">
            <x-button type="submit" class="md:h-1/2 max-w-fit justify-center" wire:loading.attr="disabled">
                {{  __('Record Sales') }}
            </x-button>
        </div>
    </form>
</div>
