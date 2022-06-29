<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent >{{__('Alta de expediente')}}</x-breadcumb.item>
                @if($expedient->gabinete_id)
                    <x-breadcumb.item>{{__($expedient->gabinete->name)}}</x-breadcumb.item>
                    @if($expedient->getKey())
                        <x-breadcumb.item>{{ $expedient->full_code }}</x-breadcumb.item>
                    @endif
                    <x-breadcumb.item>{{ __('Datos del siniestro') }}</x-breadcumb.item>
                @endif
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <div class="grid md:grid-cols-2 gap-4">
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3>{{__('Información de contacto')}}</h3>
            </x-card.header>
            <x-card.body>
                @if(class_basename($expedient->billable) === 'Person')
                    <x-input.group for="same-contact" label="Usar datos del solicitante" :error="$errors->first('sameContact')" borderless>
                        <x-input.checkbox size="6" wire:model.lazy="sameContact" id="same-contact" />
                    </x-input.group>
                @endif
                <x-input.group class="pb-2" for="contact-person-legal_id" label="CIF" borderless :error="$errors->first('contactPerson.legal_id')" paddingless>
                    <x-input.text wire:model.lazy="contactPerson.legal_id" id="contact-person-legal_id" name="cif" placeholder="CIF" :error="$errors->first('contactPerson.legal_id')" :readonly="$contactPerson->getKey()"/>
                </x-input.group>
                @if((!$sameContact && $contactPerson->getKey()) ?? false)
                    <div class="flex justify-end">
                        <x-button.link wire:click="resetContactPerson" >{{__('Resetear')}}</x-button.link>
                    </div>
                @endif

                <x-input.group class="pb-2" for="contact-person-name" label="Name" borderless :error="$errors->first('contactPerson.name')" paddingless req>
                    <x-input.text wire:model.lazy="contactPerson.name" id="contact-person-name" placeholder="Name" name="name" :error="$errors->first('contactPerson.name')" :readonly="$sameContact"/>
                </x-input.group>

                <x-input.group class="pb-2" for="contact-person-legal_name" label="Legal Name" borderless :error="$errors->first('contactPerson.legal_name')" paddingless>
                    <x-input.text wire:model.lazy="contactPerson.legal_name" id="contact-person-legal_name" name="legal_name" placeholder="Legal Name" :error="$errors->first('contactPerson.legal_name')" :readonly="$sameContact"/>
                </x-input.group>

                @include('livewire.person.contact_data', ['person' => $contactPerson, 'readonly' => $sameContact])
            </x-card.body>
        </x-card.card>

        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3>{{__('Dirección del siniestro')}}</h3>
            </x-card.header>
            <x-card.body>
                <div>
                    @if(class_basename($expedient->billable) === 'Person')
                        <x-input.group for="same-address" label="Usar dirección del solicitante" :error="$errors->first('sameAddress')" borderless>
                            <x-input.checkbox size="6" wire:model.lazy="sameAddress" id="same-address" />
                        </x-input.group>
                    @endif
                </div>

                <div>
                    @if($contactPerson->getKey() && $contactPerson->addresses->count() > 0 && !$sameAddress)
                        <x-input.group for="address-selector" label="Direcciones asociadas" :error="$errors->first('addressSelector')" borderless>
                            <x-input.select wire:model.lazy="addressSelector" id="address-selector" placeholder="Selecciona una de las direcciones existentes">
                                <option value="new">{{__('Nueva Dirección')}}</option>
                                @foreach($contactPerson->addresses->where('id', '!=', $this->address->id) as $addressRow)
                                    <option value="{{$addressRow->id}}">{{ $addressRow->full_address }}</option>
                                @endforeach
                            </x-input.select>
                        </x-input.group>
                    @endif
                </div>

                <x-input.group label="Country" for="country_id" :error="$errors->first('address.country_id')" borderless req>
                    <x-input.select wire:model="address.country_id" id="address-country_id" :readonly="$sameAddress" :error="$errors->first('address.country_id')" placeholder="Select country">
                        @foreach(\App\Models\Admin\Country::all() as $country)
                            <option value="{{$country->id}}">{{ __($country->name) }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group label="Address" for="address" :error="$errors->first('address.address')" borderless req>
                    <x-input.text wire:model.lazy="address.address" id="address-address" :readonly="$sameAddress" :error="$errors->first('address.address')" placeholder="Address"/>
                </x-input.group>

                <x-input.group label="City" for="address-city" :error="$errors->first('address.city')" borderless req>
                    <x-input.text wire:model.lazy="address.city" id="address-city" :readonly="$sameAddress" :error="$errors->first('address.city')" placeholder="City"/>
                </x-input.group>

                <x-input.group label="Zip code" for="address-zip" :error="$errors->first('address.zip')" borderless >
                    <x-input.text wire:model.lazy="address.zip" id="address-zip"  :readonly="$sameAddress" :error="$errors->first('address.zip')" placeholder="Zip code"/>
                </x-input.group>

                <x-input.group label="State" for="address-state" :error="$errors->first('address.state')" borderless req>
                    @if($address->country && $address->country->states->count() > 0)
                        <x-input.select wire:model="address.state" id="address-state"  :readonly="$sameAddress || $address->country === ''" placeholder="Select state...">
                            @foreach($address->country->states as $state)
                                <option value="{{$state->name}}">{{ __($state->name) }}</option>
                            @endforeach
                        </x-input.select>
                    @endif
                </x-input.group>
            </x-card.body>
        </x-card.card>
    </div>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            {{__('Datos del siniestro')}}
        </x-card.header>
        <x-card.body>
            <x-input.group for="expedient-happened-date" label="Fecha de ocurrencia" :error="$errors->first('expedient.happened_at_for_editing')" borderless req>
                <x-input.text wire:model.lazy="expedient.happened_at_for_editing" type="date"
                              id="expedient-happened-date"
                              :error="$errors->first('expedient.happened_at_for_editing')"/>
            </x-input.group>

            <x-input.group for="expedient.description" wire:key="'expedient.description'" label="Descripción" :error="$errors->first('expedient.description')" borderless req>
                <x-input.rich-text wire:model="expedient.description" id="expedient.description" :error="$errors->first('expedient.description')" />
            </x-input.group>

            <x-input.group for="expedient.ramo_id" label="Ramo" :error="$errors->first('expedient.ramo_id')">
                @if($ramos->count() > 0)
                <x-input.select wire:model.lazy="expedient.ramo_id" id="expedient.ramo_id" placeholder="Selecciona el ramo">
                    @foreach($ramos as $ramoRow)
                        <option value="{{$ramoRow->id}}">{{__($ramoRow->name)}}</option>
                    @endforeach
                </x-input.select>
                @else
                    <span class="text-gray-500 text-sm">{{__('No hay ningún ramo disponible')}}</span>
                @endif
            </x-input.group>

            <div>
                @if($expedient->ramo_id)
                    <x-input.group for="typecases" label="Tipo de siniestro" :error="$errors->first('typecases')" borderless>
                        @if($ramoTypecases && $ramoTypecases->count() > 0)
                            <x-input.select wire:model.lazy="typecases" id="typecases" placeholder="Tipo de siniestro" :error="$errors->first('typecases')" size="{{ count($ramoTypecases) < 25 ?  count($ramoTypecases) + 1 : 25}}" multiple>
                                @foreach($ramoTypecases as $typeCase)
                                    <option value="{{$typeCase->id}}">{{__($typeCase->name)}}</option>
                                @endforeach
                            </x-input.select>

                        @else
                            <span class="text-gray-500 text-sm">{{__('No hay ningún tipo de siniestro disponible')}}</span>
                        @endif
                    </x-input.group>
                @endif
            </div>

            <x-input.group for="expedientRelations.estimate" label="Estimación de daños" :error="$errors->first('estimate')" borderless>
                <x-input.money wire:model="estimation.estimation" :country="$expedient->address->country_id ?? 1" id="estimate" :error="$errors->first('estimate')" />
            </x-input.group>

        </x-card.body>

        <x-card.footer class="flex justify-end">
            @if($expedient->requires_policy)
                <x-button.primary wire:click="saveAndGoTo('Policy')">{{__('Guardar y pasar a datos de la póliza')}}</x-button.primary>
            @else
                <x-button.primary wire:click="saveAndGoTo('Terceros')">{{__('Guardar y pasar a datos de terceros')}}</x-button.primary>
            @endif
        </x-card.footer>
    </x-card.card>
</div>
