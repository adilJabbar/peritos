<div class="flex-column space-y-4">
    <x-table.table>
        <x-slot name="head">
            <x-table.heading class="pr-0 w-8">
                <x-input.checkbox wire:model="selectPage" />
            </x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('code')" :direction="$sorts['code'] ?? null" >{{__('Code')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('billable')" :direction="$sorts['billable'] ?? null" ></x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" >{{__('Name')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('address')" :direction="$sorts['address'] ?? null">{{__('Dirección')}}</x-table.heading>
            <x-table.heading class="hidden 2xl:table-cell" sortable multi-column wire:click="sortBy('created_at')" :direction="$sorts['created_at'] ?? null" >{{__('Creado')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('adjuster_id')" :direction="$sorts['adjuster_id'] ?? null" >{{__('Asignado')}}</x-table.heading>
            <x-table.heading >{{__('Prioridad')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('expires_at')" :direction="$sorts['expires_at'] ?? null" >{{__('Límite')}}</x-table.heading>
            <x-table.heading centered>{{__('Estado')}}</x-table.heading>
        </x-slot>


        <x-slot name="body">
            @if($selected)
                @include('components.table.rows_selected_row', ['total' => $expedients->total()])
            @endif
            @forelse ($expedients as $expedient)
                <x-table.row wire:loading.class.delay="opacity-50" class="cursor-pointer hover:bg-gray-100" wire:click="open({{$expedient->id}})" wire:key="expedient-row-{{ $expedient->id }}">

                    <x-table.cell class="pr-0 pl-4" noPadding>
                        <x-input.checkbox wire:model="selected" value="{{ $expedient->id }}" />
                    </x-table.cell>
                    <x-table.cell class="p-2" noPadding>
                        <div class="text-xs text-gray-500">
                            {{ $expedient->full_code }}
                        </div>
                    </x-table.cell>

                    <x-table.cell class="p-2" noPadding>
                        {{--                        <div class="flex items-center">--}}
                        <div class="flex-shrink-0 h-10 w-10 flex items-center">
                            <img class="max-h-10 max-w-10 " src="{{ $expedient->icon_url }}" alt="">
                        </div>
                        {{--                        </div>--}}
                    </x-table.cell>
                    <x-table.cell class="p-2" noPadding>
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{$expedient->person?->name}}
                                </div>
                                @if($expedient->person?->contacts)
                                <div class="text-sm text-gray-500">
                                    {{ $expedient->person->contacts->take(3)->pluck('value')->implode(', ') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </x-table.cell>
                    <x-table.cell class="p-2" noPadding>
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $expedient->address?->address}}
                                </div>
                                @if($expedient->address)
                                    <div class="text-sm text-gray-500 whitespace-nowrap">
                                        {{ implode(', ' , $expedient->address->only('zip', 'city', 'state')) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </x-table.cell>

                    <x-table.cell class="hidden 2xl:table-cell p-2" noPadding>
                    <span class="inline-flex items-center text-center px-3 py-0.5 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                      {{ $expedient->requested_at_for_humans  }}
                    </span>
                    </x-table.cell>

                    <x-table.cell class="p-2" noPadding>
                        <div class="flex flex-col">
                            @if($expedient->adjuster)
                                <span class="text-center px-3 py-0.5 text-xs text-gray-500">
                                    {{ $expedient->gabineteOrSubcontractorName() }}
                                </span>
                            @endif
                            <span class="text-center px-3 py-0.5 text-sm font-medium">{{ $expedient->adjuster?->full_name }}</span>
                            @forelse($expedient->collaborators as $collaborator)
                                <span class="text-xs text-gray-500 text-center">({{ $collaborator->full_name}})</span>
                            @empty
                            @endforelse
                        </div>
                    </x-table.cell>

                    <x-table.cell class="p-2" noPadding>
                    <span class="inline-flex items-center text-center px-3 py-0.5 rounded-md text-sm font-medium bg-{{$expedient->priority_color}}-100 text-{{$expedient->priority_color}}-800">
                      {{ $expedient->priority  }}
                    </span>
                    </x-table.cell>

                    <x-table.cell class="p-2" noPadding>
                    <span class="inline-flex items-center text-center px-3 py-0.5 rounded-md text-sm font-medium bg-{{$expedient->limit_color}}-100 text-{{$expedient->limit_color}}-800">
                      {{ $expedient->expires_at->diffForHumans()}}
                    </span>
                    </x-table.cell>
                    <x-table.cell class="p-2" noPadding>
                    <span class="inline-flex items-center text-center px-3 py-0.5 rounded-md text-sm font-medium bg-{{$expedient->limit_color}}-100 text-{{$expedient->limit_color}}-800">
                      {{ __($expedient->status->name) }}
                    </span>
                    </x-table.cell>

                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="8">
                        <div class="flex justify-center items-center space-x-2">
                            <x-icon.inbox class="h-6 w-6 text-cool-gray-300"/>
                            <span class="text-cool-gray-500 text-medium">{{__('No hay ningún expediente que cumpla con ese criterio.')}}</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>
    <div>
        @if($expedients->hasPages())
            <div class="px-4 pb-4">
                {{ $expedients->links() }}
            </div>
        @endif
    </div>
</div>
