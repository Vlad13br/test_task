<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<x-navigation></x-navigation>
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="flex flex-col md:flex-row items-center gap-6">
        <img src="{{ $watch->image_url ?? asset('images/default-watch.jpg') }}" alt="{{ $watch->product_name }}"
             class="w-48 h-48 object-cover rounded-lg border">

        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-900">{{ $watch->product_name }}</h1>
            <p class="text-gray-600 text-sm">Бренд: <span class="font-semibold">{{ $watch->brand ?? 'Невідомо' }}</span></p>
            <p class="text-gray-600 text-sm">Матеріал: <span class="font-semibold">{{ $watch->material ?? 'Невідомо' }}</span></p>

            <div class="flex items-center my-2">
                <span class="text-yellow-400 text-lg">⭐</span>
                <span class="text-gray-700 ml-1">{{ number_format($watch->rating, 1) }} ({{ $watch->rating_count }} відгуків)</span>
            </div>

            <p class="text-xl font-semibold text-green-600">
                {{ number_format($watch->price - $watch->discount, 2) }} $
                @if($watch->discount > 0)
                    <span class="text-gray-500 line-through text-sm">{{ number_format($watch->price, 2) }} $</span>
                @endif
            </p>

            <p class="mt-2 text-sm text-gray-700">
                Наявність: <span class="{{ $watch->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $watch->stock > 0 ? 'Є в наявності' : 'Немає в наявності' }}
                </span>
            </p>
            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="product[id]" value="{{ $watch->id }}">
                <input type="hidden" name="product[name]" value="{{ $watch->product_name }}">
                <input type="hidden" name="product[price]" value="{{ $watch->price }}">
                <input type="hidden" name="product[image]" value="{{ $watch->image_url }}">

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.watchers.edit', $watch->id) }}"
                           class="bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-200">
                            Edit
                        </a>
                    @else
                        <x-primary-button
                            class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-200">
                            Add to Cart
                        </x-primary-button>
                    @endif
                @endauth

                @guest
                    <x-primary-button
                        class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-200">
                        Add to Cart
                    </x-primary-button>
                @endguest
            </form>
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-900">Опис</h2>
        <p class="text-gray-700 mt-2">{{ $watch->description ?? 'Опис відсутній' }}</p>
    </div>

    <div class="mt-8">
        <h2 class="text-lg font-semibold text-gray-900">Відгуки</h2>

        @if($reviews->isEmpty())
            <p class="text-gray-500 mt-2">Відгуків ще немає. Будьте першим, хто залишить відгук!</p>
        @else
            <div class="space-y-4 mt-4">
                @foreach($reviews as $review)
                    @php
                        $isUserReview = auth()->check() && $review->user_id === auth()->id();
                    @endphp
                    <div class="p-4 rounded-lg {{ $isUserReview ? 'bg-blue-100 border border-blue-500' : 'bg-gray-100' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-yellow-400 text-lg">⭐</span>
                                <span class="text-gray-800 font-semibold ml-1">{{ number_format($review->rating, 1) }}</span>
                            </div>
                            <span class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($review->review_date)->format('d.m.Y') }}</span>
                        </div>
                        <p class="text-gray-700 mt-2">{{ $review->review_text ?? 'Користувач не залишив коментар' }}</p>

                        @if($isUserReview)
                            <span class="text-xs text-blue-700 font-semibold">Ваш відгук</span>
                        @endif
                    </div>
                @endforeach

            </div>
        @endif
    </div>

    @if(auth()->check() && !$reviews->where('user_id', auth()->id())->count())
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-900">Залишити відгук</h2>
            <form action="{{ route('reviews.store', ['watcher_id' => $watch->id]) }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="watcher_id" value="{{ $watch->id }}">


                <label for="rating" class="block text-sm font-medium text-gray-700">Оцінка</label>
                <select name="rating" id="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="5">5 - Відмінно</option>
                    <option value="4">4 - Добре</option>
                    <option value="3">3 - Непогано</option>
                    <option value="2">2 - Погано</option>
                    <option value="1">1 - Жахливо</option>
                </select>

                <label for="review_text" class="block mt-2 text-sm font-medium text-gray-700">Ваш відгук</label>
                <textarea name="review_text" id="review_text" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>

                <button type="submit"
                        class="mt-3 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-200">
                    Надіслати відгук
                </button>
            </form>
        </div>
    @endif

</div>

</body>
</html>
