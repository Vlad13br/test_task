<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
        <h2>Створити новий годинник</h2>

        <form action="{{ route('admin.watchers.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="product_name" class="block text-sm font-medium text-gray-700">Назва продукту</x-input-label>
                    <x-text-input type="text" name="product_name" id="product_name" class="mt-1 block w-full px-3 py-2" required />
                </div>
                <div>
                    <x-input-label for="price" class="block text-sm font-medium text-gray-700">Ціна</x-input-label>
                    <x-text-input type="number" name="price" id="price" class="mt-1 block w-full px-3 py-2" required />
                </div>
                <div>
                    <x-input-label for="description" class="block text-sm font-medium text-gray-700">Опис</x-input-label>
                    <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border-gray-300 rounded-md"></textarea>
                </div>
                <div>
                    <x-input-label for="material" class="block text-sm font-medium text-gray-700">Матеріал</x-input-label>
                    <x-text-input type="text" name="material" id="material" class="mt-1 block w-full px-3 py-2" />
                </div>
                <div>
                    <x-input-label for="brand" class="block text-sm font-medium text-gray-700">Бренд</x-input-label>
                    <x-text-input type="text" name="brand" id="brand" class="mt-1 block w-full px-3 py-2" />
                </div>
                <div>
                    <x-input-label for="stock" class="block text-sm font-medium text-gray-700">Кількість в наявності</x-input-label>
                    <x-text-input type="number" name="stock" id="stock" class="mt-1 block w-full px-3 py-2" required />
                </div>
                <div>
                    <x-input-label for="image_url" class="block text-sm font-medium text-gray-700">URL зображення</x-input-label>
                    <x-text-input type="url" name="image_url" id="image_url" class="mt-1 block w-full px-3 py-2" />
                </div>

                <x-blue-button>Створити</x-blue-button>
            </div>
        </form>
    </div>
</x-app-layout>
