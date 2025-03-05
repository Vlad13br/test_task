<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Watcher</title>
</head>
<body>
<x-navigation></x-navigation>

<div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
    <h2>Створити новий годинник</h2>

    <form action="{{ route('admin.watchers.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="product_name" class="block text-sm font-medium text-gray-700">Назва продукту</label>
                <input type="text" name="product_name" id="product_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Ціна</label>
                <input type="number" name="price" id="price" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Опис</label>
                <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
            </div>
            <div>
                <label for="material" class="block text-sm font-medium text-gray-700">Матеріал</label>
                <input type="text" name="material" id="material" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Бренд</label>
                <input type="text" name="brand" id="brand" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Кількість в наявності</label>
                <input type="number" name="stock" id="stock" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700">URL зображення</label>
                <input type="url" name="image_url" id="image_url" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>

            <button type="submit" class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-md">Створити</button>
        </div>
    </form>
</div>

</body>
</html>
