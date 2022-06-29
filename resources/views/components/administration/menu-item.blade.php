@props(['label', 'name', 'badge' => null, 'isActive' => false, 'icon' => 'home'])

<a href="#" wire:click="$set('showSubmenu', '{{ $name }}')" {{$attributes}}
   class="flex items-center px-3 py-2 space-x-2 justify-between {{ $isActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
   aria-current="page">
    <div class="flex space-x-2 items-center text-sm font-medium">
        <x-dynamic-component component="icon.{{ $icon }}" class="{{ $isActive ? 'text-gray-500 ' : 'text-gray-400' }}" />
        <span class="truncate">
          {{__($label)}}
        </span>
    </div>
    @if($badge)
        <span class="ml-auto inline-block py-0.5 px-3 text-xs rounded-full {{ $isActive ? 'bg-gray-50  ' : 'bg-gray-200 text-gray-600' }}">
            {{ $badge }}
        </span>
    @endif
</a>
