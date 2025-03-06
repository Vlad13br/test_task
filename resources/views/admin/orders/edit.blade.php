<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
        <h2>Edit Order #{{ $order->id }}</h2>

        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mt-4">
                <x-input-label for="shipping_status" class="block">Shipping Status</x-input-label>
                <x-select name="shipping_status" :options="[
                    'pending' => 'Pending',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'canceled' => 'Canceled'
                ]" :selected="$order->shipping_status" />
            </div>

            <div class="mt-4">
                <x-input-label for="payment_method" class="block">Payment Method</x-input-label>
                <x-text-input name="payment_method" id="payment_method" class="w-full p-2"
                              value="{{ old('payment_method', $order->payment_method) }}" />
            </div>

            <div class="mt-4">
                <x-blue-button>Update Order</x-blue-button>
            </div>
        </form>

    </div>
</x-app-layout>
