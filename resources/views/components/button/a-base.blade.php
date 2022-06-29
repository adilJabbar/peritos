@props([
    'href',
    'target' => null
    ])

@php
    switch ($attributes['size'] ?? 'md') {
        case 'xs':
            $size = 'py-1 px-1';
            break;
        case 'sm':
            $size = 'py-2 px-2';
            break;
        case 'md':
        default:
            $size = 'py-2 px-4';
            break;
    }
@endphp

<span class="inline-flex rounded-md shadow-sm {{ $attributes['fullWidth'] ? 'w-full' : '' }}">
    <a
        {{ $attributes->merge([
            'type' => 'button',
            'class' => $size . ' border rounded-md text-xs leading-5 font-semibold uppercase focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition duration-150 ease-in-out disabled:opacity-25' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : '') ,
        ]) }}
        href="{{ $href }}" {{ $target ? 'target=' . $target : ''}}>
{{--            >--}}
        {{ $slot }}
    </a>
</span>
