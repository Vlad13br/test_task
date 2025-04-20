<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <img src="{{ $product->image_url ?? asset('images/default-watch.jpg') }}" alt="{{ $product->product_name }}"
                 class="w-48 h-48 object-cover rounded-lg border">

            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900">{{ $product->product_name }}</h1>
                <p class="text-gray-600 text-sm">Бренд: <span
                        class="font-semibold">{{ $product->brand ?? 'Невідомо' }}</span></p>
                <div class="flex items-center my-2">
                    <span class="text-yellow-400 text-lg">⭐</span>
                    <span class="text-gray-700 ml-1">{{ number_format($product->rating, 1) }} ({{ $product->rating_count }} відгуків)</span>
                </div>

                <p class="text-xl font-semibold text-green-600">
                    {{ number_format($product->price - $product->discount, 2) }} $
                    @if($product->discount > 0)
                        <span class="text-gray-500 line-through text-sm">{{ number_format($product->price, 2) }} $</span>
                    @endif
                </p>

                <p class="mt-2 text-sm text-gray-700">
                    Наявність: <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->stock > 0 ? 'Є в наявності' : 'Немає в наявності' }}
                </span>
                </p>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.watchers.edit', $product->product_id) }}"
                           class="bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-200 mr-2">
                            Edit
                        </a>

                        <form action="{{ route('admin.watchers.destroy', $product->product_id) }}" method="POST"
                              onsubmit="return confirm('Ви впевнені, що хочете видалити цей товар?');"
                              class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors duration-200">
                                Delete
                            </button>
                        </form>

                    @else
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-2 inline-block">
                            @csrf
                            <input type="hidden" name="product[product_id]" value="{{ $product->product_id }}">
                            <input type="hidden" name="product[name]" value="{{ $product->product_name }}">
                            <input type="hidden" name="product[price]" value="{{ $product->price }}">
                            <input type="hidden" name="product[image]" value="{{ $product->image_url }}">

                            <x-primary-button
                                type="submit"
                                class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-200">
                                Add to Cart
                            </x-primary-button>
                        </form>

                    @endif
                @endauth

                @guest
                    <form action="{{ route('cart.add') }}" method="POST" class="mt-2 inline-block">
                        @csrf
                        <x-primary-button
                            type="submit"
                            class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-200"
                            data-product-id="{{ $product->product_id }}"
                            data-product-name="{{ $product->product_name }}"
                            data-product-price="{{ $product->price }}"
                            data-product-image="{{ $product->image_url }}">
                            Add to Cart
                        </x-primary-button>
                    </form>
                @endguest
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-900">Опис</h2>
            <p class="text-gray-700 mt-2">{{ $product->description ?? 'Опис відсутній' }}</p>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900">Відгуки</h2>

            @if($reviews->isEmpty())
                <p class="text-gray-500 mt-2">Відгуків ще немає. Будьте першим, хто залишить відгук!</p>
            @else
                <div class="space-y-4 mt-4">
                    @foreach($reviews as $review)
                        <div class="p-4 rounded-lg bg-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-lg">⭐</span>
                                    <span class="text-gray-800 font-semibold ml-1">{{ number_format($review->rating, 1) }}</span>
                                </div>
                                <span class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($review->review_date)->format('d.m.Y') }}</span>
                            </div>
                            <p class="text-gray-700 mt-2">{{ $review->review_text ?? 'Користувач не залишив коментар' }}</p>

                            @auth
                                @if(auth()->user()->role === 'admin' || auth()->id() === $review->user_id)
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей відгук?');" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 text-sm">Видалити</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @auth
            @if(!$reviews->where('user_id', auth()->id())->count())
                <div class="mt-6">
                    <h2 class="text-lg font-semibold text-gray-900">Залишити відгук</h2>
                    <form action="{{ route('reviews.store', ['product_id' => $product->product_id]) }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                        <x-input-label for="rating">Оцінка</x-input-label>
                        <x-select name="rating" id="rating" class="mt-1 block"
                                  :options="[
                                      '5' => '5 - Відмінно',
                                      '4' => '4 - Добре',
                                      '3' => '3 - Непогано',
                                      '2' => '2 - Погано',
                                      '1' => '1 - Жахливо'
                                  ]"/>

                        <x-input-label for="review_text" class="mt-3">Ваш відгук</x-input-label>
                        <textarea name="review_text" id="review_text" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>

                        <x-blue-button class="mt-3">Надіслати відгук</x-blue-button>
                    </form>
                </div>
            @endif
        @endauth

    </div>
</x-app-layout>
