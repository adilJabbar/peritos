<div class="space-y-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <section class="space-y-4">
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{__('Alta de nuevo expediente particular')}}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{__('Datos iniciales relativos a la solicitud')}}
                        </p>
                    </div>
                </x-card.header>
                <x-card.body>
                @if(auth()->user()->myGabinetes()->count() > 1)
                    <!-- Gabinete -->
                        <x-input.group for="gabinete" label="Gabinete" borderless
                                       :error="$errors->first('expedient.gabinete_id')">
                            <x-input.select wire:model="expedient.gabinete_id" id="gabinete"
                                            placeholder="Selecciona un gabinete..."
                                            :error="$errors->first('expedient.gabinete_id')" :readonly="$person->getKey()">
                                @foreach(auth()->user()->myGabinetes()->sortBy('name') as $gabineteOption)
                                    <option value="{{ $gabineteOption->id }}">{{__($gabineteOption->name)}}</option>
                                @endforeach
                            </x-input.select>
                        </x-input.group>
                    @endif

                    <x-input.group for="expedient_requested_date" label="Fecha de alta" :error="$errors->first('expedient.requested_at_for_editing')" borderless>
                        <x-input.text wire:model.lazy="expedient.requested_at_for_editing" type="datetime-local"
                                      id="expedient_requested_date"
                                      :error="$errors->first('expedient.requested_at_for_editing')"/>
                    </x-input.group>
                </x-card.body>
            </x-card.card>
            @if($expedient->gabinete_id)
                <x-card.card class="divide-y divide-gray-200">
                    <x-card.header>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{__('Datos del solicitante')}}
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                {{__('Esta información se utilizará para facturar el trabajo')}}
                            </p>
                        </div>
                    </x-card.header>
                    <x-card.body>
                        <x-input.group for="expedient-reference" label="Referencia" borderless
                                       :error="$errors->first('expedient.reference')">
                            <x-input.text wire:model.lazy="expedient.reference" id="expedient-reference" placeholder="Referencia del cliente" :error="$errors->first('expedient.reference')"
                            />
                        </x-input.group>
                        @include('livewire.person.person_data')
                    </x-card.body>
                </x-card.card>
            @endif
        </section>
        <section class="space-y-4">
        @if($person->name || $person->legal_id)
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{__('Dirección de facturación')}}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{__('Esta información se utilizará para facturar el trabajo')}}
                        </p>
                    </div>
                </x-card.header>
                <x-card.body>
                    @include('livewire.person.address_data')
                </x-card.body>
            </x-card.card>
        @endif
        @if($address->getKey())
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{__('Datos de contacto')}}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{__('Información de contacto')}}
                        </p>
                    </div>
                </x-card.header>
                <x-card.body>
                    @include('livewire.person.contact_data')
                </x-card.body>
            </x-card.card>
            <div class="flex justify-end">
                <x-button.primary wire:click="goToStep(2)" class="inline-flex items-center space-x-2">
                    <span>{{__('Datos del Siniestro')}}</span>
                    <x-icon.chevron-right size="4"/>
                </x-button.primary>
            </div>
        @endif
        </section>
    </div>

    @include('livewire.form.address-modal')
</div>
