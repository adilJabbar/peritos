<svg {{ $attributes->merge(['class' => 'w-' . $size . ' h-' . $size . ' transition ease-in-out duration-150']) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
    {{ $slot }}
</svg>
