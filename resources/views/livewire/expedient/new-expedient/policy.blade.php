<div class="space-y-4" x-data="{showCapitals : @entangle('showCapitals')}">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent >{{__('Alta de expediente')}}</x-breadcumb.item>
                @if($expedient->gabinete_id)
                    <x-breadcumb.item>{{__($expedient->gabinete->name)}}</x-breadcumb.item>
                    @if($expedient->getKey())
                        <x-breadcumb.item>{{ $expedient->full_code }}</x-breadcumb.item>
                    @endif
                    <x-breadcumb.item>{{ __('Datos de la póliza') }}</x-breadcumb.item>
                @endif
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            {{__('Datos de la póliza')}}
        </x-card.header>
        <x-card.body>
            <x-input.group for="insurance-company"  label="Compañía aseguradora" :error="$errors->first('insuranceCompany')" borderless>
                @if(class_basename($expedient->billable) === 'Company')
                    <x-input.text id="insurance-company" value="{{$expedient->billable->name}}" readonly />
                @else
                    <div class="flex space-x-4">
                        <div class="{{$insuranceCompany == 'notListedCompany' ? 'sm:w-1/2' : 'flex-grow' }}">
                            <x-input.select wire:model.lazy="insuranceCompany" id="insurance-company" :error="$errors->first('insuranceCompany')" placeholder="Nombre de la compañía aseguradora">
                                <option value="notListedCompany">{{__('Mi compañía no está en la lista')}}</option>
                                @forelse($expedient->country->companies()->sortBy('name') as $companyRow)
                                    <option value="{{ $companyRow->id }}">{{ $companyRow->name }}</option>
                                @empty
                                    <option value="empty">{{__('No hay ninguna compañía aseguradora en :country', ['country' => $expedient->country])}}</option>
                                @endforelse
                            </x-input.select>
                        </div>
                        @if($insuranceCompany == 'notListedCompany')
                            <div class="sm:w-1/2">
                                <x-input.text wire:model.lazy="policy.name_cia" id="policy-name_cia" placeholder="Nombre de la compañía" />
                            </div>
                        @endif
                    </div>

                @endif
            </x-input.group>

            <x-input.group for="policy.reference"  wire:key="policy.reference" label="Número de póliza" :error="$errors->first('policy.reference')" borderless>
                <x-input.text wire:model.lazy="policy.reference" id="policy.reference" :error="$errors->first('policy.reference')" placeholder="Número o referencia de la póliza" />
            </x-input.group>

            <div>
                @if($expedient->ramo)
                    <x-input.group for="product" label="Condiciones Generales / Producto" :error="$errors->first('policy.product_id')" borderless wire:key="producto-select">
                        <x-input.select wire:model="policy.product_id" id="product"
                                        placeholder="Selecciona las condiciones generales..."
                                        :error="$errors->first('policy.product_id')">
                            <option value="{{ $expedient->ramo->default_product_id }}">{{__('Condicionado por defecto para :ramo en :country', ['ramo' => $expedient->ramo->name, 'country' => __($expedient->ramo->country->name)])}}</option>

                            @if($policy->company)
                                @forelse($policy->company->products->where('ramo_id', $expedient->ramo_id)->sortBy('name') as $productOption)
                                    <option value="{{ $productOption->id }}">{{__($productOption->name)}}</option>
                                @empty
                                @endforelse
                            @endif

                        </x-input.select>
                    </x-input.group>
                @endif
                <x-input.group for="cond-particular" label="Condiciones Particulares" :error="$errors->first('cond_particular')" borderless wire:key="producto-select">
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
                            <x-input.filepond wire:model="condParticular"
                                              id="condParticular"
                                              validation="'application/pdf', 'image/*'"
                                              maxSize="2048KB" />
                    </div>
                </x-input.group>
            </div>
        </x-card.body>

        <div x-show="!showCapitals">
            <x-card.footer class="flex justify-end">
                <x-button.primary wire:click="enterCapitals">{{__('Introducir capitales')}}</x-button.primary>
            </x-card.footer>
        </div>
    </x-card.card>

    <div x-show="showCapitals">
{{--        @if($policy->product && $policy->reference)--}}
            <x-card.card class="divide-gray-200 divide-y">
                <x-card.header>
                    {{__('Capitales')}}
                </x-card.header>

                <!-- capitals with primer riesgo and amount -->
                <x-card.body>
                    <div class="flex justify-end">{{ __('Primer Riesgo')}}</div>
{{--                    <div class="flex justify-end">{{ $this->policy->product->ramo ? __('Primer Riesgo') : __('Utilizar')}}</div>--}}
{{--                        @dd($key)--}}

                    @forelse($availableCapitals as $capital)
                        <livewire:policy.capital-row :capital="$capital" :policy="$policy" :assesments="0" wire:key="capital-row-{{$capital->id}}" />

                    @empty
                    @endforelse

                    @if ($errors->first('capitals'))
                        <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('capitals') }}</div>
                    @endif
                </x-card.body>
                <x-card.footer class="flex justify-end">
                    <x-button.primary wire:click="saveAndGoTo('Terceros')">{{__('Guardar y pasar a datos de terceros')}}</x-button.primary>
                </x-card.footer>
            </x-card.card>
{{--        @endif--}}
    </div>

</div>
