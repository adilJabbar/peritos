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
                    <x-breadcumb.item>{{ __('Terceros afectados') }}</x-breadcumb.item>
                @endif
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card x-data="{showAddTercero: false}" class="divide-gray-200 divide-y">
        <x-card.header>
            {{__('Terceros afectados')}}
            <x-button.primary x-on:click="showAddTercero = ! showAddTercero" size="xs">
                <div x-show="!showAddTercero"><x-icon.plus /></div>
                <div x-show="showAddTercero"><x-icon.minus /></div>

            </x-button.primary>
        </x-card.header>
        <x-table.table>
            <x-slot name="head">
                <x-table.heading>{{__('Type')}}</x-table.heading>
                <x-table.heading>{{__('Name')}}</x-table.heading>
                <x-table.heading>{{__('Address')}}</x-table.heading>
                <x-table.heading>{{__('Contacts')}}</x-table.heading>
                <x-table.heading>{{__('Amount')}}</x-table.heading>
                <x-table.heading>{{__('Compañía')}}</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse($expedient->affecteds as $affectedRow)
                    <x-table.row>
                        <x-table.cell>{{$affectedRow->pivot->type}}</x-table.cell>
                        <x-table.cell>{{$affectedRow->name}}</x-table.cell>
                        <x-table.cell>{{\App\Models\Address::find($affectedRow->pivot->address_id)->address}}</x-table.cell>
                        <x-table.cell>{{$affectedRow->contacts?->first()->value ?? __('No disponible')}}</x-table.cell>
                        <x-table.cell class="text-right">{{$affectedRow->pivot->amount}}</x-table.cell>
                        <x-table.cell>{{$affectedRow->pivot->company}}</x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="6" class="text-center">{{__('No hay ningún tercero afectado')}}</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
        <div x-show="showAddTercero" class="py-4 px-4">

            <x-card.card class="border-primary border divide-primary divide-y">
                <div class="bg-primary text-white p-2 sm:px-2 flex items-center">
                    {{__('Añadir un tercero afectado')}}
                </div>
                <x-card.body>
                    <x-input.group for="affected-type" label="Type"
                                   :error="$errors->first('affected.type')" borderless>
                        <x-input.select wire:model="affected.type" placeholder="Tipo de afectado..." :error="$errors->first('affected.type')">
                            <option value="causante">{{__('Causante')}}</option>
                            <option value="perjudicado">{{__('Perjudicado')}}</option>
                        </x-input.select>
                    </x-input.group>
                    @if($affected['type'])
                        <x-input.group for="affected-amount" label="{{ $affected['type'] == 'causante' ? __('Importe a reclamar') : __('Importe que reclama') }}" :error="$errors->first('affected.amount')" borderless>
                            <x-input.money wire:model.lazy="affected.amount" :currency="$expedient->address->country->currency" id="affected-amount" :error="$errors->first('affected.amount')" />
                        </x-input.group>
                    @endif

                    <x-input.group for="person-legal_id" label="CIF" borderless :error="$errors->first('person.legal_id')">
                        <x-input.text wire:model.lazy="person.legal_id" id="person-legal_id" placeholder="CIF" :error="$errors->first('person.legal_id')" :readonly="$person->getKey()" />
                    </x-input.group>

                    @if($person->getKey())
                        <div class="flex justify-end">
                            <x-button.link wire:click="resetAll" >{{__('Resetear')}}</x-button.link>
                        </div>
                    @endif

                    <x-input.group for="person-name" label="Name" borderless
                                   :error="$errors->first('person.name')">
                        <x-input.text wire:model.lazy="person.name" id="person-name" placeholder="Name"
                                      :error="$errors->first('person.name')" :readonly="$readonly ?? false"/>
                    </x-input.group>

                    <x-input.group for="person-legal_name" label="Legal Name" borderless
                                   :error="$errors->first('person.legal_name')">
                        <x-input.text wire:model.lazy="person.legal_name" id="person-legal_name"
                                      placeholder="Legal Name" :error="$errors->first('person.legal_name')" :readonly="$readonly ?? false"/>
                    </x-input.group>

                    <div class="sm:border-t">
                        @include('livewire.person.contact_data', ['person' => $person, 'readonly' => false])
                    </div>
                    <div class="sm:border-t">
                    @if($person->name || $person->legal_name)
                        <div>
                            @if($person->getKey() && $person->addresses->count() > 0)
                                <x-input.group for="address-selector" label="Direcciones asociadas" :error="$errors->first('addressSelector')" borderless>
                                    <x-input.select wire:model.lazy="addressSelector" id="address-selector" placeholder="Selecciona una de las direcciones existentes">
                                        <option value="new">{{__('Nueva Dirección')}}</option>
                                        @foreach($person->addresses->where('id', '!=', $this->address->id) as $addressRow)
                                            <option value="{{$addressRow->id}}">{{ $addressRow->full_address }}</option>
                                        @endforeach
                                    </x-input.select>
                                </x-input.group>
                            @endif
                        </div>

                        <x-input.group label="Country" for="country_id" :error="$errors->first('address.country_id')" borderless req>
                            <x-input.select wire:model="address.country_id" id="address-country_id" :error="$errors->first('address.country_id')" placeholder="Select country">
                                @foreach(\App\Models\Admin\Country::all() as $country)
                                    <option value="{{$country->id}}">{{ __($country->name) }}</option>
                                @endforeach
                            </x-input.select>
                        </x-input.group>

                        <x-input.group label="Address" for="address" :error="$errors->first('address.address')" borderless req>
                            <x-input.text wire:model.lazy="address.address" id="address-address" :error="$errors->first('address.address')" placeholder="Address"/>
                        </x-input.group>

                        <x-input.group label="City" for="address-city" :error="$errors->first('address.city')" borderless req>
                            <x-input.text wire:model.lazy="address.city" id="address-city" :error="$errors->first('address.city')" placeholder="City"/>
                        </x-input.group>

                        <x-input.group label="Zip code" for="address-zip" :error="$errors->first('address.zip')" borderless >
                            <x-input.text wire:model.lazy="address.zip" id="address-zip"  :error="$errors->first('address.zip')" placeholder="Zip code"/>
                        </x-input.group>

                        <x-input.group label="State" for="address-state" :error="$errors->first('address.state')" borderless req>
                            @if($address->country && $address->country->states->count() > 0)
                                <x-input.select wire:model="address.state" id="address-state"  :readonly="$address->country === ''" placeholder="Select state...">
                                    @foreach($address->country->states as $state)
                                        <option value="{{$state->name}}">{{ __($state->name) }}</option>
                                    @endforeach
                                </x-input.select>
                            @endif
                        </x-input.group>

                        <x-input.group label="Compañía aseguradora" for="affected-company" :error="$errors->first('affected.company')"  >
                            <x-input.text wire:model.lazy="affected.company" id="affected-company"  :error="$errors->first('affected.company')" placeholder="Nombre de la compañía aseguradora"/>
                        </x-input.group>
                        <x-input.group label="Número de póliza" for="affected-policy" :error="$errors->first('affected.policy')" borderless >
                            <x-input.text wire:model.lazy="affected.policy" id="affected-policy"  :error="$errors->first('affected.policy')" placeholder="Número de póliza"/>
                        </x-input.group>
                        <x-input.group label="Referencia de siniestro" for="affected-case" :error="$errors->first('affected.case')" borderless >
                            <x-input.text wire:model.lazy="affected.case" id="affected-case"  :error="$errors->first('affected.case')" placeholder="Referencia de siniestro"/>
                        </x-input.group>
                        <x-input.group label="Notas" for="affected-notes" :error="$errors->first('affected.notes')" borderless >
                            <x-input.textarea wire:model.lazy="affected.notes" id="affected-notes"  :error="$errors->first('affected.notes')" placeholder="Otras notas (Información del perito, datos de contacto...)"/>
                        </x-input.group>

                    @endif
                </div>
                </x-card.body>
                <div>
                    @if(($person->name || $person->legal_name))
                        <div class="p-2 bg-primary flex justify-end">
                            <x-button.white x-show="showAddTercero" wire:click="createAffected">{{__('Añadir tercero al expediente')}}</x-button.white>
                        </div>
                    @endif
                </div>
            </x-card.card>

        </div>

        <x-card.footer x-show="!showAddTercero"  class="flex justify-end">
            <div>
                <x-button.primary wire:click="saveAndGoTo('Finalize')">{{__('Finalizar el alta del siniestro')}}</x-button.primary>
            </div>
        </x-card.footer>

    </x-card.card>
</div>
