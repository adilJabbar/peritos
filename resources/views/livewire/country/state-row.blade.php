<x-table.row>
    <x-table.cell>
        <x-input.text class="text-center"  wire:model.lazy="state.name" id="name" placeholder="Nombre" />
    </x-table.cell>
    <x-table.cell>
        <x-input.text class="text-center" wire:model.lazy="state.national_adjustment" id="national-adjustment" placeholder="Coeficiente ajuste módulo nacional" />
    </x-table.cell>
    <x-table.cell class="text-center">
        <x-button.danger wire:click="delete()" size="sm"><x-icon.trash size="5" /></x-button.danger>
    </x-table.cell>
</x-table.row>
