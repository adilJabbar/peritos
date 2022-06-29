<x-button.base {{ $attributes->merge(['class' => 'text-white bg-primary border-transparent hover:bg-secondary hover:text-gray-800 active:bg-secondary  ' . ($attributes['fullWidth'] ? 'w-full' : '')]) }} >{{ $slot }}</x-button.base>

