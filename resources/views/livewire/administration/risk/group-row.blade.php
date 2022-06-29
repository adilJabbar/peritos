{{--<x-table.row {{ $selected ? 'class="bg-green"' : '' }} >--}}
<x-table.row bg="{{ $selected ? 'green-200' : '' }}">
    <x-table.cell no-padding class="p-2">
        <x-input.text wire:model="group.name" id="{{$group->id}}-name" :error="$errors->first('group.name')"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-center whitespace-nowrap">
        @if($group->getKey())
            <x-button.danger wire:click="delete()" size="xs"><x-icon.x size="4" /></x-button.danger>
            <x-button.primary wire:click="select()" size="xs"><x-icon.chevron-right size="4" /></x-button.primary>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif
    </x-table.cell>
</x-table.row>
