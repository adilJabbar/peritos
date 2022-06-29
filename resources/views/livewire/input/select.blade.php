<div>
    Search: <input type="text" wire:model="search">
    @foreach($filteredOptions as $key => $value)
        <button
            wire:click="addValue({{ $key }})"
            type="button"
            class="w-full block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
            role="menuitem">{{ $value }}</button>
    @endforeach



</div>
