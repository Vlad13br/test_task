<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
        <h1>Редагувати годинник</h1>

        <form action="{{ route('admin.watchers.update', $watcher->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="product_name" class="block text-sm font-medium text-gray-700">Назва продукту</x-input-label>
                    <x-text-input type="text" name="product_name" id="product_name" class="mt-1 block w-full px-3 py-2" value="{{ old('product_name', $watcher->product_name) }}" required />
                </div>
                <div>
                    <x-input-label for="price" class="block text-sm font-medium text-gray-700">Ціна</x-input-label>
                    <x-text-input type="number" name="price" id="price" class="mt-1 block w-full px-3 py-2" value="{{ old('price', $watcher->price) }}" required />
                </div>
                <div>
                    <x-input-label for="description" class="block text-sm font-medium text-gray-700">Опис</x-input-label>
                    <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border-gray-300 rounded-md">{{ old('description', $watcher->description) }}</textarea>
                </div>
                <div>
                    <x-input-label for="material" class="block text-sm font-medium text-gray-700">Матеріал</x-input-label>
                    <x-text-input type="text" name="material" id="material" class="mt-1 block w-full px-3 py-2" value="{{ old('material', $watcher->material) }}" />
                </div>
                <div>
                    <x-input-label for="brand" class="block text-sm font-medium text-gray-700">Бренд</x-input-label>
                    <x-text-input type="text" name="brand" id="brand" class="mt-1 block w-full px-3 py-2" value="{{ old('brand', $watcher->brand) }}" />
                </div>
                <div>
                    <x-input-label for="stock" class="block text-sm font-medium text-gray-700">Кількість в наявності</x-input-label>
                    <x-text-input type="number" name="stock" id="stock" class="mt-1 block w-full px-3 py-2" value="{{ old('stock', $watcher->stock) }}" required />
                </div>
                <div>
                    <x-input-label for="image_url" class="block text-sm font-medium text-gray-700">URL зображення</x-input-label>
                    <x-text-input type="url" name="image_url" id="image_url" class="mt-1 block w-full px-3 py-2" value="{{ old('image_url', $watcher->image_url) }}" />
                </div>

                <x-blue-button>Оновити</x-blue-button>
            </div>
        </form>
    </div>
</x-app-layout>
