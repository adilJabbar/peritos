@props(['size' => 6, 'solid' => false])

@if($solid)
    <x-icon.base_solid size="{{$size}}" class="{{ $attributes['class'] }}">
        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
    </x-icon.base_solid>
@else
    <x-icon.base size="{{$size}}" class="{{ $attributes['class'] }}">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
    </x-icon.base>
@endif
