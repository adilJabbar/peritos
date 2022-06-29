<div class="space-y-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <section class="space-y-4">
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{__('Alta de nuevo expediente de compañía')}}
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
                                            :error="$errors->first('expedient.gabinete_id')" :readonly="$company->getKey()">
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
                            <x-input.text wire:model.lazy="expedient.reference" id="expedient-reference" placeholder="Referencia de compañía" :error="$errors->first('expedient.reference')"
                            />
                        </x-input.group>
                        @include('livewire.expedient.create.companyInfo')
                    </x-card.body>
                </x-card.card>
            @endif
        </section>
        <section class="space-y-4">
            @if($company->name)
                <x-card.card class="divide-y divide-gray-200">
                    <x-card.header>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{__('Datos de la póliza')}}
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                {{__('Producto, capitales y condiciones particulares')}}
                            </p>
                        </div>
                    </x-card.header>
                    <x-card.body>
                        @include('livewire.expedient.create.company_policy_info')
                    </x-card.body>

                    @if($policy->product)
                        <x-card.header>
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{__('Capitales')}}
                                </h3>
                            </div>
                        </x-card.header>
                        <x-card.body>
                            <div class="flex justify-end">{{__('Primer Riesgo')}}</div>
                            @forelse($capitals as $key => $capital)
                                <x-input.group for="capital.{{$key}}" wire:key="capital-group-{{$key}}" label="{{__($capital['name'])}}" :error="$errors->first('capital.' . $key . '.name')" borderless >
                                    <div class="flex justify-between space-x-4">
                                        <x-input.money wire:model="capitals.{{$key}}.amount" id="capital.{{$key}}" :error="$errors->first('capital.' . $key . '.name')" placeholder="Importe asegurado" />
                                        <x-input.checkbox wire:model="capitals.{{$key}}.primer_riesgo" size="9"/>
                                    </div>
                                </x-input.group>
                            @empty
                            @endforelse

                            <x-input.group label="Condiciones Particulares" for="condParticular"  :error="$errors->first('condParticular')" wire:key="cond-particulares" borderless>
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
                    @endif
                </x-card.card>
            @endif
        </section>
    </div>

    <div class="flex justify-end">
        <x-button.primary wire:click="goToStep(2)" class="inline-flex items-center space-x-2">
            <span>{{__('Datos del Siniestro')}}</span>
            <x-icon.chevron-right size="4"/>
        </x-button.primary>
    </div>
</div>
