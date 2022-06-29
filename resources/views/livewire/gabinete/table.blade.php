<div class="flex-column space-y-4">

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
                @include('components.table.rows_selected_row', ['total' => $gabinetes->total()])
            @endif
            @forelse ($gabinetes as $gabinete)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $gabinete->id }}">
                    <x-table.cell class="pr-0">
                        <x-input.checkbox wire:model="selected" value="{{ $gabinete->id }}" />
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 flex items-center">
                                <img class="max-h-10 max-w-10 " src="{{ $gabinete->logo_url }}" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$gabinete->name}}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{$gabinete->cif}}
                                </div>
                            </div>
                        </div>
                    </x-table.cell>

                    <x-table.cell class="whitespace-nowrap">
                        <span class="text-gray-900 font-medium">{{ $gabinete->city  }} </span>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="text-gray-900 font-medium">{{ $gabinete->state  }} </span>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="text-gray-900 font-medium">{{ $gabinete->country->name ?? dd($gabinete)}} </span>
                    </x-table.cell>

                    <x-table.cell class="text-right">
                        <span class="text-gray-900 font-medium">{{ $gabinete->active_users->count()  }} </span>
                    </x-table.cell>


                    <x-table.cell class="whitespace-nowrap">
                        @can('gabinete.update')
                            <x-button.primary wire:click="edit({{$gabinete->id}})" size="sm">
                                <x-icon.pencil size="5" />
                            </x-button.primary>
                        @endcan
                        @can('gabinete.view')
                            <x-button.secondary wire:click="view({{$gabinete->id}})" size="sm">
                                <x-icon.eye size="5" />
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
    {{ $gabinetes->links() }}
</div>
