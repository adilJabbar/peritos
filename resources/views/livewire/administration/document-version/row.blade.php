<x-table.row>
    <x-table.cell noPadding class="p-2">
        <x-input.text wire:model.lazy="document.name" class="text-center" id="document-name-{{$document->id}}" placeholder="Name" :error="$errors->first('document.name')"/>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.text wire:model.lazy="document.path" class="text-center" id="document-path-{{$document->id}}" placeholder="Path in views using dot notation" :error="$errors->first('document.path')"/>
    </x-table.cell>
    <x-table.cell noPadding class="text-center" >
        @if($document->getKey())
            <x-button.danger wire:click="delete()" size="xs"><x-icon.trash size="4" /></x-button.danger>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif

    </x-table.cell>
</x-table.row>
