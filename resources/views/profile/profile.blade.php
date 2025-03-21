<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
        <div class="flex flex-wrap gap-6">
            <section class="flex-1 bg-white p-6 rounded-lg shadow-md animate-fadeInUp">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Мій профіль</h2>
                @if(session('success'))
                    <p class="text-green-600">{{ session('success') }}</p>
                @endif
                <form id="profile-form" action="{{ route('profile.update') }}" method="POST" class="grid gap-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label>Ім’я:</x-input-label>
                        <x-text-input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full p-2"/>
                    </div>
                    <div>
                        <x-input-label> Email:</x-input-label>
                        <x-text-input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full p-2"/>
                    </div>
                    <x-blue-button>
                        Зберегти
                    </x-blue-button>
                </form>

                <p id="status-message" class="text-green-600 mt-2 hidden">Зміни збережено!</p>
                <a href="{{ route('order.history') }}"
                   class="mt-4 block text-center bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-700 transition">
                    Переглянути історію замовлень
                </a>

            </section>

            <section class="flex-1 bg-white p-6 rounded-lg shadow-md animate-fadeInUp">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Мій кошик</h2>

                @if(session('cart') && count(session('cart')) > 0)
                    <div class="space-y-6">
                        @foreach($cart as $productId => $item)
                            <div
                                class="cart-item bg-gray-50 p-4 rounded-lg shadow-sm flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600">Ціна: {{ number_format($item['price'], 2) }} грн</p>
                                    <form action="{{ route('cart.update') }}" method="POST" class="mt-2 update-quantity-form">
                                        @csrf
                                        @method('PUT')
                                        <x-input-label for="quantity-{{ $productId }}" class="block text-sm">
                                            Кількість:
                                        </x-input-label>
                                        <x-text-input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                      min="1" id="quantity-{{ $productId }}" class="w-20 p-2"/>
                                        <input type="hidden" name="product_id" value="{{ $productId }}">
                                        <x-blue-button>
                                            Оновити
                                        </x-blue-button>
                                    </form>
                                </div>
                                <form action="{{ route('cart.remove') }}" method="POST" class="delete-item-form" style="display:inline; ">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="product_id" value="{{ $productId }}">
                                    <x-primary-button type="submit"
                                                      class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                        Видалити
                                    </x-primary-button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-summary mt-6 p-4 bg-gray-50 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-700">Загальна сума:</h3>
                        <p class="text-lg text-gray-800">
                            @php
                                $total = 0;
                                foreach ($cart as $item) {
                                    $total += $item['price'] * $item['quantity'];
                                }
                            @endphp
                            {{ number_format($total, 2) }} грн
                        </p>
                        <form action="{{ route('order.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">

                            <div>
                                <x-input-label> Місце доставки:</x-input-label>
                                <x-text-input type="text" name="place" required class="w-full p-2"/>

                            </div>
                            <div>
                                <x-input-label class="mt-4">Метод оплати:</x-input-label>
                                <x-select name="payment_method" required
                                          :options="['card' => 'Картка', 'cash' => 'Готівка']"/>
                            </div>

                            <x-primary-button type="submit"
                                              class="mt-4 bg-green-500 text-white px-6 py-3 rounded hover:bg-green-700 transition">
                                Оформити замовлення
                            </x-primary-button>
                        </form>

                    </div>

                @else
                    <p>Ваш кошик порожній.</p>
                @endif
            </section>

        </div>
    </div>

</x-app-layout>
