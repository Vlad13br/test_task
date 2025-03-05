<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Редагувати Годинник</title>
</head>
<body>
<x-navigation></x-navigation>

<div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
    <h2>Редагувати годинник</h2>

    <form action="{{ route('admin.watchers.update', $watcher->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="product_name" class="block text-sm font-medium text-gray-700">Назва продукту</label>
                <input type="text" name="product_name" id="product_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('product_name', $watcher->product_name) }}" required>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Ціна</label>
                <input type="number" name="price" id="price" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('price', $watcher->price) }}" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Опис</label>
                <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('description', $watcher->description) }}</textarea>
            </div>
            <div>
                <label for="material" class="block text-sm font-medium text-gray-700">Матеріал</label>
                <input type="text" name="material" id="material" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('material', $watcher->material) }}">
            </div>
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Бренд</label>
                <input type="text" name="brand" id="brand" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('brand', $watcher->brand) }}">
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Кількість в наявності</label>
                <input type="number" name="stock" id="stock" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('stock', $watcher->stock) }}" required>
            </div>
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700">URL зображення</label>
                <input type="url" name="image_url" id="image_url" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('image_url', $watcher->image_url) }}">
            </div>

            <button type="submit" class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-md">Оновити</button>
        </div>
    </form>
</div>

</body>
</html>
