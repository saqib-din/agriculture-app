@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-md text-light-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
