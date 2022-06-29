@props(['bg' => false])
<tr {{ $attributes->merge(['class' => ($bg ? 'bg-'.$bg : 'bg-white') ]) }}>
    {{ $slot }}
</tr>
