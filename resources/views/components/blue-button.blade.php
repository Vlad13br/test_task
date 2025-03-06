<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition']) }}>
    {{ $slot }}
</button>
