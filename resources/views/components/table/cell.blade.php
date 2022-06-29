@props(['noPadding' => false])
<td {{ $attributes->merge(['class' => ($noPadding ? '' : 'px-6 py-4') . ' whitespace-no-wrap text-sm leading-5 text-cool-gray-900']) }}>
    {{ $slot }}
</td>
