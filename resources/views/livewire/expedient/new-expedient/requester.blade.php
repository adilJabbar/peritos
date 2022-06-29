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
                    <x-breadcumb.item>{{ __('Solicitante') }}</x-breadcumb.item>
                @endif
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <div>
        @unless(auth()->user()->gabinetes->count() === 1 || $expedient->getKey())
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                {{__('Mi Gabinete')}}
            </x-card.header>
            <x-card.body>
                <x-input.group for="gabinete-id" label="Gabinete" :error="$errors->first('gabinete.id')" borderless req>
                    <x-input.select wire:model.lazy="expedient.gabinete_id" id="gabinete-id" placeholder="Selecciona el gabinete">
{{--                        <option value="0" disabled>{{__('Selecciona el gabinete')}}</option>--}}
                        @forelse(auth()->user()->gabinetes as $gabineteRow)
                            <option value="{{ $gabineteRow->id }}">{{__( $gabineteRow->name )}}</option>
                        @empty
                            <option disabled>{{__('Tu usuario no está asociado a ningún gabinete')}}</option>
                        @endforelse
                    </x-input.select>
                </x-input.group>
            </x-card.body>
        </x-card.card>
        @endunless
    </div>

    <div>
    @if($expedient->gabinete_id)
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                {{__('Datos del solicitante')}}
            </x-card.header>
            <x-card.body>
                <x-input.group for="expedient-requested-date" label="Fecha de solicitud" :error="$errors->first('expedient.requested_at_for_editing')" borderless req>
                    <x-input.text wire:model.lazy="expedient.requested_at_for_editing" type="datetime-local"
                                  id="expedient-requested-date"
                                  :error="$errors->first('expedient.requested_at_for_editing')"/>
                </x-input.group>

                <x-input.group for="requester-type" label="Tipo de solicitante" :error="$errors->first('requesterType')" borderless req>
                    <x-input.select wire:model.lazy="requesterType" id="requester-type" placeholder="Selecciona el tipo de solicitante" :readonly="($requester?->getKey() && $expedient->getKey()) ?? false">
                        <option value="Company">{{__('Compañía Aseguradora')}}</option>
                        <option value="Person">{{__('Particular')}}</option>
                    </x-input.select>
                </x-input.group>

                <div>
                    @if($requesterType === 'Company')
{{--requester type is company--}}
                    <x-input.group for="company-id" label="Compañía aseguradora" borderless
                                   :error="$errors->first('requester.id')" req>
                        <x-input.select wire:model="requester.id" id="company-id"
                                        placeholder="Selecciona la compañía aseguradora..."
                                        :error="$errors->first('requester.id')">
                            @forelse($expedient->gabinete->companies->sortBy('name') as $companyOption)
                                <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
                            @empty
                            @endforelse
                        </x-input.select>
                    </x-input.group>

                    @if($requester->id ?? false)
                        <div>
                            <div>
                                @if($requester->areas->count() > 0)
                                    <x-input.group for="expedient-area_id" label="Área" borderless req
                                                   :error="$errors->first('expedient.area_id')">
                                        <x-input.select wire:model="expedient.area_id" id="expedient-area_id"
                                                        placeholder="Selecciona el área o departamento..."
                                                        :error="$errors->first('expedient.area_id')">
                                            <option value="NoArea">{{__('Ningún área')}}</option>
                                            @forelse($requester->areas->sortBy('name') as $areaOption)
                                                <option value="{{ $areaOption->id }}">{{ $areaOption->name }}</option>
                                            @empty
                                            @endforelse
                                        </x-input.select>
                                    </x-input.group>
                                @endif
                            </div>

                            <x-input.group for="expedient-reference" label="Referencia" borderless req
                                           :error="$errors->first('expedient.reference')">
                                <x-input.text wire:model.lazy="expedient.reference" id="expedient-reference" placeholder="Referencia de compañía" :error="$errors->first('expedient.reference')"
                                />
                            </x-input.group>

                            <x-input.group for="expedient-agent-id" label="Tramitador" borderless
                                           :error="$errors->first('expedient.agent_id')">
                                <x-input.select wire:model="expedient.agent_id" id="expedient-agent-id"
                                                placeholder="Selecciona el tramitador..."
                                                :error="$errors->first('expedient.agent_id')">
                                    @forelse($expedient->gabinete->activeAgents()->where('company_id', $requester->id)->sortBy('name') as $agentOption)
                                        <option value="{{ $agentOption->id }}">{{ $agentOption->name }}</option>
                                    @empty
                                    @endforelse
                                </x-input.select>
                            </x-input.group>
                        </div>

                    @endif
                @elseif($requesterType === 'Person')
{{--requester type is person--}}
                    <x-input.group for="expedient-requires_policy" label="¿Usar datos de la póliza de seguro?" borderless req
                                   :error="$errors->first('expedient.requires_policy')">
                        <x-input.select wire:model.lazy="expedient.requires_policy" id="expedient-requires_policy" placeholder="Incluir datos de la póliza en el expediente" :error="$errors->first('expedient.requires_policy')">
                            <option value="1">{{__('Si')}}</option>
                            <option value="0">{{__('No')}}</option>
                        </x-input.select>
                    </x-input.group>
                    <x-input.group for="expedient-reference" label="Referencia" borderless
                                   :error="$errors->first('expedient.reference')">
                        <x-input.text wire:model.lazy="expedient.reference" id="expedient-reference" placeholder="Referencia del cliente" :error="$errors->first('expedient.reference')"
                        />
                    </x-input.group>
                    <x-input.group for="requester-legal_id" label="CIF" borderless :error="$errors->first('requester.legal_id')">
                        <x-input.text wire:model.lazy="requester.legal_id" id="requester-legal_id" placeholder="CIF" :error="$errors->first('requester.legal_id')" :readonly="$requester->getKey() ?? false"/>
                    </x-input.group>

                    @if($requester->getKey() ?? false)
                        <div class="flex justify-end">
                            <x-button.link wire:click="resetRequester" >{{__('Resetear')}}</x-button.link>
                        </div>
                    @endif

                    <x-input.group for="requester-name" label="Name" borderless :error="$errors->first('requester.name')">
                        <x-input.text wire:model.lazy="requester.name" id="requester-name" placeholder="Name" :error="$errors->first('requester.name')" />
                    </x-input.group>

                    <x-input.group for="requester-legal_name" label="Legal Name" borderless :error="$errors->first('requester.legal_name')">
                        <x-input.text wire:model.lazy="requester.legal_name" id="requester-legal_name" placeholder="Legal Name" :error="$errors->first('requester.legal_name')" :readonly="$readonly ?? false"/>
                    </x-input.group>
                    @if($requester->name || $requester->legal_id)
                        @include('livewire.person.address_data', ['person' => $requester])

                        @if($address?->getKey())
                            @include('livewire.person.contact_data', ['person' => $requester])
                        @endif
                    @endif


                @endif
                </div>
            </x-card.body>
            <div>
{{--                @json($requesterType)--}}
                @if($requesterType === 'Company')
                    @if($requester->id ?? false)
                    <x-card.footer>
                        <div class="flex justify-end">
                            @if($expedient->getKey())
                                <x-button.primary wire:click="updateCompanyExpedient">{{__('Actualizar solicitante')}}</x-button.primary>
                            @else
                                <x-button.primary wire:click="createCompanyExpedient">{{__('Crear expediente')}}</x-button.primary>
                            @endif
                        </div>
                    </x-card.footer>
                    @endif
                @elseif($requesterType === 'Person')
                    @if($address?->getKey() && count($contacts) > 0)
                        <x-card.footer>
                            <div class="flex justify-end">
                                @if($expedient->getKey())
                                    <x-button.primary wire:click="updatePersonExpedient">{{__('Actualizar solicitante')}}</x-button.primary>
                                @else
                                    <x-button.primary wire:click="createPersonExpedient">{{__('Crear expediente')}}</x-button.primary>
                                @endif
                            </div>
                        </x-card.footer>
                    @endif
                @endif
            </div>
        </x-card.card>
    @endif
    </div>

    @include('livewire.form.address-modal')
</div>
