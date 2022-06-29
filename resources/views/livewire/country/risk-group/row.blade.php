<x-table.row class="{{ $selected === $group->id ? 'bg-gray-200' : '' }}">
    <x-table.cell>
        <x-input.text wire:model.lazy="group.name" id="group-name-{{$group->id}}" placeholder="Nombre" :error="$errors->first('group.name')"/>
        @if ($errors->first('group.name'))
            <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('group.name') }}</div>
        @endif
    </x-table.cell>
    <x-table.cell class="text-center">
        {{ $group->risksubgroups->count() }}
    </x-table.cell>
    <x-table.cell class="text-center">
        <div class="flex justify-end space-x-2">
            <x-button.primary wire:click="select" size="sm"><x-icon.eye size="5" /></x-button.primary>
            <x-button.danger wire:click="delete" size="sm"><x-icon.trash size="5" /></x-button.danger>
        </div>
    </x-table.cell>
</x-table.row>
