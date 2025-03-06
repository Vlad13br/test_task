<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 bg-white shadow-md rounded-lg mt-5">
        <h2 class="text-2xl font-bold mb-4">Список користувачів</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">ID</th>
                <th class="border border-gray-300 p-2">Ім'я</th>
                <th class="border border-gray-300 p-2">Прізвище</th>
                <th class="border border-gray-300 p-2">Email</th>
                <th class="border border-gray-300 p-2">Адреса</th>
                <th class="border border-gray-300 p-2">Телефон</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="text-center">
                    <td class="border border-gray-300 p-2">{{ $user->id }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->surname }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->address }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->phone }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
