<div x-data="{showAddCompany : @entangle('showAddCompany') }">
    <x-card.card  class="divide-gray-200 divide-y">
        <x-card.header>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                <strong>{{$gabinete->name}}</strong> · {{__('Aseguradoras vinculadas')}}
            </h3>
            <div class="flex-shrink-0">
                <x-button.primary @click="showAddCompany = !showAddCompany">
                    @if($showAddCompany)
                        <x-icon.minus size="4" />
                    @else
                        <x-icon.plus size="4" />
                    @endif
                </x-button.primary>
            </div>
        </x-card.header>

        <!-- show add company -->
        <div x-show="showAddCompany" class="p-2" x-transition>
            <x-card.card class="border-2 border-primary">
                <x-card.body>
                    <x-input.group for="addCompany" label="Company" :error="$errors->first('addCompany')" borderless>
                        <x-input.select id="addCompany" wire:model.lazy="addCompany" :error="$errors->first('addCompany')" placeholder="Selecciona una compañía existente">
                            @foreach($companies->whereNotIn('id', $this->gabinete->companies->pluck('id'))->sortBy('name') as $companyOption)
                                <option value="{{$companyOption->id}}">{{__($companyOption->name)}}</option>
                            @endforeach
                                <option value="notListed">{{__('La compañía no está en la lista')}}</option>
                        </x-input.select>
                    </x-input.group>

                    <div>
                        @if($showNewCompany)
                            @include('partials.insurance.company.form-inputs')
                            @include('partials.forms.address', ['model' => 'address', 'readonly' => false])
                        @endif

                    </div>

                    <x-input.group for="default-assigned-user" label="Assign to" :error="$errors->first('defaultAssignUser')" borderless>
                        <x-input.select id="default-assigned-user" wire:model.lazy="defaultAssignUser" :error="$errors->first('defaultAssignUser')" placeholder="Selecciona el usuario al que se le asignará por defecto">
                            @foreach($gabinete->users->sortBy('name') as $userOption)
                                <option value="{{$userOption->id}}">{{__($userOption->full_name)}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="default-backoffice" label="Backoffice" :error="$errors->first('defaultBackoffice')" borderless>
                        <x-input.select id="default-backoffice" wire:model.lazy="defaultBackoffice" :error="$errors->first('defaultBackoffice')" placeholder="Selecciona el backoffice por defecto para esta compañía">
                            @foreach($gabinete->backoffices()->sortBy('name') as $userOption)
                                <option value="{{$userOption->id}}">{{__($userOption->full_name)}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <div class="flex justify-end">
                        <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
                    </div>
                </x-card.body>
            </x-card.card>
        </div>


        <x-table.table>
            <x-slot name="head">
                <x-table.heading>{{__('Compañía')}}</x-table.heading>
                <x-table.heading>{{__('Tramitadores')}}</x-table.heading>
                <x-table.heading>{{__('Siniestros Activos')}}</x-table.heading>
                <x-table.heading>{{__('Assign to')}}</x-table.heading>
                <x-table.heading>{{__('Backoffice')}}</x-table.heading>
                <x-table.heading class="w-0"></x-table.heading>
            </x-slot>
            <x-slot name="body">
                    @forelse($gabinete->companies->sortBy('name') as $rowCompany)
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex flex-shrink-0 items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center">
                                        <img class="max-h-10 max-w-10 " src="{{ $rowCompany->logo_url }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$rowCompany->name}}
                                        </div>
                                    </div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>{{ $gabinete->activeAgents()->where('company_id', $rowCompany->id)->count()  }}</x-table.cell>
                            <x-table.cell></x-table.cell>
    {{--                                @dd($rowCompany->pivot)--}}
                            <x-table.cell>{{ $gabinete->defaultUser($rowCompany)->full_name }}</x-table.cell>
    {{--                                <x-table.cell>{{ \App\Models\User::find($rowCompany->pivot['default_backoffice_user'])->full_name }}</x-table.cell>--}}
                            <x-table.cell>{{ $gabinete->backoffice($rowCompany)->full_name }}</x-table.cell>
                            <x-table.cell class="flex justify-end">
                                <x-button.primary wire:click="showCompany({{$rowCompany->id}})" size="xs"><x-icon.eye size="5" /></x-button.primary>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="4" class="text-sm font-medium text-gray-900">
                                {{__('No hay ninguna compañía asociada a este gabinete')}}
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                </x-slot>
            </x-table.table>

    {{--                <div>--}}
    {{--                    <x-input.group for="add-gabinete" label="Añadir gabinete">--}}
    {{--                        <x-input.select wire:model="addGabinete" id="add-gabinete" placeholder="Selecciona un gabinete">--}}
    {{--                            @forelse($gabinetes->whereNotIn('id', $company->gabinetes->pluck('id')) as $newGabinete)--}}
    {{--                                <option value="{{ $newGabinete->id }}">{{ $newGabinete->name }}</option>--}}
    {{--                            @empty--}}
    {{--                                <option disabled>{{__('No hay más gabinetes que no trabajen con')}} {{__($company->name)}}</option>--}}
    {{--                            @endforelse--}}
    {{--                        </x-input.select>--}}
    {{--                    </x-input.group>--}}
    {{--                </div>--}}
        </x-card.card>
</div>
