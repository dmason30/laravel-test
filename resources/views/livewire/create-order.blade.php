<div class="flex flex-col gap-5">
    <x-auth-validation-errors :errors="$errors"/>
    <form wire:submit="save" class="grid w-full gap-2 md:grid-cols-5">
        <div class="flex flex-col">
            <strong>{{ __('Product') }}</strong>
            <x-select wire:model.live="productId">
                <option value="">{{ __('-- please select --') }}</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </x-select>
        </div>
        <div class="flex flex-col">
            <strong>{{ __('Quantity') }}</strong>
            <x-input type="number" step="1" wire:model.live.debounce="quantity"/>
        </div>
        <div class="flex flex-col">
            <strong>{{ __('Unit Cost (£)') }}</strong>
            <x-input type="number" step="0.01" wire:model.live.debounce="unitCost"/>
        </div>
        <div class="flex flex-col gap-2">
            <strong>{{ __('Selling Price') }}</strong>
            <div class="flex h-full">
                {{ $totalCharge }}
            </div>
        </div>
        <div class="flex items-center justify-center">
            <x-button type="submit" class="max-w-fit justify-center md:h-1/2" wire:loading.attr="disabled">
                {{  __('Record Sales') }}
            </x-button>
        </div>
    </form>
</div>
