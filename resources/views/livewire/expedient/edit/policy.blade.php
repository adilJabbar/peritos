<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Información de la póliza'" />
    </x-card.card>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="space-y-4">
            <section aria-labelledby="Condiciones Generales">
                <div class="space-y-4">
                    <x-card.card class="divide-gray-200 divide-y">
                        @if($isCompanyExpedient)
                            <x-card.header>
                                {{__('Condiciones Generales')}}
                            </x-card.header>
                            <x-card.body>
                                <x-input.group label="Compañía" for="cia" :error="$errors->first('policy.product_id')" borderless>
                                    <x-input.text id="cia" value="{{ $expedient->billable->name }}" readonly />
                                </x-input.group>
                                <x-input.group label="Ramo" for="ramo" :error="$errors->first('ramo')" borderless>
                                    <x-input.text id="ramo" value="{{ __($expedient->ramo->name) }}" readonly />
                                </x-input.group>
                                <x-input.group label="Condiciones Generales / Producto" for="product" :error="$errors->first('policy.product_id')" borderless>
                                    <x-input.select wire:model="policy.product_id" placeholder="Selecciona las condiciones generales..." id="product">
                                        <option value="{{ $expedient->ramo->default_product_id }}">{{__('Condicionado por defecto para :ramo en :country', ['ramo' => $expedient->ramo->name, 'country' => __($expedient->ramo->country->name)])}}</option>
                                        @if($policy->company)
                                            @forelse($policy->company->products->where('ramo_id', $expedient->ramo_id)->sortBy('name') as $productOption)
                                                <option value="{{ $productOption->id }}">{{__($productOption->name)}}</option>
                                            @empty
                                            @endforelse
                                        @endif
{{--                                        @forelse($products as $product)--}}
{{--                                            <option value="{{ $product->id }}">{{ $product->name }}</option>--}}
{{--                                        @empty--}}
{{--                                        @endforelse--}}
                                    </x-input.select>
                                </x-input.group>
                            </x-card.body>

                        @else
                            <x-card.body>
                                <x-input.group label="Ramo" for="ramo" borderless>
                                    <x-input.text id="ramo" value="{{ __($expedient->ramo->name) }}" readonly />
                                </x-input.group>
                                <x-input.group label="Compañía" for="name_cia" :error="$errors->first('policy.name_cia')" borderless>
                                    <x-input.text wire:model.lazy="policy.name_cia" id="name_cia" placeholder="Nombre de la compañía" :error="$errors->first('policy.name_cia')"/>
                                </x-input.group>
                                <x-input.group label="Número de Póliza" for="reference" :error="$errors->first('policy.reference')" borderless>
                                    <x-input.text wire:model="policy.reference" id="reference" placeholder="Referencia de la póliza" :error="$errors->first('policy.reference')" />
                                </x-input.group>
                            </x-card.body>
                            <x-card.footer>
                                <x-button.primary wire:click="save">{{__('Update')}}</x-button.primary>
                            </x-card.footer>
                        @endif
                    </x-card.card>
                </div>
            </section>

            <!-- Capitals -->
            <section aria-labelledby="Capitals">
{{--                @json($policy)--}}
                @if($policy->product && $policy->reference)
                    <div class="space-y-4">
                        <x-card.card class="divide-gray-200 divide-y">
                            <x-card.header>
                                <span>{{__('Capitales')}}</span>
                                <span>{{__('Primer Riesgo')}}</span>
                            </x-card.header>

                            <!-- capitals with primer riesgo and amount -->
                            <x-card.body>
{{--                                <div class="flex justify-end">{{ __('Primer Riesgo')}}</div>--}}
                                @forelse($availableCapitals as $capital)
                                    <livewire:policy.capital-row :capital="$capital" :policy="$policy" :assesments="$expedient->assessments->where('capital_id', $capital->id)->count()" wire:key="capital-row-{{$capital->id}}" />

                                @empty
                                @endforelse
                                @if ($errors->first('capitals'))
                                    <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('capitals') }}</div>
                                @endif
                            </x-card.body>
                        </x-card.card>

                    </div>
                @endif

            </section>

        </div>


        <section aria-labelledby="Documentos relativos a la póliza">
            <div class="space-y-4">
                <x-card.card class="divide-gray-200 divide-y">
                    @if($isCompanyExpedient)
                        <div class="w-full mb-2">
                            <div class="sm:hidden">
                                <label for="tabs" class="sr-only">{{__('Selecciona el documento a consultar')}}</label>
                                <select id="tabs" wire:model="docToView" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                    <option value="generales">{{__('Condiciones Generales')}}</option>
                                    <option value="particulares">{{__('Condiciones Particulares')}}</option>
                                </select>
                            </div>
                            <div class="hidden sm:block">
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex" aria-label="Tabs">

                                        <a href="#" wire:click="$set('docToView', 'generales')" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm {{ $docToView === 'generales' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} ">
                                            {{__('Condiciones Generales')}}
                                        </a>

                                        <a href="#" wire:click="$set('docToView', 'particulares')" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm {{ $docToView === 'particulares' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} " aria-current="page">
                                            {{__('Condiciones Particulares')}}
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        @if($docToView === 'generales')
                            @if(($policy->product))
                                @if($policy->product->cond_general)
                                    <iframe wire:key="condicionesGenerales{{$policy->product->cond_general}}" src ="{{ asset('/laraview/#../files/insurance/products/' . $policy->product->cond_general) }}" width="100%" height="600px"></iframe>
                                @else
                                    <x-card.body>
                                        <p>{{__('No hay condicionado general disponbile para este producto')}}</p>
                                    </x-card.body>
                                @endif
                            @endif
                                @if($policy->product_id)
                                    @can('administration')
                                        @if ($condicionesGenerales)
                                            <x-card.body>
                                                <p>{{__('Has cambiado el condicionado general. Haz click en el boton de actualizar para confirmar los cambios.')}}</p>
                                                <div class="p-4 flex justify-around">
                                                    <x-button.secondary wire:click="cancel('condicionesGenerales')">{{__('Cancel')}}</x-button.secondary>
                                                    <x-button.primary wire:click="save">{{__('Update')}}</x-button.primary>
                                                </div>
                                            </x-card.body>
                                        @else
                                            <x-card.body wire:key="{{$policy->product?->cond_general}}condicionesGeneralesInput">
                                                <x-input.filepond wire:model="condicionesGenerales" />
                                            </x-card.body>
                                        @endif
                                    @endcan
                                @endif
                        @elseif ($docToView === 'particulares')
                            @if(($policy->cond_particular))
                                <iframe wire:key="condicionesParticulares{{$policy->cond_particular}}" src ="{{ asset('/laraview/#../files/policies/' . $policy->cond_particular) }}" width="100%" height="600px"></iframe>
                            @else
                                <x-card.body>
                                    <p>{{__('No hay condiciones particulares disponbiles para esta póliza')}}</p>
                                </x-card.body>
                            @endif
                            @if ($condicionesParticulares)
                                <x-card.body>
                                    <p>{{__('Has cambiado las condiciones particulares. Haz click en el boton de actualizar para confirmar los cambios.')}}</p>
                                    <div class="p-4 flex justify-around">
                                        <x-button.secondary wire:click="cancel('condicionesParticulares')">{{__('Cancel')}}</x-button.secondary>
                                        <x-button.primary wire:click="save">{{__('Update')}}</x-button.primary>
                                    </div>
                                </x-card.body>
                            @else
                                <x-card.body wire:key="{{$expedient->policy->cond_particular}}Input">
                                    <x-input.filepond wire:model="condicionesParticulares" wire:key="{{$expedient->policy->cond_particular}}Input"/>
                                </x-card.body>
                            @endif

                        @endif
                    @else
                        <x-card.header>
                            {{__('Archivo con información relativa a la póliza')}}
                        </x-card.header>
                        @if(($policy->cond_particular))
                            <iframe wire:key="condicionesParticulares{{$policy->cond_particular}}" src ="{{ asset('/laraview/#../files/policies/' . $policy->cond_particular) }}" width="100%" height="600px"></iframe>
                        @else
                            <x-card.body>
                                <p>{{__('No hay condiciones particulares disponbiles para esta póliza')}}</p>
                            </x-card.body>
                        @endif
                        @if ($condicionesParticulares)
                            <x-card.body>
                                <p>{{__('Has cambiado las condiciones particulares. Haz click en el boton de actualizar para confirmar los cambios.')}}</p>
                                <div class="p-4 flex justify-around">
                                    <x-button.secondary wire:click="cancel('condicionesParticulares')">{{__('Cancel')}}</x-button.secondary>
                                    <x-button.primary wire:click="save">{{__('Update')}}</x-button.primary>
                                </div>
                            </x-card.body>
                        @else
                            <x-card.body wire:key="{{$policy->cond_particular}}Input">
                                <x-input.filepond wire:model="condicionesParticulares" wire:key="{{$policy->cond_particular}}Input"/>
                            </x-card.body>
                        @endif
                    @endif
                </x-card.card>
            </div>
        </section>

{{--        <x-card.card class="divide-y divide-gray-200">--}}
{{--            <x-card.header>--}}
{{--                <div>{{__('Condiciones particulares')}}</div>--}}
{{--            </x-card.header>--}}
{{--            <x-card.body wire:key="{{$expedient->policy->cond_particular}}Input">--}}
{{--                <x-input.filepond wire:model="condicionesParticulares" wire:key="{{$expedient->policy->cond_particular}}Input"/>--}}
{{--            </x-card.body>--}}
{{--            @if ($condicionesParticulares)--}}
{{--                <x-card.body>--}}
{{--                    <p>{{__('Has cambiado las condiciones particulares. Haz click en el boton de actualizar para confirmar los cambios.')}}</p>--}}
{{--                    <div class="p-4 flex justify-around">--}}
{{--                        <x-button.secondary wire:click="cancel('condicionesParticulares')">{{__('Cancel')}}</x-button.secondary>--}}
{{--                        <x-button.primary wire:click="save">{{__('Update')}}</x-button.primary>--}}
{{--                    </div>--}}
{{--                </x-card.body>--}}
{{--            @else--}}
{{--                <iframe id="{{$expedient->policy->cond_particular}}" src ="{{ asset('/laraview/#../policies/' . $expedient->policy->cond_particular) }}" width="100%" height="600px"></iframe>--}}
{{--            @endif--}}
{{--        </x-card.card>--}}
    </div>

</div>
