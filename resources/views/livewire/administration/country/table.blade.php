<div class="flex-column space-y-4">
    <x-table.table>
        <x-slot name="head">
            <x-table.heading class="pr-0 w-8">
                <x-input.checkbox wire:model="selectPage" />
            </x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="w-full">{{__('Name')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('code')" :direction="$sorts['code'] ?? null" >{{__('Código')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('taxes')" :direction="$sorts['taxes'] ?? null" >{{__('Impuestos')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('currency')" :direction="$sorts['currency'] ?? null" >{{__('Currency')}}</x-table.heading>
            <x-table.heading>
                @if ($sorts)
                    <x-button.link wire:click="$set('sorts', [])"><x-icon.x size="3" /></x-button.link>
                @endif
            </x-table.heading>
        </x-slot>


        <x-slot name="body">
            @if($selected)
                @include('components.table.rows_selected_row', ['total' => $countries->total()])
            @endif
            @forelse ($countries as $country)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $country->id }}">
                    <x-table.cell class="pr-0">
                        <x-input.checkbox wire:model="selected" value="{{ $country->id }}" />
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 flex items-center">
                                <img class="max-h-10 max-w-10 " src="{{ $country->flag_url }}" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ __($country->name) }}
                                </div>
                            </div>
                        </div>
                    </x-table.cell>

                    <x-table.cell class="whitespace-nowrap">
                        <span class="text-gray-900 font-medium">{{ $country->code }} </span>
                    </x-table.cell>

                    <x-table.cell>
                        <span class="text-gray-900 font-medium">{{ $country->taxes }} </span>
                    </x-table.cell>

                    <x-table.cell>
                        <span class="text-gray-900 font-medium">{{ $country->currency->currency . ' ' . $country->currency->name }} </span>
                    </x-table.cell>


                    <x-table.cell class="whitespace-nowrap">
                        <a href="{{ route('administration.country.show', $country->id) }}">
                            <x-button.primary size="xs">
                                <x-icon.pencil size="5" />
                            </x-button.primary>
                        </a>
{{--                        <x-button.primary wire:click="edit({{$country->id}})" size="xs">--}}
{{--                            <x-icon.pencil size="5" />--}}
{{--                        </x-button.primary>--}}
                    </x-table.cell>

                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="8">
                        <div class="flex justify-center items-center space-x-2">
                            <x-icon.inbox class="h-6 w-6 text-cool-gray-300"/>
                            <span class="text-cool-gray-500 text-medium">{{__('No hay ningún país que cumpla con ese criterio.')}}</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>
    {{ $countries->links() }}
</div>
