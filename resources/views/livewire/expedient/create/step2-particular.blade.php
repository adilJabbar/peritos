<div class="space-y-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <section class="space-y-4">
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{__('Datos del siniestro')}}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{__('Persona de contacto, dirección del siniestro')}}
                        </p>
                    </div>
                </x-card.header>
                <x-card.body>
                    <x-input.group for="expedient_requested_date" label="Mismos datos que solicitante" :error="$errors->first('expedient.requested_at_for_editing')" borderless>
                        <div class="mt-1 sm:mt-px sm:pt-2">
                            <x-button.toggle-simple wire:model="contactPersonIsBillablePerson" sr="Billable and contact data synced" />
                        </div>
                    </x-input.group>
                    @include('livewire.expedient.create.contact_person_info', ['readonly' => $contactPersonIsBillablePerson])
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
            </x-card.card>
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{__('Datos de la póliza')}}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{__('Si existe póliza de seguro que esté involucrada en lo ocurrido')}}
                        </p>
                    </div>
                </x-card.header>
                <x-card.body>

                    <x-input.group for="policy.name_cia"  wire:key="'policy.name_cia'" label="Nombre aseguradora" :error="$errors->first('policy.name_cia')" borderless>
                        <x-input.text wire:model="policy.name_cia" id="policy.name_cia" :error="$errors->first('policy.name_cia')" placeholder="Nombre de la compañía aseguradora" />
                    </x-input.group>

                    <x-input.group for="policy.reference"  wire:key="'policy.reference'" label="Número de póliza" :error="$errors->first('policy.reference')" borderless>
                        <x-input.text wire:model="policy.reference" id="policy.reference" :error="$errors->first('policy.reference')" placeholder="Número o referencia de la póliza" />
                    </x-input.group>

                    <x-input.group label="Condiciones Particulares" for="condParticular"  :error="$errors->first('condParticular')" borderless>
                        <div class="space-y-2">
                            @if($policy->cond_particular)
                                <div class="flex space-x-2">
                                    <div class="flex-shrink-0">
                                        <a href="{{$policy->url_cond_particular}}" target="_blank">
                                            <img class="max-h-8" src="{{$policy->icon}}" alt="{{__('Condiciones particulares')}}">
                                        </a>

                                    </div>
                                    <input type="text" class="flex-1 block w-full px-3 py-2 sm:text-sm border-gray-300 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-200" value="{{__('Condiciones Particulares')}}" readonly/>
                                    <x-button.danger wire:click="removeCondParticular" size="sm">
                                        <x-icon.minus-sm size="4" />
                                    </x-button.danger>
                                </div>
                            @endif
                            <x-input.filepond wire:model="condParticular" id="condParticular" />
                        </div>
                    </x-input.group>

                </x-card.body>
            </x-card.card>

        </section>
        <section>
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{__('Descripción del siniestro')}}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{__('Información de lo ocurrido')}}
                        </p>
                    </div>
                </x-card.header>
                <x-card.body>
                    <x-input.group for="happened_at_for_editing" label="Fecha de ocurrencia" :error="$errors->first('expedient.happened_at_for_editing')" borderless>
                        <x-input.text wire:model.lazy="expedient.happened_at_for_editing" type="date"
                                      id="happened_at_for_editing"
                                      :error="$errors->first('expedient.happened_at_for_editing')"/>
                    </x-input.group>


                    <x-input.group for="expedient.description" wire:key="'expedient.description'" label="Descripción" :error="$errors->first('expedient.description')" borderless >
                        <x-input.rich-text wire:model="expedient.description" id="expedient.description" :error="$errors->first('expedient.description')" />
                    </x-input.group>

                    <x-input.group for="expedientRelations.estimate" label="Estimación de daños" :error="$errors->first('estimate')" borderless>
                        <x-input.money wire:model="estimation.estimation" :country="$expedient->address->country_id ?? 1" id="estimate" :error="$errors->first('estimate')" />
                    </x-input.group>

                    <x-input.group for="ramo" label="Ramo" :error="$errors->first('expedient.ramo_id')">
                        <x-input.select wire:model="expedient.ramo_id" id="ramo"
                                        placeholder="Selecciona un ramo..."
                                        :error="$errors->first('expedient.ramo_id')">
                            @if($address->country)
                                @foreach($address->country->ramos as $ramoOption)
                                    <option value="{{ $ramoOption->id }}">{{__($ramoOption->name)}}</option>
                                @endforeach
                            @else
                                <option value="" disabled>{{__('Tienes que seleccionar un país')}}</option>
                            @endif
                        </x-input.select>
                    </x-input.group>
                    <div>
                        @if($ramo->getKey())
                            <x-input.group for="typecases" label="Tipos de siniestro" borderless
                                           :error="$errors->first('typecases')" :key="'typecases-select'">
    {{--                            @json(\App\Models\Admin\Ramo::find($expedient->ramo_id))--}}
                                <x-input.select wire:model="typecases" id="typecases"
                                                placeholder="Selecciona uno o varios tipos de siniestro..."
                                                :error="$errors->first('typecases')" size="{{ count($ramo->typecases) < 25 ?  count($ramo->typecases) + 1 : 25}}" multiple>
                                    @foreach($ramo->typecases as $typecaseOption)
                                        <option value="{{ $typecaseOption->id }}">{{__($typecaseOption->name)}}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                        @endif
                    </div>

                    <x-input.group for="expedient.private_comments"  wire:key="'expedient.private_comments'" label="Private Comments" :error="$errors->first('expedient.private_comments')" >
                        <x-input.rich-text wire:model="expedient.private_comments" id="expedient.private_comments" :error="$errors->first('expedient.private_comments')" />
                    </x-input.group>

                    <x-input.group label="Adjuntos" for="attachments"  :error="$errors->first('attachments')" :key="'attachments-select'">
                        <div class="space-y-2">
                        @forelse($expedient->attachments as $attachment)
                            <livewire:form.attachment-row :attachment="$attachment" :key="'attachment' . $attachment->id" />
                        @empty
                        @endforelse

                            <x-input.filepond wire:model="attachments" id="attachments" multiple />
                        </div>
                    </x-input.group>


                </x-card.body>

            </x-card.card>
        </section>
    </div>
    <div class="flex justify-between">
        <x-button.primary wire:click="goToStep(1)" class="inline-flex items-center space-x-2">
            <x-icon.chevron-left size="4"/>
            <span>{{__('Alta del Siniestro')}}</span>
        </x-button.primary>
        <x-button.primary wire:click="goToStep(3)" class="inline-flex items-center space-x-2">
            <span>{{__('Terceros Afectados')}}</span>
            <x-icon.chevron-right size="4"/>
        </x-button.primary>
    </div>


    @include('livewire.form.address-modal')

</div>

