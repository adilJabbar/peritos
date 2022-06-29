<div>
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>{{__('Currencies')}}</div>
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
                    @if (count($currencies) > 10)
                        <x-input.group borderless paddingless for="perPage">
                            <x-input.select wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                @if(count($currencies) > 25)<option value="50">50</option>@endif
                                @if(count($currencies) > 50)<option value="100">100</option>@endif
                                @if(count($currencies) > 100)<option value="500">500</option>@endif
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

                        <x-input.group inline for="filter-position" label="Posición">
                            <x-input.select wire:model="filters.position" id="filter-position" placeholder="Select Position...">
                                <option value="before">{{__('Before')}}</option>
                                <option value="after">{{__('After')}}</option>
                            </x-input.select>
                        </x-input.group>

                        <div class="flex">
                            <x-button.link wire:click="resetFilters" class="ml-auto right-0 bottom-0 px-4">{{__('Reset Filters')}}</x-button.link>
                        </div>


                    </div>
                @endif
            </div>

            <!-- table -->
            @include('livewire.administration.currency.table')
        </x-card.body>
    </x-card.card>

    @include('livewire.administration.currency.modal')

<!-- Confirm delete modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">

            <x-slot name="title">
                {{__('Elminar Monedas')}}
                <x-button.close wire:click="$set('showDeleteModal', false)" />
            </x-slot>

            <x-slot name="content">
                <p>{{ __('¿Estás seguro de que quieres eliminar estas monedas?') }}</p>
                <p>{{ __('Esta acción no se puede deshacer.') }}</p>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">{{__('Cancel')}}</x-button.secondary>
                <x-button.danger type="submit">{{__('Eliminar')}}</x-button.danger>
            </x-slot>

        </x-modal.confirmation>
    </form>
</div>

