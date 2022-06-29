{{--@props(['class' => ' origin-top-right right-10 top-3 w-48 '])--}}
<div x-data="{ open: false }"
     @keydown.escape.stop="open = false"
     @click.away="open = false"
     class="flex-shrink-0 pr-2">
    <button type="button"
            class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
            id="pinned-project-options-menu-0"
            @click="open = !open"
            aria-haspopup="true"
            x-bind:aria-expanded="open">
        <span class="sr-only">{{__('Mostrar resumen')}}</span>
        <x-icon.dots-vertical solid size="5" />
    </button>

    <div x-description="Dropdown menu, show/hide based on menu state."
         x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         {{ $attributes->merge(['class' => ' z-10 mx-3 absolute mt-1 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none' ])}}
{{--         class="z-10 mx-3 absolute  mt-1 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none"--}}
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="pinned-project-options-menu-0"
         style="display: none;">
        {{ $slot }}

    </div>

</div>
