<x-table.row>
    <x-table.cell class="pr-0">
            <x-input.checkbox size="8" wire:model="selected" />
    </x-table.cell>
    <x-table.cell>{{$capital->name}}</x-table.cell>
    @if($selected)
        <x-table.cell no-padding>
            <x-input.money wire:model.lazy="insured.pivot.amount" id="unit_price" placeholder="Capital asegurado" :currency="$currency" :error="$errors->first('insured.pivot.amount')" />
        </x-table.cell>
        <x-table.cell no-padding>
            <x-input.checkbox wire:model="insured.pivot.primer_riesgo" size="8" justify="center" />
        </x-table.cell>
        <x-table.cell no-padding>
            <x-input.select wire:model="insured.pivot.perc_cia" id="percent_cia" :error="$errors->first('insured.pivot.perc_cia')" placeholder="% Cubierto compañía...">
                <option value="100">{{ __('Reposición') }}</option>
                <option value="90">{{ __('90%') }}</option>
                <option value="80">{{ __('80%') }}</option>
                <option value="70">{{ __('70%') }}</option>
                <option value="60">{{ __('60%') }}</option>
                <option value="50">{{ __('50%') }}</option>
                <option value="40">{{ __('40%') }}</option>
                <option value="30">{{ __('30%') }}</option>
                <option value="20">{{ __('20%') }}</option>
                <option value="10">{{ __('10%') }}</option>
                <option value="0">{{ __('Real') }}</option>
            </x-input.select>
        </x-table.cell>
        <x-table.cell no-padding>
            <x-input.money wire:model.lazy="insured.pivot.reposicion" id="unit_price" placeholder="Valor reposición" :currency="$currency" :error="$errors->first('insured.pivot.reposicion')" />
        </x-table.cell>
        <x-table.cell no-padding>
            <x-input.text wire:model.lazy="insured.pivot.deprecation" class="text-center" type="number" step="1" id="unit_price" placeholder="% Depreciación" :error="$errors->first('insured.pivot.deprecation')" />
        </x-table.cell>
        <x-table.cell no-padding class="px-2 whitespace-nowrap text-right">
{{--            <x-input.money value="{{$insured->realValue()}}" id="realvalue-{{$capital->id}}" placeholder="Valor real" :currency="$currency" readonly />--}}
            <x-output.currency value="{{$insured->realValue()}}" :currency="$currency" />
        </x-table.cell>
        <x-table.cell no-padding class="px-2 whitespace-nowrap text-right">
            <x-output.currency value="{{$insured->asegurableValue()}}" :currency="$currency" />
        </x-table.cell>
        <x-table.cell no-padding class="px-2 whitespace-nowrap text-right">
            <x-output.currency value="{{$insured->infraseguroValue()}}" :currency="$currency" />
        </x-table.cell>
    @else
        <x-table.cell colspan="8" />
    @endif
</x-table.row>
