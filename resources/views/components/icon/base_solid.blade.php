<svg {{ $attributes->merge(['class' => 'w-' . $size . ' h-' . $size . ' transition ease-in-out duration-150']) }} fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    {{ $slot }}
</svg>
