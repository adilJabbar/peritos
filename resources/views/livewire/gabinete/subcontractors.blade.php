<div x-data="{showNewSubcontractor : @entangle('showNewSubcontractor')}">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    <strong>{{$gabinete->name}}</strong> · {{__('Subcontratas')}}
                </h3>
            </div>
            @can('user.create')
                <div class="flex-shrink-0">
                    <x-button.primary @click="showNewSubcontractor = !showNewSubcontractor">
                        @if($showNewSubcontractor)
                            <x-icon.minus size="4" />
                        @else
                            <x-icon.plus size="4" />
                        @endif
                    </x-button.primary>
                </div>
            @endcan
        </x-card.header>

        <!-- filters -->
        <div>
            <x-card.body class=" space-y-4" >
                <div class="flex justify-between space-x-4">
                    <!-- search -->
                    <div class=" flex-grow flex items-center space-x-4">
                        <div class="flex-grow">
                            <x-input.text wire:model="filters.search" id="search" placeholder="{{__('Search by name...')}}" />
                        </div>
                        <div>
                            <x-button.link class="flex-grow" wire:click="$toggle('showFilters')">@if($showFilters){{__('Hide filters...')}}@else{{__('Advanced search...')}}@endif</x-button.link>
                        </div>
                    </div>
                    <!-- per page selector -->
                    <div class="flex-shrink-0 flex justify-between space-x-2">
                        @if (count($subcontractors) > 10)
                            <x-input.group borderless paddingless for="perPage">
                                <x-input.select wire:model="perPage">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    @if(count($subcontractors) > 25)<option value="50">50</option>@endif
                                    @if(count($subcontractors) > 50)<option value="100">100</option>@endif
                                    @if(count($subcontractors) > 100)<option value="500">500</option>@endif
                                </x-input.select>
                            </x-input.group>
                        @endif
                        <!-- bulk actions -->
    {{--                    <x-dropdown.dropdown label="Bulk actions">--}}
    {{--                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">--}}
    {{--                            <x-icon.download class="text-cool-gray-400"/>--}}
    {{--                            <span>{{__('Export')}}</span>--}}
    {{--                        </x-dropdown.item>--}}

    {{--                        @can('user:delete')--}}
    {{--                            <x-dropdown.item type="button" wire:click="$set('showDeleteModal', true)" class="flex items-center space-x-2">--}}
    {{--                                <x-icon.trash class="text-cool-gray-400"/>--}}
    {{--                                <span>{{__('Delete')}}</span>--}}
    {{--                            </x-dropdown.item>--}}
    {{--                        @endcan--}}
    {{--                    </x-dropdown.dropdown>--}}
                    </div>
                </div>
            </x-card.body>
            <!-- Advanced Search -->
            <div>
                @if ($showFilters)
                    <div class="bg-gray-200 p-4 rounded shadow-inner relative grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div class="space-y-2">
                            <x-input.group inline for="filter-role" label="Role">
                                <x-input.select wire:model="filters.role" id="filter-role" placeholder="Select Role...">
                                    @foreach(Spatie\Permission\Models\Role::all() as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- show new subcontractor -->
        <div x-show="showNewSubcontractor" class="p-2" x-transition>
            <x-card.card class="border-2 border-primary">
                <x-card.body>

                    <!-- name -->
                    <x-input.group label="Name" for="name" :error="$errors->first('subcontractor.name')" borderless>
                        <x-input.text wire:model.lazy="subcontractor.name" id="name" placeholder="Name" :error="$errors->first('subcontractor.name')" />
                    </x-input.group>

                    <!-- legal_name -->
                    <x-input.group label="Legal name" for="legal_name" class="sm:pt-0" borderless :error="$errors->first('subcontractor.legal_name')">
                        <x-input.text wire:model.lazy="subcontractor.legal_name" id="legal_name" :error="$errors->first('subcontractor.legal_name')" placeholder="Legal name"/>
                    </x-input.group>

                    <!-- cif -->
                    <x-input.group label="CIF" for="cif" class="sm:pt-0" borderless :error="$errors->first('subcontractor.cif')">
                        <x-input.text wire:model.lazy="subcontractor.legal_id" id="cif" :error="$errors->first('subcontractor.cif')" placeholder="CIF"/>
                    </x-input.group>

                    <!-- address -->
                    <x-input.group label="Address" for="address" :error="$errors->first('subcontractor.address')">
                        <x-input.text wire:model.lazy="subcontractor.address" id="address" :error="$errors->first('subcontractor.address')" placeholder="Address"/>
                    </x-input.group>

                    <!-- city -->
                    <x-input.group label=" " for="city" :error="$errors->first('subcontractor.city')" borderless>
                        <x-input.text wire:model.lazy="subcontractor.city" id="city" :error="$errors->first('subcontractor.city')" placeholder="City"/>
                    </x-input.group>

                    <x-input.group label=" " for="zip" borderless>
                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                            <!-- zip -->
                            <x-input.text wire:model.lazy="subcontractor.zip" id="zip" :error="$errors->first('subcontractor.zip')" placeholder="Zip code"/>
                            <!-- state -->
                            <x-input.text wire:model.lazy="subcontractor.state" id="state" :error="$errors->first('subcontractor.state')" placeholder="State"/>
                        </div>
                    </x-input.group>

                    <!-- country_id -->
                    <x-input.group label="Country" for="country_id" :error="$errors->first('subcontractor.country_id')" borderless>
                        <x-input.select wire:model="subcontractor.country_id" id="country_id" :error="$errors->first('subcontractor.country_id')" placeholder="Select country">
                            @foreach(\App\Models\Admin\Country::all() as $country)
                                <option value="{{$country->id}}">{{ $country->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <!-- phone -->
                    <x-input.group label="Phone" for="phone" :error="$errors->first('subcontractor.phone')">
                        <x-input.text wire:model="subcontractor.phone" id="phone"  :error="$errors->first('subcontractor.phone')" placeholder="Phone number"/>
                    </x-input.group>

                    <!-- email -->
                    <x-input.group label="Email address" for="email" :error="$errors->first('subcontractor.email')" borderless>
                        <x-input.text wire:model="subcontractor.email" id="email" type="email" autocomplete="new-email" :error="$errors->first('subcontractor.email')" placeholder="Email adress"/>
                    </x-input.group>

                    <!-- save -->
                    <div class="flex justify-end">
                        <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
                    </div>
                </x-card.body>
            </x-card.card>
        </div>

        <!-- table -->
        <x-table.table>
            <x-slot name="head">
                <x-table.heading class="pr-0 w-8">
                    <x-input.checkbox wire:model="selectPage" />
                </x-table.heading>
                <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="w-full">{{__('Name')}}</x-table.heading>
                <x-table.heading sortable multi-column wire:click="sortBy('city')" :direction="$sorts['city'] ?? null" >{{__('City')}}</x-table.heading>
                <x-table.heading sortable multi-column wire:click="sortBy('state')" :direction="$sorts['state'] ?? null" >{{__('State')}}</x-table.heading>
                <x-table.heading sortable multi-column wire:click="sortBy('country_id')" :direction="$sorts['country_id'] ?? null" >{{__('Country')}}</x-table.heading>
                <x-table.heading centered>{{__('Users')}}</x-table.heading>
                <x-table.heading>
                    @if ($sorts)
                        <x-button.link wire:click="$set('sorts', [])"><x-icon.x size="3" /></x-button.link>
                    @endif
                </x-table.heading>
            </x-slot>


            <x-slot name="body">
                @if($selected)
                    @include('components.table.rows_selected_row', ['total' => $subcontractors->total()])
                @endif
                @forelse ($subcontractors as $subcontractorRow)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $subcontractorRow->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $subcontractorRow->id }}" />
                        </x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center">
{{--                                <div class="flex-shrink-0 h-10 w-10 flex items-center">--}}
{{--                                    <img class="max-h-10 max-w-10 " src="{{ $subcontractorRow->logo_url }}" alt="">--}}
{{--                                </div>--}}
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$subcontractorRow->name}}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{$subcontractorRow->cif}}
                                    </div>
                                </div>
                            </div>
                        </x-table.cell>

                        <x-table.cell class="whitespace-nowrap">
                            <span class="text-gray-900 font-medium">{{ $subcontractorRow->city  }} </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $subcontractorRow->state  }} </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-gray-900 font-medium">{{ $subcontractorRow->country->name ?? dd($subcontractorRow)}} </span>
                        </x-table.cell>

                        <x-table.cell class="text-right">
                            <span class="text-gray-900 font-medium">{{ $subcontractorRow->users->count()  }} </span>
                        </x-table.cell>


                        <x-table.cell class="whitespace-nowrap">
                            @can('gabinete.update')
                                <x-button.primary wire:click="edit({{$subcontractorRow->id}})" size="sm">
                                    <x-icon.pencil size="5" />
                                </x-button.primary>
                            @endcan
                        </x-table.cell>

                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="8">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-6 w-6 text-cool-gray-300"/>
                                <span class="text-cool-gray-500 text-medium">{{__(':Gabinete no tiene ninguna subcontrata creada.', ['gabinete' => $this->gabinete->name])}}</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
        {{ $subcontractors->links() }}

    {{--    @include('partials.user.new_user_modal', ['showGabineteSelector' => false])--}}

    </x-card.card>
</div>
