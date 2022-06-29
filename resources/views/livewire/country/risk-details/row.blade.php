<x-table.row>
    <x-table.cell class="pl-2" noPadding>
        <x-input.text wire:model.lazy="detail.description" id="detail-description-{{$detail->id}}" placeholder="Nombre" :error="$errors->first('detail.description')"/>
        @if ($errors->first('detail.description'))
            <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('detail.description') }}</div>
        @endif
    </x-table.cell>
    <x-table.cell class="w-28" noPadding>
        <x-input.text class="text-center" type="number" step="0.0001" wire:model.lazy="detail.national_modificator" id="detail-national_modificator-{{$detail->id}}" placeholder="Coeficiente"  :error="$errors->first('detail.national_modificator')"/>
        @if ($errors->first('detail.national_modificator'))
            <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('detail.national_modificator') }}</div>
        @endif
    </x-table.cell>
    <x-table.cell class="w-28" noPadding>
        <x-input.text class="text-center" type="number" step="0.0001" wire:model.lazy="detail.vpo_modificator" id="detail-vpo_modificator-{{$detail->id}}" placeholder="VPO"  :error="$errors->first('detail.vpo_modificator')"/>
        @if ($errors->first('detail.vpo_modificator'))
            <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('detail.vpo_modificator') }}</div>
        @endif
    </x-table.cell>
    <x-table.cell class="w-28" noPadding>
        <x-input.text class="text-center" type="number" step="0.0001" wire:model.lazy="detail.low_modificator" id="detail-low_modificator-{{$detail->id}}" placeholder="Baja"  :error="$errors->first('detail.low_modificator')"/>
        @if ($errors->first('detail.low_modificator'))
            <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('detail.low_modificator') }}</div>
        @endif
    </x-table.cell>
    <x-table.cell class="w-28" noPadding>
        <x-input.text class="text-center" type="number" step="0.0001" wire:model.lazy="detail.high_modificator" id="detail-high_modificator-{{$detail->id}}" placeholder="Alta"  :error="$errors->first('detail.high_modificator')"/>
        @if ($errors->first('detail.high_modificator'))
            <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('detail.high_modificator') }}</div>
        @endif
    </x-table.cell>
    <x-table.cell class="w-28" noPadding>
        <x-input.text class="text-center" type="number" step="0.0001" wire:model.lazy="detail.luxe_modificator" id="detail-luxe_modificator-{{$detail->id}}" placeholder="Lujo"  :error="$errors->first('detail.luxe_modificator')"/>
        @if ($errors->first('detail.luxe_modificator'))
            <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('detail.luxe_modificator') }}</div>
        @endif
    </x-table.cell>
    <x-table.cell class="w-16 pr-2" noPadding>
        <div class="flex justify-end space-x-2">
            <x-button.danger wire:click="delete" size="xs"><x-icon.trash size="5" /></x-button.danger>
        </div>
    </x-table.cell>
</x-table.row>
