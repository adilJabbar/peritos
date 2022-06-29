<x-card.card class="divide-y divide-gray-200">
    <x-card.header>
        <h3>{{ $subcontractor->name }}</h3>
    </x-card.header>

    <x-card.body>

        <!-- name -->
        <x-input.group label="Name" for="name" :error="$errors->first('subcontractor.name')" borderless>
            <x-input.text wire:model.lazy="subcontractor.name" id="name" placeholder="Name" :error="$errors->first('subcontractor.name')" />
        </x-input.group>

        <!-- legal_name -->
        <x-input.group label="Legal name" for="legal_name" class="sm:pt-0" borderless :error="$errors->first('subcontractor.legal_name')">
            <x-input.text wire:model.lazy="subcontractor.legal_name" id="legal_name" :error="$errors->first('subcontractor.legal_name')" placeholder="Legal name"/>
        </x-input.group>

        <!-- cif -->
        <x-input.group label="CIF" for="cif" class="sm:pt-0" borderless :error="$errors->first('subcontractor.cif')">
            <x-input.text wire:model.lazy="subcontractor.legal_id" id="cif" :error="$errors->first('subcontractor.cif')" placeholder="CIF"/>
        </x-input.group>

        <!-- address -->
        <x-input.group label="Address" for="address" :error="$errors->first('subcontractor.address')">
            <x-input.text wire:model.lazy="subcontractor.address" id="address" :error="$errors->first('subcontractor.address')" placeholder="Address"/>
        </x-input.group>

        <!-- city -->
        <x-input.group label=" " for="city" :error="$errors->first('subcontractor.city')" borderless>
            <x-input.text wire:model.lazy="subcontractor.city" id="city" :error="$errors->first('subcontractor.city')" placeholder="City"/>
        </x-input.group>

        <x-input.group label=" " for="zip" borderless>
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                <!-- zip -->
                <x-input.text wire:model.lazy="subcontractor.zip" id="zip" :error="$errors->first('subcontractor.zip')" placeholder="Zip code"/>
                <!-- state -->
                <x-input.text wire:model.lazy="subcontractor.state" id="state" :error="$errors->first('subcontractor.state')" placeholder="State"/>
            </div>
        </x-input.group>

        <!-- country_id -->
        <x-input.group label="Country" for="country_id" :error="$errors->first('subcontractor.country_id')" borderless>
            <x-input.select wire:model="subcontractor.country_id" id="country_id" :error="$errors->first('subcontractor.country_id')" placeholder="Select country">
                @foreach(\App\Models\Admin\Country::all() as $country)
                    <option value="{{$country->id}}">{{ $country->name }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <!-- phone -->
        <x-input.group label="Phone" for="phone" :error="$errors->first('subcontractor.phone')">
            <x-input.text wire:model="subcontractor.phone" id="phone"  :error="$errors->first('subcontractor.phone')" placeholder="Phone number"/>
        </x-input.group>

        <!-- email -->
        <x-input.group label="Email address" for="email" :error="$errors->first('subcontractor.email')" borderless>
            <x-input.text wire:model="subcontractor.email" id="email" type="email" autocomplete="new-email" :error="$errors->first('subcontractor.email')" placeholder="Email adress"/>
        </x-input.group>

    </x-card.body>
    <x-card.footer class="flex justify-end bg-gray-50">
        <!-- save -->
        <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
    </x-card.footer>
</x-card.card>
