<div class="flex flex-col gap-2">
    <h2 class="text-lg">{{ __('Previous Sales') }}</h2>

    <table class="w-full bg-white border border-collapse border-gray-300 rounded-md text-left">
        <thead>
            <th class="border border-gray-300 p-2">{{ __('Product') }}</th>
            <th class="border border-gray-300 p-2">{{ __('Quantity') }}</th>
            <th class="border border-gray-300 p-2">{{ __('Unit Cost') }}</th>
            <th class="border border-gray-300 p-2">{{ __('Selling Price') }}</th>
            <th class="border border-gray-300 p-2">{{ __('Sold At') }}</th>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="border border-gray-300 p-2">{{$order->product->name}}</td>
                    <td class="border border-gray-300 p-2">{{$order->quantity}}</td>
                    <td class="border border-gray-300 p-2">{{$order->unit_cost->format()}}</td>
                    <td class="border border-gray-300 p-2">{{$order->total_charge->format()}}</td>
                    <td class="border border-gray-300 p-2">{{$order->created_at->format('Y-m-d H:i')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$orders->links()}}
</div>
