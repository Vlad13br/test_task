<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<x-navigation></x-navigation>
<div class="max-w-6xl mx-auto p-4 bg-gray-100 animate-fadeIn">
    <h2>Admin page</h2>
    <a href="{{ route('admin.users') }}" class="text-blue-600">Користувачі</a>
    <br>
    <a href="{{ route('admin.orders') }}" class="text-blue-600">Замовлення</a>
<br>
    <a href="{{ route('admin.watchers.create') }}" class="text-blue-600">Додати новий годинник</a>
</div>
</body>
</html>
