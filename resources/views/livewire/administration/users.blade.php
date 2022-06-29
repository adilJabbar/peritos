<div>
    <x-card.card-with-header>
        <x-slot name="header">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{__('Usuarios')}}
                </h3>
            </div>
            <div class="flex-shrink-0">

                <x-button.primary wire:click="createNewUser"><x-icon.plus size="4" /></x-button.primary>
            </div>
        </x-slot>
        <div class=" space-y-4" >

            <!-- header -->
            <div class="flex justify-between">
                <div class="w-2/4 flex space-x-4">
                    <x-input.text wire:model="filters.search" id="search" placeholder="{{__('Search by name...')}}" />
                    <x-button.link wire:click="$toggle('showFilters')" class="whitespace-nowrap">@if($showFilters){{__('Hide filters...')}}@else{{__('Advanced search...')}}@endif</x-button.link>
                </div>

                <div class="flex justify-between space-x-2">
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

                    @can('user:create')
{{--                        <livewire:gabinete.import-gabinetes />--}}

                    @endcan
                </div>

            </div>

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
                            <x-input.group inline for="filter-gabinete" label="Gabinete">
                                <x-input.select wire:model="filters.gabinete" id="filter-gabinete"  placeholder="Selecciona Gabinete...">
                                    @foreach($gabinetes->sortBy('name') as $gabinete)
                                        <option value="{{$gabinete->id}}">{{$gabinete->name}}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                        </div>

                        <div class="space-y-2">
                            <x-input.group inline for="filter-language" label="Language">
                                <x-input.select wire:model="filters.language" id="filter-language" placeholder="Select Language...">
                                    @foreach(config('app.languages') as $key => $value)
                                        <option value="{{ $key }}">{{__($value)}}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>

                            <div class="flex">
                                <x-button.link wire:click="resetFilters" class="ml-auto right-0 bottom-0 px-4">{{__('Reset Filters')}}</x-button.link>
                            </div>
                        </div>



                    </div>
                @endif
            </div>

            <!-- table -->
            <div class="flex-column space-y-4">
                <x-table.table>
                    <x-slot name="head">
                        <x-table.heading class="pr-0 w-8">
                            <x-input.checkbox wire:model="selectPage" />
                        </x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="w-full">{{__('Name')}}</x-table.heading>
                        {{--            <x-table.heading sortable multi-column wire:click="sortBy('current_team_id')" :direction="$sorts['current_team_id'] ?? null" >{{__('Team')}}</x-table.heading>--}}
                        <x-table.heading style="min-width:200px;" centered>{{__('Gabinetes')}}</x-table.heading>
                        <x-table.heading centered>{{__('Security')}}</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('is_active')" :direction="$sorts['is_active'] ?? null">{{__('Active')}}</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('created_at')" :direction="$sorts['created_at'] ?? null">{{__('Created')}}</x-table.heading>
                        <x-table.heading>
                            @if ($sorts)
                                <x-button.link wire:click="$set('sorts', [])"><x-icon.x size="3" /></x-button.link>
                            @endif
                        </x-table.heading>
                    </x-slot>


                    <x-slot name="body">
                        @if($selected)
                            <x-table.row wire:key="row-select-all-messages" class="bg-gray-200">
                                <x-table.cell colspan="8">
                                    @if($selectPage)
                                        @unless($selectAll)
                                            <div>
                                                {!! __('user_trans.Has seleccionado usuarios', [
                                                 'number' => count($selected),
                                                 'user' => trans_choice('user_trans.user|users', count($selected))
                                                 ]) !!}.
                                                @if($users->total() > count($selected))
                                                    {!! __('user_trans.¿Quieres seleccionar todos?', ['total' =>$users->total()]) !!}
                                                    <x-button.link wire:click="selectAll" class="ml-2 text-indigo-500">Seleccionar todos</x-button.link>
                                                @endif
                                            </div>
                                        @else
                                            <div>
                                                {!! trans_choice(
                                                    'user_trans.Has seleccionado todos los usuarios',
                                                    $users->total(),
                                                    ['number' => $users->total()]
                                                ) !!}
                                            </div>
                                        @endunless
                                    @else
                                        <div>
                                            {!! __('user_trans.Has seleccionado usuarios', [
                                                'number' => count($selected),
                                                'user' => trans_choice('user_trans.user|users', count($selected))
                                                ]) !!}
                                        </div>
                                    @endif
                                </x-table.cell>
                            </x-table.row>
                        @endif
                        @forelse ($users as $userRow)
                            <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $userRow->id }}">
                                <x-table.cell class="pr-0">
                                    <x-input.checkbox wire:model="selected" value="{{ $userRow->id }}" />
                                </x-table.cell>
                                <x-table.cell>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ $userRow->profile_photo_url }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$userRow->full_name}}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{$userRow->email}}
                                            </div>
                                        </div>
                                    </div>
                                </x-table.cell>

                                <x-table.cell class="text-center">
                            <span class="text-gray-900 font-medium space-y-2">
                            @forelse($userRow->gabinetes->pluck('name') as $gabineteAttached)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 capitalize">
                                    {{ __($gabineteAttached) }}
                                    </span>
                                @empty
                                    {{ __('Ninguno') }}
                                @endforelse
                        </span>
                                </x-table.cell>

                                <x-table.cell class="text-center">
                            <span class="text-gray-900 font-medium space-y-2 whitespace-nowrap">
                            @forelse($userRow->roles as $role)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $role->background_color }} {{ $role->text_color }} capitalize">
                                    {{ __($role->name) }}
                                    </span>
                                @empty
                                    {{ __('Sin rol definido') }}
                                @endforelse
                        </span>
                                </x-table.cell>

                                <x-table.cell>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $userRow->status_color }}-100 text-{{ $userRow->status_color }}-800 capitalize">
                          {{ $userRow->status_text }}
                        </span>
                                </x-table.cell>

                                <x-table.cell class="whitespace-nowrap">
                                    {{$userRow->created_for_humans}}
                                </x-table.cell>

                                <x-table.cell>
                                    @can('user.update')
                                        <x-button.primary wire:click="edit({{$userRow->id}})" size="sm">
                                            <x-icon.pencil size="5" />
                                        </x-button.primary>
                                    @else
                                        <x-button.secondary wire:click="edit({{$userRow->id}})" size="sm">
                                            <x-icon.eye size="5"/>
                                        </x-button.secondary>
                                    @endcan
                                </x-table.cell>

                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="8">
                                    <div class="flex justify-center items-center space-x-2">
                                        <x-icon.inbox class="h-6 w-6 text-cool-gray-300"/>
                                        <span class="text-cool-gray-500 text-medium">{{__('No hay ningún usuario que cumpla con ese criterio.')}}</span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table.table>
                {{ $users->links() }}
            </div>


        </div>

    </x-card.card-with-header>


    @include('partials.user.new_user_modal')

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
