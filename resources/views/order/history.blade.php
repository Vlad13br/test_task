<!doctype html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-gray-100">

<x-navigation></x-navigation>

    <div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Історія замовлень</h2>

        @forelse ($orders as $order)
            <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Замовлення №{{ $order->id }}</h3>
                <p class="text-gray-600">Статус: {{ $order->shipping_status }}</p>
                <p class="text-gray-600">Спосіб оплати: {{ $order->payment_method ?? 'Не вказано' }}</p>
                <div class="space-y-4 mt-4">
                    @foreach ($order->orderItems as $item)
                        <div class="flex justify-between">
                            <p class="text-gray-700">{{ $item->watcher->product_name }} x{{ $item->quantity }}</p>
                            <p class="text-gray-600">{{ number_format($item->price, 2) }} грн</p>
                        </div>
                    @endforeach
                </div>
                <p class="mt-4 text-lg font-semibold">Загальна сума:
                    {{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 2) }} грн
                </p>
            </div>
        @empty
            <p>У вас немає історії замовлень.</p>
        @endforelse
    </div>
</body>
</html>

