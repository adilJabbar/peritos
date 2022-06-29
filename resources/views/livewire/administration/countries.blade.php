<div>
    @unless($this->country->getKey())
        <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>{{__('Countries')}}</div>
            <div class="flex-shrink-0">
                <x-button.primary wire:click="create"><x-icon.plus size="4" /></x-button.primary>
            </div>
        </x-card.header>
        <x-card.body class="space-y-4">
            <!-- Search and actions -->
            <div class="flex justify-between">
                <div class="w-2/4 flex space-x-4">
                    <x-input.text wire:model="filters.search" id="search" placeholder="{{__('Search by name...')}}" />
                    <x-button.link class="whitespace-nowrap" wire:click="$toggle('showFilters')">@if($showFilters){{__('Hide filters...')}}@else{{__('Advanced search...')}}@endif</x-button.link>
                </div>

                <div class="flex justify-between space-x-2">
                    @if (count($countries) > 10)
                        <x-input.group borderless paddingless for="perPage">
                            <x-input.select wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                @if(count($countries) > 25)<option value="50">50</option>@endif
                                @if(count($countries) > 50)<option value="100">100</option>@endif
                                @if(count($countries) > 100)<option value="500">500</option>@endif
                            </x-input.select>
                        </x-input.group>
                    @endif

                    <x-dropdown.dropdown label="Bulk actions">
                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                            <x-icon.download class="text-cool-gray-400"/>
                            <span>{{__('Export')}}</span>
                        </x-dropdown.item>

                        <x-dropdown.item type="button" wire:click="$set('showDeleteModal', true)" class="flex items-center space-x-2">
                            <x-icon.trash class="text-cool-gray-400"/>
                            <span>{{__('Delete')}}</span>
                        </x-dropdown.item>
                    </x-dropdown.dropdown>
                </div>
            </div>

            <!-- Advanced Search -->
            <div>
                @if ($showFilters)
                    <div class="bg-gray-200 p-4 rounded shadow-inner relative grid sm:grid-cols-2  gap-4">

                            <x-input.group inline for="filter-name" label="Country">
                                <x-input.select wire:model="filters.code" id="filter-name" placeholder="Select Code...">
                                    @foreach($countries->sortBy('code') as $country)
                                        <option value="{{$country->code}}">{{$country->code}}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>

                            <div class="flex">
                                <x-button.link wire:click="resetFilters" class="ml-auto right-0 bottom-0 px-4">{{__('Reset Filters')}}</x-button.link>
                            </div>


                    </div>
                @endif
            </div>

            <!-- table -->
            @include('livewire.administration.country.table')
        </x-card.body>
    </x-card.card>

    @include('livewire.administration.country.modal')

    <!-- Confirm delete modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">

            <x-slot name="title">
                {{__('Elminar Países')}}
                <x-button.close wire:click="$set('showDeleteModal', false)" />
            </x-slot>

            <x-slot name="content">
                {{ __('¿Estás seguro de que quieres eliminar estos paises?') }} {{ __('Esta acción no se puede deshacer.') }}
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">{{__('Cancel')}}</x-button.secondary>
                <x-button.danger type="submit">{{__('Eliminar')}}</x-button.danger>
            </x-slot>

        </x-modal.confirmation>
    </form>

    @else

        <div class="space-y-4">
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <x-breadcumb.simple>
                        <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                        <x-breadcumb.item wire:click="resetToBlankCountry()">{{__('Countries')}}</x-breadcumb.item>
                        <x-breadcumb.item>{{__($country->name)}}</x-breadcumb.item>

                    </x-breadcumb.simple>
                </x-card.header>
            </x-card.card>

            <div class="flex grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                <section class="space-y-4">
                    <x-card.card class="divide-gray-200 divide-y">
                        <x-card.header>
                            {{__('Datos')}}
                        </x-card.header>
                        <x-card.body class="space-y-4">
                            @include('livewire.administration.country.form-inputs')
                        </x-card.body>
                        <x-card.footer class="flex justify-end">
                            <x-button.primary wire:click="save">{{__('Update')}}</x-button.primary>
                        </x-card.footer>
                    </x-card.card>






                </section>
                <section class="xl:col-span-2 space-y-4" >


                </section>
            </div>

            <x-card.card>
                <x-card.header>
                    {{__('Tipología de edificios')}}
                </x-card.header>
                <livewire:administration.risks :country="$country" :key="'risks'.$country->id"/>

            </x-card.card>


        </div>


    @endunless

</div>
