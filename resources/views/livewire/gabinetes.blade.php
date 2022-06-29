 <div>
     <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{__('Gabinetes')}}
                </h3>
    {{--            <p class="mt-1 text-sm text-gray-500">--}}
    {{--                Lorem ipsum dolor sit amet consectetur adipisicing elit quam corrupti consectetur.--}}
    {{--            </p>--}}
            </div>
            <div class="flex-shrink-0">

                <x-button.primary wire:click="create"><x-icon.plus size="4" /></x-button.primary>
            </div>
        </x-card.header>

        <x-card.body class="space-y-4" >
            <!-- header -->
            <div class="flex justify-between">
                <div class="w-2/4 flex space-x-4">
                    <x-input.text wire:model="filters.search" id="search" placeholder="{{__('Search by name...')}}" />
                    <x-button.link class="whitespace-nowrap" wire:click="$toggle('showFilters')">@if($showFilters){{__('Hide filters...')}}@else{{__('Advanced search...')}}@endif</x-button.link>
                </div>

                <div class="flex justify-between space-x-2">
                    @if (count($gabinetes) > 10)
                        <x-input.group borderless paddingless for="perPage">
                            <x-input.select wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                @if(count($gabinetes) > 25)<option value="50">50</option>@endif
                                @if(count($gabinetes) > 50)<option value="100">100</option>@endif
                                @if(count($gabinetes) > 100)<option value="500">500</option>@endif
                            </x-input.select>
                        </x-input.group>
                    @endif

                    <x-dropdown.dropdown label="Bulk actions">
                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                            <x-icon.download class="text-cool-gray-400"/>
                            <span>{{__('Export')}}</span>
                        </x-dropdown.item>

                        @can('gabinete:delete')
                            <x-dropdown.item type="button" wire:click="$set('showDeleteModal', true)" class="flex items-center space-x-2">
                                <x-icon.trash class="text-cool-gray-400"/>
                                <span>{{__('Delete')}}</span>
                            </x-dropdown.item>
                        @endcan
                    </x-dropdown.dropdown>

                    @can('gabinete:create')
                        <livewire:gabinete.import-gabinetes />

                    @endcan
                </div>

            </div>

            <!-- Advanced Search -->
            <div>
                @if ($showFilters)
                    <div class="bg-gray-200 p-4 rounded shadow-inner relative grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div class="space-y-2">
                            <x-input.group inline for="filter-legal_name" label="Legal Name">
                                <x-input.text wire:model="filters.legal_name" id="filter-legal_name" />
                            </x-input.group>

                            <x-input.group inline for="filter-legal_id" label="CIF">
                                <x-input.text wire:model="filters.legal_id" id="filter-legal_id" />
                            </x-input.group>

                            <x-input.group inline for="filter-phone" label="Phone">
                                <x-input.text wire:model="filters.phone" id="filter-phone" />
                            </x-input.group>
                        </div>

                        <div class="space-y-2">
                            <x-input.group inline for="filter-email" label="Email">
                                <x-input.text wire:model="filters.email" id="filter-email" />
                            </x-input.group>

                            <x-input.group inline for="filter-address" label="Address">
                                <x-input.text wire:model="filters.address" id="filter-address" />
                            </x-input.group>

                            <x-input.group inline for="filter-city" label="City">
                                <x-input.text wire:model="filters.city" id="filter-city" />
                            </x-input.group>

                        </div>

                        <div class="space-y-2">

                            <x-input.group inline for="filter-state" label="State">
                                <x-input.text wire:model="filters.state" id="filter-state" />
                            </x-input.group>

                            <x-input.group inline for="filter-country_id" label="Country">
                                <x-input.select wire:model="filters.country_id" id="filter-country_id" placeholder="Select Country...">
                                    @foreach(App\Models\Admin\Country::all() as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>

                            <x-input.radio-group inline for="filter-is-active" label="Active">
                                <x-input.radio-option wire:model="filters.active" value="1" label="Yes"/>
                                <x-input.radio-option wire:model="filters.active" value="0" label="No"/>
                            </x-input.radio-group>

                            <div class="flex">
                                <x-button.link wire:click="resetFilters" class="ml-auto right-0 bottom-0 px-4">{{__('Reset Filters')}}</x-button.link>
                            </div>

                        </div>


                    </div>
                @endif
            </div>

            <!-- table -->
            @include('livewire.gabinete.table')

        </x-card.body>

    </x-card.card>

     @include('livewire.gabinete.modal')

    <!-- Confirm delete modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">

            <x-slot name="title">
                {{__('Elminar Gabinetes')}}
                <x-button.close wire:click="$set('showDeleteModal', false)" />
            </x-slot>

            <x-slot name="content">
                {{ __('¿Estás seguro de que quieres eliminar estos gabinetes') }} {{ __('Esta acción no se puede deshacer.') }}
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">{{__('Cancel')}}</x-button.secondary>
                <x-button.danger type="submit">{{__('Eliminar')}}</x-button.danger>
            </x-slot>

        </x-modal.confirmation>
    </form>
</div>
