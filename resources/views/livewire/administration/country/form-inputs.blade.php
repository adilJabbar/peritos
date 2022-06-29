<!-- Name -->
<x-input.group label="Name" for="name" :error="$errors->first('country.name')" borderless>
    <x-input.text wire:model.lazy="country.name" id="name" placeholder="Name" :error="$errors->first('country.name')" />
</x-input.group>

<x-input.group label="Code" for="code" class="sm:pt-0" borderless :error="$errors->first('country.code')">
    <x-input.text wire:model.lazy="country.code" id="code" :error="$errors->first('country.code')" placeholder="Code"/>
</x-input.group>

<x-input.group label="Currency" for="currency_id" class="sm:pt-0" borderless :error="$errors->first('country.currency_id')">
    <x-input.select wire:model="country.currency_id" id="country_id" :error="$errors->first('country.currency_id')" placeholder="Select currency">
        @foreach(\App\Models\Admin\Currency::all()->sortBy('name') as $currency)
            <option value="{{$currency->id}}">{{ $currency->name }}</option>
        @endforeach
    </x-input.select>
</x-input.group>

<x-input.group label="Taxes %" for="taxes" class="sm:pt-0" borderless :error="$errors->first('country.taxes')">
    <x-input.text wire:model.lazy="country.taxes" id="taxes" type="number" step="0.01" :error="$errors->first('country.taxes')" placeholder="% Taxes"/>
</x-input.group>

<x-input.group label="Precio m²" for="precio_m" class="sm:pt-0" borderless :error="$errors->first('country.precio_m')">
    <x-input.money wire:model.lazy="country.precio_m" id="precio_m" :currency="$country->currency" :error="$errors->first('country.precio_m')" placeholder="Valor medio m²"/>
</x-input.group>

<x-input.group label="Amueblamiento básico" for="furniture" class="sm:pt-0" borderless :error="$errors->first('country.furniture')">
    <x-input.money wire:model.lazy="country.furniture" id="furniture" :currency="$country->currency" :error="$errors->first('country.furniture')" placeholder="Importe amueblamiento básico"/>
</x-input.group>

<x-input.group label="Por habitación" for="room" class="sm:pt-0" borderless :error="$errors->first('country.room')">
    <x-input.money wire:model.lazy="country.room" id="room" :currency="$country->currency" :error="$errors->first('country.room')" placeholder="Importe por estancia"/>
</x-input.group>

<x-input.group label="Por persona" for="person" class="sm:pt-0" borderless :error="$errors->first('country.person')">
    <x-input.money wire:model.lazy="country.person" id="person" :currency="$country->currency" :error="$errors->first('country.person')" placeholder="Importe por persona"/>
</x-input.group>

<x-input.group label="Por anexo" for="anexo" class="sm:pt-0" borderless :error="$errors->first('country.anexo')">
    <x-input.money wire:model.lazy="country.anexo" id="anexo" :currency="$country->currency" :error="$errors->first('country.anexo')" placeholder="Importe por anexo"/>
</x-input.group>

<x-input.group label="Flag" for="flag"  :error="$errors->first('flag')" no-shadow>
    <x-input.file wire:model="flag" id="flag">
        <div class="h-32 w-full bg-white text-gray-300 flex items-center">
            @if($flag)
                <img class="max-h-32 mx-auto" src="{{ $flag->temporaryUrl() }}" alt="{{ __('Country Flag') }}">
            @else
                <img class="max-h-32 mx-auto" src="{{ $country->flag_url }}" alt="{{ __('Country Flag') }}">
            @endif
        </div>
    </x-input.file>
</x-input.group>
