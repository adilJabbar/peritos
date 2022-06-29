
<x-input.group label="Name" for="name" :error="$errors->first('currency.name')" borderless>
    <x-input.text wire:model.lazy="currency.name" id="name" placeholder="Name" :error="$errors->first('currency.name')" />
</x-input.group>

<x-input.group label="Símbolo" for="currency" :error="$errors->first('currency.currency')" >
    <x-input.text wire:model.lazy="currency.currency" id="currency" placeholder="Símbolo" :error="$errors->first('currency.currency')" />
</x-input.group>

<x-input.group label="Position" for="position" borderless :error="$errors->first('currency.position')">
    <x-input.select wire:model="currency.position" id="position" :error="$errors->first('currency.position')" placeholder="Select position">
        <option value="before">{{ __('Before') }}</option>
        <option value="after">{{ __('After') }}</option>
    </x-input.select>
</x-input.group>

<x-input.group label="ISO" for="iso" borderless :error="$errors->first('currency.iso')">
    <x-input.text wire:model.lazy="currency.iso" id="iso" :error="$errors->first('currency.iso')" placeholder="ISO"/>
</x-input.group>

<x-input.group label="Decimales" for="decimals"  :error="$errors->first('currency.decimals')">
    <x-input.text wire:model.lazy="currency.decimals" type="number" step="1" id="decimals" :error="$errors->first('currency.decimals')" placeholder="Decimales"/>
</x-input.group>

<x-input.group label="Separador decimal" for="decimal" borderless :error="$errors->first('currency.decimal')">
    <x-input.select wire:model="currency.decimal" id="decimal" :error="$errors->first('currency.decimal')" placeholder="Select currency">
        <option value=",">{{ __('Coma') }}: ","</option>
        <option value=".">{{ __('Punto') }}: "."</option>
        <option value=" ">{{ __('Espacio') }}: " "</option>
    </x-input.select>
</x-input.group>

<x-input.group label="Separador millares" for="separator" borderless :error="$errors->first('currency.separator')">
    <x-input.select wire:model="currency.separator" id="separator" :error="$errors->first('currency.separator')" placeholder="Select currency">
        <option value=",">{{ __('Coma') }}: ","</option>
        <option value=".">{{ __('Punto') }}: "."</option>
        <option value=" ">{{ __('Espacio') }}: " "</option>
    </x-input.select>
</x-input.group>


<x-input.group label="USD Rate" for="usd_rate" borderless :error="$errors->first('currency.usd_rate')">
    <x-input.text wire:model.lazy="currency.usd_rate" type="number" step="0.01" id="usd_rate" :error="$errors->first('currency.usd_rate')" placeholder="USD Rate"/>
</x-input.group>
