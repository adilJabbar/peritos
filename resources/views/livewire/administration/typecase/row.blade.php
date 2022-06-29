<x-table.row>
    <x-table.cell no-padding>
        <x-input.text wire:model="typecase.name" id="{{$typecase->id}}-name" :error="$errors->first('typecase.name')" placeholder="Nuevo tipo de siniestro"/>
    </x-table.cell>
    <x-table.cell no-padding>
        <x-input.text wire:model="typecase.texts" id="{{$typecase->id}}-texts" />
    </x-table.cell>
    <x-table.cell no-padding class="text-center">
        <x-input.checkbox wire:model="typecase.preexistences" size="6" justify="center" :disabled="!$typecase->ramo->preexistenceClass"  />
    </x-table.cell>
    <x-table.cell no-padding class="text-center">
        <x-input.checkbox wire:model="typecase.tasacion" size="6" justify="center" />
    </x-table.cell>
    <x-table.cell no-padding class="text-center">
        @if($typecase->getKey())
            <x-button.danger wire:click="delete()" size="xs"><x-icon.x size="4" /></x-button.danger>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif
    </x-table.cell>
</x-table.row>
