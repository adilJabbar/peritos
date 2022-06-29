<span class="inline-flex rounded-md shadow-sm flex-grow">
    <button wire:click="$set('showSubmenu', '{{ $menu }}')"
        {{ $attributes->merge([
            'type' => 'button',
            'class' => 'py-2 px-4 border rounded-md text-xs leading-5 font-semibold uppercase focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition duration-150 ease-in-out disabled:opacity-25 w-full' . ($showSubMenu === $menu ? ' bg-primary text-white' : ' bg-white ')
        ]) }}
    >
        {{ $slot }}
    </button>
</span>
