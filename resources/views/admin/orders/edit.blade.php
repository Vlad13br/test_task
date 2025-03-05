<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Order</title>
</head>
<body>
<x-navigation></x-navigation>
<div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
    <h2>Edit Order #{{ $order->id }}</h2>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mt-4">
            <label for="shipping_status" class="block">Shipping Status</label>
            <select name="shipping_status" id="shipping_status" class="mt-2 p-2 border border-gray-300 rounded">
                <option value="pending" {{ $order->shipping_status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="shipped" {{ $order->shipping_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ $order->shipping_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="canceled" {{ $order->shipping_status === 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <div class="mt-4">
            <label for="payment_method" class="block">Payment Method</label>
            <input type="text" name="payment_method" id="payment_method" class="mt-2 p-2 border border-gray-300 rounded" value="{{ old('payment_method', $order->payment_method) }}">
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Order</button>
        </div>
    </form>

</div>
</body>
</html>
