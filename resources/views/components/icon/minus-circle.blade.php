@props(['size' => 6, 'solid' => false])

@if($solid)
    <x-icon.base_solid size="{{$size}}" class="{{ $attributes['class'] }}">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
    </x-icon.base_solid>
@else
    <x-icon.base size="{{$size}}" class="{{ $attributes['class'] }}">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
    </x-icon.base>
@endif
