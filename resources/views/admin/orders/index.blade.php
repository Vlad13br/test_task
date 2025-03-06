<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
        <h2>Admin - Orders</h2>

        <table class="min-w-full bg-white border border-gray-200 mt-4">
            <thead>
            <tr>
                <th class="px-4 py-2 border-b">Order ID</th>
                <th class="px-4 py-2 border-b">User</th>
                <th class="px-4 py-2 border-b">Total Price</th>
                <th class="px-4 py-2 border-b">Shipping Status</th>
                <th class="px-4 py-2 border-b">Items</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $order->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $order->user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $order->total_price }} USD</td>
                    <td class="px-4 py-2 border-b">{{ $order->shipping_status }}</td>
                    <td class="px-4 py-2 border-b">
                        <ul>
                            @foreach($order->orderItems as $item)
                                <li>
                                    {{ $item->watcher->product_name }} (x{{ $item->quantity }}) - {{ $item->price }} USD
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-2 border-b">
                        <a href="{{ route('admin.orders.edit', $order) }}" class="text-blue-500">Edit</a>
                    </td>
                    <td class="px-4 py-2 border-b">
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                              onsubmit="return confirm('Ви впевнені, що хочете видалити це замовлення?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
