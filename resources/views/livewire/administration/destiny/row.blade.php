<x-table.row>
    <x-table.cell no-padding class="p-2">
        <x-input.text wire:model="destiny.code" id="{{$destiny->id}}-code" :error="$errors->first('destiny.code')"/>
    </x-table.cell>
    <x-table.cell no-padding>
        <x-input.text wire:model="destiny.name" id="{{$destiny->id}}-name" :error="$errors->first('destiny.name')"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-center">
        @if($destiny->getKey())
            <x-button.danger wire:click="delete()" size="xs"><x-icon.x size="4" /></x-button.danger>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif
    </x-table.cell>
</x-table.row>
