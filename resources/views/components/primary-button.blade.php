<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-light-primary']) }}>
    {{ $slot }}
</button>
