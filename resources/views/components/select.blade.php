@props(['options' => [], 'selected' => null, 'disabled' => false, 'name'])

<select name="{{ $name }}" @disabled($disabled) {{ $attributes->merge(['class' => 'w-full p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>
