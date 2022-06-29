@props([
    'href',
    'target' => null
    ])

<x-button.a-base {{ $attributes->merge(['class' => 'text-white bg-primary border-transparent hover:bg-secondary hover:text-gray-800 active:bg-secondary  ' . ($attributes['fullWidth'] ? 'w-full' : '')]) }} href="{{$href}}" target="{{$target}}">
    {{ $slot }}
</x-button.a-base>

