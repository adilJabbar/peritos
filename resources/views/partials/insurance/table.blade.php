<div class="flex-column space-y-4">
    <x-table.table>
        <x-slot name="head">
            <x-table.heading class="pr-0 w-8">
                <x-input.checkbox wire:model="selectPage" />
            </x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="w-full">{{__('Name')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('legal_id')" :direction="$sorts['legal_id'] ?? null" >{{__('CIF')}}</x-table.heading>
            <x-table.heading sortable multi-column wire:click="sortBy('country_id')" :direction="$sorts['country_id'] ?? null" >{{__('Country')}}</x-table.heading>
            <x-table.heading>
                @if ($sorts)
                    <x-button.link wire:click="$set('sorts', [])"><x-icon.x size="3" /></x-button.link>
                @endif
            </x-table.heading>
        </x-slot>


        <x-slot name="body">
            @if($selected)
                @include('components.table.rows_selected_row', ['total' => $companies->total()])
            @endif
            @forelse ($companies as $company)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $company->id }}">
                    <x-table.cell class="pr-0">
                        <x-input.checkbox wire:model="selected" value="{{ $company->id }}" />
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 flex items-center">
                                <img class="max-h-10 max-w-10 " src="{{ $company->logo_url }}" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$company->name}}
                                </div>
                            </div>
                        </div>
                    </x-table.cell>

                    <x-table.cell class="whitespace-nowrap">
                        <span class="text-gray-900 font-medium">{{ $company->legal_id }} </span>
                    </x-table.cell>

                    <x-table.cell>
{{--                        @dd($company->country)--}}
                        <span class="text-gray-900 font-medium">{{ $company->country?->name }} </span>
                    </x-table.cell>


                    <x-table.cell class="whitespace-nowrap">
                        <x-button.primary wire:click="view({{$company->id}})" size="sm">
                            <x-icon.pencil size="5" />
                        </x-button.primary>
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
    {{ $companies->links() }}
</div>
