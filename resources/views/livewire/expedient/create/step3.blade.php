<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{__('Terceros Afectados')}}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{__('Información de terceras partes afectadas por el expediente')}}
                </p>
            </div>
        </x-card.header>
        <x-card.body>

            <x-input.group for="affected-type" label="Type"
                           :error="$errors->first('affected.type')" borderless>
                <x-input.select wire:model="affected.type" placeholder="Tipo de afectado...">
                    <option value="causante">{{__('Causante')}}</option>
                    <option value="perjudicado">{{__('Perjudicado')}}</option>
                </x-input.select>
            </x-input.group>

            @if($affected['type'])
                <x-input.group for="affected.reclamation" label="{{ $affected['type'] == 'causante' ? __('Importe a reclamar') : __('Importe que reclama') }}" :error="$errors->first('affected.reclamation')" borderless>
                    <x-input.money wire:model="affected.reclamation" :currency="$expedient->address->country->currency" id="affected.reclamation" :error="$errors->first('affected.reclamation')" />
                </x-input.group>
            @endif

            @include('livewire.person.person_data')

        </x-card.body>
        @if($person->name || $person->legal_id)
            <x-card.body>
                @include('livewire.person.address_data')
            </x-card.body>
        @endif
        @if($address?->getKey())
            <x-card.body>
                @include('livewire.person.contact_data')
            </x-card.body>
        @endif

        <x-card.footer class="text-right bg-gray-200">
            <x-button.primary wire:click="addAffected">{{__('Add')}}</x-button.primary>
        </x-card.footer>


    </x-card.card>
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{__('Terceros Afectados')}}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{__('Información de terceras partes afectadas por el expedient')}}
                </p>
            </div>
            <div>
                <x-button.primary><x-icon.plus size="4" /></x-button.primary>
            </div>
        </x-card.header>
        <x-card.body>
            @include('livewire.affected.table')

        </x-card.body>

    </x-card.card>

    <div class="col-span-2 flex justify-between">
        <x-button.primary wire:click="goToStep(2)" class="inline-flex items-center space-x-2">
            <x-icon.chevron-left size="4"/>
            <span>{{__('Datos del siniestro')}}</span>
        </x-button.primary>
        <x-button.primary wire:click="finish" class="inline-flex items-center space-x-2">
            <span>{{__('Finalizar')}}</span>
            <x-icon.chevron-right size="4"/>
        </x-button.primary>
    </div>

    @include('livewire.form.address-modal')
</div>

