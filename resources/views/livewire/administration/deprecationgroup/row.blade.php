<x-table.row>
    <x-table.cell no-padding>
        <x-input.text wire:model.lazy="deprecationgroup.name" id="{{$deprecationgroup->id}}-name" :error="$errors->first('deprecationgroup.name')" placeholder="Nuevo tipo de siniestro"/>
    </x-table.cell>
    <x-table.cell no-padding>
        <x-input.text class="text-right" wire:model="deprecationgroup.estimated_years" id="{{$deprecationgroup->id}}-estimated_years" :error="$errors->first('deprecationgroup.estimated_years')" placeholder="Amortización"/>
    </x-table.cell>
    <x-table.cell no-padding>
        <x-input.text class="text-right" wire:model="deprecationgroup.residual_percent" id="{{$deprecationgroup->id}}-residual_percent" :error="$errors->first('deprecationgroup.residual_percent')" placeholder="Valor residual"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-center">
        @if($deprecationgroup->getKey())
            <x-button.danger wire:click="delete()" size="xs"><x-icon.x size="4" /></x-button.danger>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif
    </x-table.cell>
</x-table.row>

