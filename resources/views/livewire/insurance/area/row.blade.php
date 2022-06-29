<x-table.row wire:loading.class.delay="opacity-50">
    <x-table.cell noPadding class="p-2">
        <x-input.text wire:model.lazy="area.name" id="area-{{$area->id}}-name" placeholder="Nombre del área o departamento" :error="$errors->first('area.name')"/>
    </x-table.cell>
</x-table.row>
