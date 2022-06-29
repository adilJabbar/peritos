<div>

    <x-input.group for="affected-type" label="Type"
                   :error="$errors->first('affected.type')" borderless>
        <x-input.select wire:model="affected.type" placeholder="Tipo de afectado...">
            <option value="causante">{{__('Causante')}}</option>
            <option value="perjudicado">{{__('Perjudicado')}}</option>
        </x-input.select>
    </x-input.group>

    @if($affected['type'])
        <x-input.group for="affected.reclamation" label="{{ $affected['type'] == 'causante' ? __('Importe a reclamar') : __('Importe que reclama') }}" :error="$errors->first('affected.reclamation')" borderless>
            <x-input.money wire:model="affected.reclamation" :country="$expedientRelations['address']['country_id'] ?? 1" id="affected.reclamation" :error="$errors->first('affected.reclamation')" />
        </x-input.group>
    @endif

    <x-input.group for="person-name" label="Name"
                   :error="$errors->first('person.name')" >
        <x-input.text wire:model.lazy="person.name" id="person-name"
                      placeholder="Name"
                      :error="$errors->first('person.name')"/>
    </x-input.group>

    <x-input.group for="person-legal_name" label="Legal Name" borderless
                   :error="$errors->first('person.legal_name')">
        <x-input.text wire:model.lazy="person.legal_name" id="person-legal_name"
                      placeholder="Legal Name"
                      :error="$errors->first('person.legal_name')"/>
    </x-input.group>

    <x-input.group for="person-legal_id" label="CIF" borderless
                   :error="$errors->first('person.legal_id')">
        <x-input.text wire:model.lazy="person.legal_id" id="person-legal_id"
                      placeholder="CIF"
                      :error="$errors->first('person.legal_id')"/>
    </x-input.group>

{{--    @include('livewire.form.address', ['model' => 'person.address', 'readonly' => false])--}}

{{--    --}}{{-- Contacts. --}}
{{--    <div--}}
{{--        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200  sm:py-2">--}}
{{--        <label for="Emails y teléfonos"--}}
{{--               class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">--}}
{{--            {{ __( 'Emails y teléfonos' ) }}--}}
{{--        </label>--}}
{{--        @dd($person['contacts'])--}}
{{--        @include('livewire.form.contact', ['arrayRelations' => 'person', 'readonly' => false])--}}
{{--    </div>--}}
</div>
