<x-card.card class="divide-y divide-gray-200">
    <x-card.header>
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                <strong>{{$gabinete->name}}</strong> · {{__('Empleados')}}
            </h3>
        </div>
        @can('user.create')
            <div class="flex-shrink-0">
                <x-button.primary wire:click="createNewUser"><x-icon.plus size="4" /></x-button.primary>
            </div>
        @endcan
    </x-card.header>

    <div>
        <x-card.body class=" space-y-4" >

            <!-- header -->
            <div class="flex justify-between space-x-4">
                <div class=" flex-grow flex items-center space-x-4">
                    <div class="flex-grow">
                        <x-input.text wire:model="filters.search" id="search" placeholder="{{__('Search by name...')}}" />
                    </div>
                    <div>
                        <x-button.link class="flex-grow" wire:click="$toggle('showFilters')">@if($showFilters){{__('Hide filters...')}}@else{{__('Advanced search...')}}@endif</x-button.link>
                    </div>
                </div>

                <div class="flex-shrink-0 flex justify-between space-x-2">
                    @if (count($users) > 10)
                        <x-input.group borderless paddingless for="perPage">
                            <x-input.select wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                @if(count($users) > 25)<option value="50">50</option>@endif
                                @if(count($users) > 50)<option value="100">100</option>@endif
                                @if(count($users) > 100)<option value="500">500</option>@endif
                            </x-input.select>
                        </x-input.group>
                    @endif

                    <x-dropdown.dropdown label="Bulk actions">
                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                            <x-icon.download class="text-cool-gray-400"/>
                            <span>{{__('Export')}}</span>
                        </x-dropdown.item>

                        @can('user:delete')
                            <x-dropdown.item type="button" wire:click="$set('showDeleteModal', true)" class="flex items-center space-x-2">
                                <x-icon.trash class="text-cool-gray-400"/>
                                <span>{{__('Delete')}}</span>
                            </x-dropdown.item>
                        @endcan
                    </x-dropdown.dropdown>
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

                    <div class="space-y-2">
                        <x-input.group inline for="filter-email" label="Email Address">
                            <x-input.text wire:model="filters.email" id="filter-email" />
                        </x-input.group>
                    </div>

                    <div class="space-y-2">
                        <x-input.group inline for="filter-language" label="Language">
                            <x-input.select wire:model="filters.language" id="filter-language" placeholder="Select Language...">
                                <option value="es">{{__('Spanish')}}</option>
                                <option value="en">{{__('English')}}</option>
                            </x-input.select>
                        </x-input.group>
                    </div>

                </div>
            @endif
        </div>
    </div>

    <!-- table -->
    @include('partials.gabinete.user_table')

    @include('partials.user.new_user_modal', ['showGabineteSelector' => false])

</x-card.card>
