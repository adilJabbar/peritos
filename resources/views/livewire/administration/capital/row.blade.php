{{--<x-table.row>--}}
<x-table.row>
    <x-table.cell no-padding class="p-2">
{{--        <x-input.text wire:model="capital.name" id="capital-" :error="$errors->first('capital.name')"/>--}}
        <x-input.text wire:model="capital.name" id="capital-{{$capital->id}}-name" :error="$errors->first('capital.name')" placeholder="Nombre del capital"/>
    </x-table.cell>
    <x-table.cell no-padding class="p-2">
{{--        <x-input.text wire:model="capital.name" id="capital-" :error="$errors->first('capital.name')"/>--}}
        <x-input.select wire:model="capital.predefined" id="capital-{{$capital->id}}-predefined" :error="$errors->first('capital.predefined')" placeholder="Selecciona solo si el capital corresponde con un capital por defecto">
            <option value="">{{__('Ninguno')}}</option>
            <option value="continente">{{__('Continente')}}</option>
            <option value="contenido">{{__('Contenido')}}</option>
            <option value="responsabilidad civil">{{__('Responsabilidad Civil')}}</option>
        </x-input.select>
    </x-table.cell>
    <x-table.cell no-padding class="whitespace-nowrap text-center pr-2">
        @if($capital->getKey())
            <x-button.secondary wire:click="moveUp" size="xs"><x-icon.chevron-up size="4" /></x-button.secondary>
            <x-button.secondary wire:click="moveDown" size="xs"><x-icon.chevron-down  size="4" /></x-button.secondary>
            <x-button.danger wire:click="delete()" size="xs" class="ml-2"><x-icon.x size="4" /></x-button.danger>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif
    </x-table.cell>
</x-table.row>
