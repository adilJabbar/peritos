<x-button.base {{ $attributes->merge(['class' => 'text-primary bg-white border-transparent hover:bg-secondary hover:text-gray-300 active:bg-secondary  ' . ($attributes['fullWidth'] ? 'w-full' : '')]) }} >{{ $slot }}</x-button.base>

