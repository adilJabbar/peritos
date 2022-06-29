<x-table.row>
    <x-table.cell no-padding class="p-2">
        <x-input.text wire:model="detail.description" id="{{$detail->id}}-description" :error="$errors->first('detail.description')"/>
    </x-table.cell>
    <x-table.cell no-padding>
        <x-input.text class="text-right pr-0" wire:model="detail.national_modificator" id="{{$detail->id}}-national_modificator" type="number" step="0.0001" :error="$errors->first('detail.national_modificator')"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-right">
        <x-input.text class="text-right  pr-0" wire:model="detail.luxe_modificator" id="{{$detail->id}}-luxe_modificator" type="number" step="0.0001" :error="$errors->first('detail.luxe_modificator')"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-right">
        <x-input.text class="text-right pr-0" wire:model="detail.high_modificator" id="{{$detail->id}}-high_modificator" type="number" step="0.0001" :error="$errors->first('detail.high_modificator')"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-right">
        <x-input.text class="text-right pr-0" wire:model="detail.low_modificator" id="{{$detail->id}}-low_modificator" type="number" step="0.0001" :error="$errors->first('detail.low_modificator')"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-right">
        <x-input.text class="text-right pr-0" wire:model="detail.vpo_modificator" id="{{$detail->id}}-vpo_modificator" type="number" step="0.0001" :error="$errors->first('detail.vpo_modificator')"/>
    </x-table.cell>
    <x-table.cell no-padding class="text-center whitespace-nowrap">
        @if($detail->getKey())
            <x-button.danger wire:click="delete()" size="xs"><x-icon.x size="4" /></x-button.danger>
            <x-button.primary wire:click="select()" size="xs"><x-icon.chevron-right size="4" /></x-button.primary>
        @else
            <x-button.success wire:click="save()" size="xs"><x-icon.save size="4" /></x-button.success>
        @endif
    </x-table.cell>
</x-table.row>

