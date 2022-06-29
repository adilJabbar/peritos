<div class="flex-column space-y-4">
    <x-table.table>
        <x-slot name="head">
            <x-table.heading class="pr-0 w-8">
                <x-input.checkbox wire:model="selectPage" />
            </x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="w-full">{{__('Name')}}</x-table.heading>
            {{--            <x-table.heading sortable multi-column wire:click="sortBy('current_team_id')" :direction="$sorts['current_team_id'] ?? null" >{{__('Team')}}</x-table.heading>--}}
            <x-table.heading centered>{{__('Security')}}</x-table.heading>
            <x-table.heading centered>{{__('Supervisor')}}</x-table.heading>
            <x-table.heading centered>{{__('Backoffice')}}</x-table.heading>
            <x-table.heading centered class="w-0">{{__('Advances')}}</x-table.heading>
            <x-table.heading centered class="w-0">{{__('Reports')}}</x-table.heading>
            <x-table.heading centered class="w-0">{{__('Incidences')}}</x-table.heading>
            <x-table.heading centered class="w-0">{{__('Company')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('is_active')" :direction="$sorts['is_active'] ?? null">{{__('Active')}}</x-table.heading>
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
            @forelse ($users->sortBy('name') as $userRow)
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
                            <span class="text-gray-900 font-medium space-y-1">
                            @forelse($userRow->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-500 text-white capitalize whitespace-nowrap">
                                {{ __($role->name) }}
                                </span>
                            @empty
                                {{ __('Sin rol definido') }}
                            @endforelse
                        </span>
                    </x-table.cell>

                    <x-table.cell>
                        <span class="inline-flex items-center text-xs font-medium capitalize">
                                 {{ $userRow->supervisor($gabinete)->full_name ?? '' }}
                        </span>
                    </x-table.cell>

                    <x-table.cell>
                        <span class="inline-flex items-center text-xs font-medium capitalize">
                                 {{ $userRow->backoffice($gabinete)->full_name ?? '' }}
                        </span>
                    </x-table.cell>

                    <x-table.cell noPadding>
                        <div class="flex justify-center">
                            @if($userRow->supervisedAdvances($gabinete))
                                <x-icon.eye size="5" class="text-red-500" />
                            @else
                                <x-icon.eye-off size="5" class="text-green-500" />
                            @endif
                        </div>
                    </x-table.cell>

                    <x-table.cell noPadding>
                        <div class="flex justify-center">
                            @if($userRow->supervisedReports($gabinete))
                                <x-icon.eye size="5" class="text-red-500" />
                            @else
                                <x-icon.eye-off size="5" class="text-green-500" />
                            @endif
                        </div>
                    </x-table.cell>

                    <x-table.cell noPadding>
                        <div class="flex justify-center">
                            @if($userRow->supervisedIncidences($gabinete))
                                <x-icon.eye size="5" class="text-red-500" />
                            @else
                                <x-icon.eye-off size="5" class="text-green-500" />
                            @endif
                        </div>
                    </x-table.cell>

                    <x-table.cell noPadding>
                        <div class="flex justify-center">
                            @if($userRow->contactToCompany($gabinete))
                                <x-icon.phone size="5" class="text-green-500" />
                            @else
                                <x-icon.phone size="5" class="text-red-500" />
                            @endif
                        </div>
                    </x-table.cell>

                    <x-table.cell>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $userRow->status_color }}-100 text-{{ $userRow->status_color }}-800 capitalize">
                          {{ $userRow->status_text }}
                        </span>
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
