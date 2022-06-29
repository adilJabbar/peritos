<x-table.row>
    <x-table.cell noPadding class="p-2">
        <x-input.text wire:model.lazy="status.order" class="text-center" id="status-order-{{$status->id}}" placeholder="Order" type="number" step="1" :error="$errors->first('status.order')"/>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.text wire:model.lazy="status.name" class="text-center" id="status-name-{{$status->id}}" placeholder="Name" :error="$errors->first('status.name')" />
    </x-table.cell>
    <x-table.cell noPadding class="text-center" >
        @if($status->getKey())
            <x-button.danger wire:click="delete()" size="xs"><x-icon.trash size="4" /></x-button.danger>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif

    </x-table.cell>
</x-table.row>
