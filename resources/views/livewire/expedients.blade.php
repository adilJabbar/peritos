<x-layout.two-columns>
    <x-slot name="title">
        {{__('Expedients')}}
    </x-slot>

    <!-- mobile menu -->
    <x-slot name="primary">
    </x-slot>

    <x-slot name="secondary">
        <div>
            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$gabinete->id . 'nav-area'">

                    <h3 class="p-3 text-xs font-semibold text-white uppercase tracking-wider bg-gray-400" id="projects-headline">
                        {{ __('Expedientes')  }}
                    </h3>

                    <x-administration.menu-item label="Asignados" icon="user" name="Assigned expedients" is-active="{{ $showSubmenu == 'Assigned expedients' }}" badge="{{$assignedExpedients->count()}}" />
                    <x-administration.menu-item label="Colaborador" icon="users" name="Collaborator expedients" is-active="{{ $showSubmenu == 'Collaborator expedients' }}" badge="{{$collaboratorExpedients->count()}}" />
                    <x-administration.menu-item label="Gabinete" icon="office-building" name="Gabinetes expedients" is-active="{{ $showSubmenu == 'Gabinetes expedients' }}" badge="{{$gabinetesExpedients->count()}}" />

                </div>
            </nav>
        </div>

    </x-slot>

    <div class="p-4 space-y-4 w-full">
        <x-card.card class="divide-y divide-gray-200">
            <x-card.header>
                <x-breadcumb.simple>
                    <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                    <x-breadcumb.item>{{ auth()->user()->full_name }}</x-breadcumb.item>
                    <x-breadcumb.item>{{ __($showSubmenu) }}</x-breadcumb.item>
{{--                    <x-breadcumb.item>{{ __('Compañías') }}</x-breadcumb.item>--}}
                </x-breadcumb.simple>
            </x-card.header>
        </x-card.card>

        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    <strong>{{__('Expedientes Activos')}}</strong>
                </h3>

                @can('expedient.create')
                    <div class="flex space-x-2">

                        <div class="flex-shrink-0">
                            <a href="{{route('expedient.new_expedient')}}">
                                <x-button.primary>
                                    <div class="flex justify-between space-x-2">
                                        <x-icon.plus size="5" />
                                    </div>
                                </x-button.primary>
                            </a>

                        </div>
                    </div>
                @endcan
            </x-card.header>

            <div class="flex justify-between p-4">
                <div class="w-2/4 flex space-x-4">
                    <x-input.text wire:model="filters.search" id="search" placeholder="{{__('Search by name...')}}" />
                    <x-button.link class="whitespace-nowrap" wire:click="$toggle('showFilters')">@if($showFilters){{__('Hide filters...')}}@else{{__('Advanced search...')}}@endif</x-button.link>
                </div>

                <div class="flex justify-between space-x-2">
                    @if ($expedients->total() > 10)
                        <x-input.group borderless paddingless for="perPage">
                            <x-input.select wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                @if($expedients->total() > 25)<option value="50">50</option>@endif
                                @if($expedients->total() > 50)<option value="100">100</option>@endif
                                @if($expedients->total() > 100)<option value="500">500</option>@endif
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

                </div>
            </div>

            <!-- show filters -->
            <div>
                @if ($showFilters)
                    <div class="p-2">
                        <div class="bg-gray-200 p-4 rounded shadow-inner relative">
                            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-2">

                                <x-input.group inline for="filter-legal_name" label="Legal Name">
                                    <x-input.text wire:model="filters.legal_name" id="filter-legal_name" />
                                </x-input.group>

                                <x-input.group inline for="filter-legal_id" label="CIF">
                                    <x-input.text wire:model="filters.legal_id" id="filter-legal_id" />
                                </x-input.group>

                                <x-input.group inline for="filter-phone" label="Phone">
                                    <x-input.text wire:model="filters.phone" id="filter-phone" />
                                </x-input.group>

                                <x-input.group inline for="filter-email" label="Email">
                                    <x-input.text wire:model="filters.email" id="filter-email" />
                                </x-input.group>

                                <x-input.group inline for="filter-address" label="Address">
                                    <x-input.text wire:model="filters.address" id="filter-address" />
                                </x-input.group>

                                <x-input.group inline for="filter-city" label="City">
                                    <x-input.text wire:model="filters.city" id="filter-city" />
                                </x-input.group>

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
                            </div>
                            <div class="flex justify-end">
                                <x-button.link wire:click="resetFilters" class="ml-auto right-0 bottom-0 px-4">{{__('Reset Filters')}}</x-button.link>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @include('livewire.expedient.table', ['showGabinete' => ($showSubmenu === 'Gabinetes expedients')])
        </x-card.card>
{{--        @if($showSubmenu == 'AssignedExpedients')--}}
{{--            <livewire:expedients.assigned :expedients="$assignedExpedients" />--}}
{{--        @elseif($showSubmenu == 'CollaboratorExpedients')--}}
{{--            <livewire:expedients.assigned />--}}
{{--        @elseif($showSubmenu == 'GabinetesExpedients')--}}
{{--            <livewire:expedients.gabinete :expedients="$gabineteExpedients" />--}}
{{--        @endif--}}
    </div>
</x-layout.two-columns>
