<div>
    <x-input.group for="riskgroup" label="Tipo de riesgo" borderless
                   :error="$errors->first('riskgroup')">
        <div class="space-y-4">
            <x-input.select wire:model="riskgroup.id" id="riskgroup"
                            :error="$errors->first('riskgroup')">
                <option disabled value="0">{{ __('Selecciona el tipo de riesgo...') }}</option>
                @foreach($expedient->address->country->riskgroups as $riskGroupOption)
                    <option value="{{ $riskGroupOption->id }}">{{ __($riskGroupOption->name) }}</option>
                @endforeach
            </x-input.select>

            @if($riskgroup->getKey())
                <x-input.select wire:model="risksubgroup.id" id="risksubgroup"
                                :error="$errors->first('risksubgroup')" wire:key="risksubgroup">
                    <option disabled value="0">{{ __('Selecciona el grupo de riesgo...') }}</option>
                    @foreach($riskgroup->risksubgroups as $riskSubgroupOption)
                        <option value="{{ $riskSubgroupOption->id }}">{{ __($riskSubgroupOption->name) }}</option>
                    @endforeach
                </x-input.select>
            @endif

            @if($risksubgroup->getKey())
                <x-input.select wire:model="preexistence.riskdetail_id" id="riskdetail"
                                placeholder="Selecciona el tipo de riesgo..."
                                :error="$errors->first('preexistence.riskdetail_id')" wire:key="preexistence-riskdetail">
                    @foreach($risksubgroup->riskdetails as $riskDetailOption)
                        <option value="{{ $riskDetailOption->id }}">{{ __($riskDetailOption->description) }}</option>
                    @endforeach
                </x-input.select>

            @endif
        </div>
        @if($risksubgroup->getKey())
            <div class="mt-4 grid grid-cols-3 gap-4">
                <x-input.group for="preesxistence-dimension" label="Superficie m²" inline borderless
                               :error="$errors->first('preexistence.dimension')">
                    <x-input.text wire:model.lazy="preexistence.dimension" id="preexistence-dimension" type="number" :error="$errors->first('preexistence.dimension')" placeholder="Superficie del inmueble..."/>
                </x-input.group>
                <x-input.group for="preesxistence-year" label="Año de construcción" inline borderless
                               :error="$errors->first('preexistence.year')">
                    <x-input.text wire:model.lazy="preexistence.year" id="preexistence-year" type="number" :error="$errors->first('preexistence.year')" placeholder="Año de construcción..."/>
                </x-input.group>
                <x-input.group for="yearsOld" label="Antigüedad" inline borderless
                               :error="$errors->first('yearsOld')">
                    <x-input.text wire:model.lazy="yearsOld" id="yearsOld" type="number" :error="$errors->first('yearsOld')" placeholder="Años de antigüedad..."/>
                </x-input.group>
            </div>
        @endif

    </x-input.group>

    <x-input.group for="risk-pictures" label="Fotografías del riesgo" :error="$errors->first('risk-pictures')">
        <div class="grid lg:grid-cols-2 gap-4">

            <x-input.group label="Exterior" for="exterior-picture"  :error="$errors->first('riskOutsidePicture')" inline no-shadow>
                <x-input.file wire:model="riskOutsidePicture" id="exterior-picture" button-below>
                    <div class="w-full bg-white text-gray-300 flex items-center">
                        @if($riskOutsidePicture)
                            <img wire:click="showGallery({{$preexistence->outside_picture->id ?? ''}})" class="rounded-md mx-auto cursor-pointer" src="{{ $riskOutsidePicture->temporaryUrl() }}" alt="{{ __('Vista exterior') }}">
                        @else
                            <img wire:click="showGallery({{$preexistence->outside_picture->id ?? ''}})" class="rounded-md mx-auto cursor-pointer" src="{{ $preexistence->outside_picture_url }}" alt="{{ __('Vista exterior') }}">
                        @endif
                    </div>
                </x-input.file>
            </x-input.group>

            <x-input.group label="Interior" for="interior-picture"  :error="$errors->first('riskInsidePicture')" inline no-shadow>
                <x-input.file wire:model="riskInsidePicture" id="interior-picture" button-below>
                    <div class="w-full bg-white text-gray-300 flex items-center">
                        @if($riskInsidePicture)
                            <img wire:click="showGallery({{$preexistence->inside_picture->id ?? ''}})" class="rounded-md mx-auto cursor-pointer" src="{{ $riskInsidePicture->temporaryUrl() }}" alt="{{ __('Vista interior') }}">
                        @else
                            <img wire:click="showGallery({{$preexistence->inside_picture->id ?? ''}})" class="rounded-md mx-auto cursor-pointer" src="{{ $preexistence->inside_picture_url }}" alt="{{ __('Vista interior') }}">
                        @endif
                    </div>
                </x-input.file>
            </x-input.group>

        </div>

    </x-input.group>

    @if($preexistence->riskdetail_id && $preexistence->dimension)
        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:py-2">
            <div>
                <label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                    {{ __( 'Información del inmueble' ) }}
                </label>
            </div>

            <div class="mt-1 sm:mt-0 sm:col-span-2">
                {{--        <x-input.group for="construction-features" label="Información del inmueble">--}}
                <div class="grid grid-cols-3 gap-4">

                    <x-input.group for="preesxistence-structure" label="Estructura" inline borderless
                                   :error="$errors->first('preesxistence.structure')">
                        <x-input.select wire:model="preexistence.structure" id="preesxistence-structure"
                                        placeholder="Tipo de estructura..."
                                        :error="$errors->first('preexistence.structure')" wire:key="preexistence-structure">
                            <option value="noVista">{{ __('No vista') }}</option>
                            <option value="hormigon">{{ __('Hormigón') }}</option>
                            <option value="mixta">{{ __('Mixta') }}</option>
                            <option value="metalica">{{ __('Metálica') }}</option>
                            <option value="murosDeCarga">{{ __('Muros de Carga') }}</option>
                            <option value="madera">{{ __('Madera') }}</option>

                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="preesxistence-roof" label="Cubierta" inline borderless
                                   :error="$errors->first('preesxistence.roof')">
                        <x-input.select wire:model="preexistence.roof" id="preesxistence-roof"
                                        placeholder="Tipo de cubierta..."
                                        :error="$errors->first('preexistence.roof')" wire:key="preexistence-roof">
                            <option value="noVista">{{ __('No vista') }}</option>
                            <option value="teja">{{ __('Teja') }}</option>
                            <option value="plana">{{ __('Plana / Azotea') }}</option>
                            <option value="pizarra">{{ __('Pizarra') }}</option>
                            <option value="metalica">{{ __('Metálica') }}</option>
                            <option value="plastico">{{ __('Plástico / Malla') }}</option>

                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="preesxistence-wall" label="Fachada" inline borderless
                                   :error="$errors->first('preesxistence.wall')">
                        <x-input.select wire:model="preexistence.wall" id="preesxistence-wall"
                                        placeholder="Tipo de fachada..."
                                        :error="$errors->first('preexistence.wall')" wire:key="preexistence-wall">
                            <option value="ladrillo">{{ __('Ladrillo') }}</option>
                            <option value="monocapa">{{ __('Monocapa') }}</option>
                            <option value="enfoscada">{{ __('Enfoscada') }}</option>
                            <option value="piedra">{{ __('Piedra') }}</option>
                            <option value="placada">{{ __('Placada') }}</option>
                            <option value="ventilada">{{ __('Ventilada') }}</option>
                            <option value="muroCortina">{{ __('Muro Cortina') }}</option>
                            <option value="plastico">{{ __('Plástico') }}</option>
                            <option value="metalica">{{ __('Metálica') }}</option>

                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="preesxistence-rooms" label="Habitaciones" inline borderless
                                   :error="$errors->first('preexistence.rooms')">
                        <x-input.text wire:model.lazy="preexistence.rooms" id="preexistence-rooms" type="number" :error="$errors->first('preexistence.rooms')" placeholder="Nº de habitaciones..."/>
                    </x-input.group>

                    <x-input.group for="preesxistence-quality" label="Calidad" inline borderless
                                   :error="$errors->first('preesxistence.quality')">
                        <x-input.select wire:model="preexistence.quality" id="preesxistence-quality"
                                        placeholder="Calidad..."
                                        :error="$errors->first('preexistence.quality')" wire:key="preexistence-quality">
                            <option value="luxe">{{ __('Lujo') }}</option>
                            <option value="high">{{ __('Alta') }}</option>
                            <option value="media">{{ __('Media') }}</option>
                            <option value="low">{{ __('Baja') }}</option>
                            <option value="vpo">{{ __('Muy baja') }}</option>

                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="preesxistence-maintenance" label="Mantenimiento" inline borderless
                                   :error="$errors->first('preesxistence.maintenance')">
                        <x-input.select wire:model="preexistence.maintenance" id="preesxistence-maintenance"
                                        :error="$errors->first('preexistence.maintenance')" wire:key="preexistence-maintenance">
                            <option disabled>{{ __('Estado de mantenimiento...') }}</option>
                            <option value="1.20">{{ __('Excelente') }}</option>
                            <option value="1.00">{{ __('Bueno') }}</option>
                            <option value="0.80">{{ __('Regular') }}</option>
                            <option value="0.60">{{ __('Malo') }}</option>
                            <option value="0.30">{{ __('Lamentable') }}</option>
                            <option value="0.00">{{ __('Ruina') }}</option>

                        </x-input.select>
                    </x-input.group>

                </div>

            </div>
        </div>

        <x-input.group for="use-features" label="Información del uso" >
            <div class="grid grid-cols-3 gap-4">

                <x-input.group for="preesxistence-owner" label="Propietario" inline borderless
                               :error="$errors->first('preesxistence.owner')">
                    <x-input.select wire:model="preexistence.owner" id="preesxistence-owner"
                                    placeholder="El propietario es..."
                                    :error="$errors->first('preexistence.owner')" wire:key="preexistence-owner">
                        <option value="asegurado">{{ __('Asegurado') }}</option>
                        <option value="tercero">{{ __('Tercero') }}</option>
                        <option value="desconocido">{{ __('Desconocido') }}</option>

                    </x-input.select>
                </x-input.group>

                <x-input.group for="preesxistence-user" label="Ocupante" inline borderless
                               :error="$errors->first('preesxistence.user')">
                    <x-input.select wire:model="preexistence.user" id="preesxistence-user"
                                    placeholder="El ocupante es..."
                                    :error="$errors->first('preexistence.user')" wire:key="preexistence-user">
                        <option value="asegurado">{{ __('Asegurado') }}</option>
                        <option value="tercero">{{ __('Tercero') }}</option>
                        <option value="desconocido">{{ __('Desconocido') }}</option>

                    </x-input.select>
                </x-input.group>

                <x-input.group for="preesxistence-used_as" label="Uso del inmueble" inline borderless
                               :error="$errors->first('preesxistence.used_as')">
                    <x-input.select wire:model="preexistence.used_as" id="preesxistence-used_as"
                                    placeholder="El inmueble se usa como..."
                                    :error="$errors->first('preexistence.used_as')" wire:key="preexistence-used_as">
                        <option value="habitual">{{ __('Vivienda habitual') }}</option>
                        <option value="segundaResidencia">{{ __('Segunda residencia') }}</option>
                        <option value="sinUso">{{ __('No tiene uso') }}</option>

                    </x-input.select>
                </x-input.group>

                <x-input.group for="preesxistence-people" label="Ocupantes" inline borderless
                               :error="$errors->first('preexistence.people')">
                    <x-input.text wire:model.lazy="preexistence.people" id="preexistence-people" type="number" :error="$errors->first('preexistence.people')" placeholder="Nº de personas..."/>
                </x-input.group>

                <x-input.group for="preesxistence-furniture" label="Calidad del mobiliario" inline borderless
                               :error="$errors->first('preesxistence.furniture')">
                    <x-input.select wire:model="preexistence.furniture" id="preesxistence-furniture"
                                    placeholder="La calidad del mobiliario es..."
                                    :error="$errors->first('preexistence.furniture')" wire:key="preexistence-furniture">
                        <option value="luxe">{{ __('Lujo') }}</option>
                        <option value="high">{{ __('Alta') }}</option>
                        <option value="media">{{ __('Media') }}</option>
                        <option value="low">{{ __('Baja') }}</option>
                        <option value="vpo">{{ __('Muy baja') }}</option>

                    </x-input.select>
                </x-input.group>

                <x-input.group for="preesxistence-amount" label="Cantidad de mobiliario" inline borderless
                               :error="$errors->first('preesxistence.amount')">
                    <x-input.select wire:model="preexistence.amount" id="preesxistence-amount"
                                    placeholder="La cantidad de mobiliario es..."
                                    :error="$errors->first('preexistence.amount')" wire:key="preexistence-amount">
                        <option value="high">{{ __('Alta') }}</option>
                        <option value="normal">{{ __('Normal') }}</option>
                        <option value="low">{{ __('Baja') }}</option>
                        <option value="empty">{{ __('Vacío') }}</option>

                    </x-input.select>
                </x-input.group>

                <x-input.checkbox wire:model="preexistence.pets" label="¿Hay mascotas?" size="6" />

            </div>


        </x-input.group>



        <div>
            <dl class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-2 md:divide-y-0 md:divide-x">
                <div>
                    <div class="px-4 py-2">
                        <dt class="text-base font-normal text-gray-900 flex justify-between">
                            <div>
                                {{__('Continente: Valores propuestos')}}
                            </div>
                            <div>
                                <x-button.secondary size="xs" wire:click="showContinenteCalculations" ><x-icon.eye solid size="6" /></x-button.secondary>
                                <x-button.secondary size="xs" wire:click="loadProposalContinent" ><x-icon.arrow-down solid size="6" /></x-button.secondary>
                            </div>
                        </dt>
                        <dd class="mt-1 flex justify-around items-baseline md:block lg:flex">
                            <div>
                                <div>
                                    {{__('Reposición')}}
                                </div>
                                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                    <x-output.currency value="{{$preexistence->continentValueProposal($preexistence->building_value)}}" :currency="$preexistence->address->country->currency"/>
                                </div>
                            </div>
                            <div>
                                <div >
                                    {{__('Real')}}
                                </div>
                                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                    <x-output.currency value="{{$preexistence->continentValueProposal($preexistence->building_value) * $preexistence->building_deprecation_coeficient}}" :currency="$preexistence->address->country->currency"/>
                                </div>
                            </div>


                        </dd>
                    </div>
                </div>

                <div>
                    <div class="px-4 py-2">
                        <dt class="text-base font-normal text-gray-900 flex justify-between">
                            <div>
                                {{__('Contenido: Valor propuesto')}}
                            </div>
                            <div>
                                <x-button.secondary wire:click="showContenidoCalculations" size="xs"><x-icon.eye solid size="6" /></x-button.secondary>
                                <x-button.secondary wire:click="loadProposalContent" size="xs"><x-icon.arrow-down solid size="6" /></x-button.secondary>
                            </div>
                        </dt>
                        <dd class="mt-1 flex justify-around items-baseline md:block lg:flex">
                            <div>
                                <div>
                                    {{__('Reposición')}}
                                </div>
                                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                    <x-output.currency value="{{$preexistence->contentValueProposal()}}" :currency="$preexistence->address->country->currency"/>
                                </div>
                            </div>
                        </dd>
                    </div>
                </div>

            </dl>
        </div>

        <div class="mt-4">
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading></x-table.heading>
                    <x-table.heading>{{__('Capital')}}</x-table.heading>
                    <x-table.heading>{{__('Asegurado')}}</x-table.heading>
                    <x-table.heading>{{__('Primer Riesgo')}}</x-table.heading>
                    <x-table.heading>{{__('% Compañía')}}</x-table.heading>
                    <x-table.heading>{{__('Reposición')}}</x-table.heading>
                    <x-table.heading>{{__('% Depreciación')}}</x-table.heading>
                    <x-table.heading>{{__('Real')}}</x-table.heading>
                    <x-table.heading>{{__('Asegurable')}}</x-table.heading>
                    <x-table.heading>{{__('Infraseguro')}}</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($expedient->policy->product->capitals as $capital)
                        <livewire:expedient.preexistence.capital-row :currency="$expedient->currency()" :capital="$capital" :policy="$expedient->policy" :key="'capital-'.$capital->id" />
                    @empty
                        no hay ningún capital
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>

    @endif



    {{--    @include('livewire.gallery.modal')--}}
    @if($preexistence->address)
        @include('livewire.gallery.modal', ['images' => $preexistence->images, 'title' => 'Fotografías del riesgo', 'activeFoto' => $activeFoto])
        @include('partials.expedient.preexistence.home.continente')
        @include('partials.expedient.preexistence.home.contenido')
    @endif

</div>
