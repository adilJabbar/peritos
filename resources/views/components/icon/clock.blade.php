@props(['size' => 6, 'solid' => false])

@if($solid)
    <x-icon.base_solid size="{{$size}}" class="{{ $attributes['class'] }}">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
    </x-icon.base_solid>
@else
    <x-icon.base size="{{$size}}" class="{{ $attributes['class'] }}">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </x-icon.base>
@endif
