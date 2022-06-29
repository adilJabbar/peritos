<div class="flex-column space-y-4">
    <x-table.table>
        <x-slot name="head">
            <x-table.heading>{{__('Tipo')}}</x-table.heading>
            <x-table.heading class="w-full">{{__('Name')}}</x-table.heading>
{{--            <x-table.heading>{{__('Phone')}}</x-table.heading>--}}
            <x-table.heading>{{__('Importe')}}</x-table.heading>
            <x-table.heading>

            </x-table.heading>
        </x-slot>


        <x-slot name="body">
            @forelse ($expedient->affecteds as $affected)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="affected-row-{{ $loop->index }}">
                    <x-table.cell class="pr-0">{{ $affected->pivot->type }}</x-table.cell>
                    <x-table.cell>
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{$affected->name}}
                                </div>
                                <div class="text-sm text-gray-500 whitespace-nowrap">
                                    {{ implode(', ' , \App\Models\Address::find($affected->pivot->address_id)->only('name', 'address', 'zip', 'city', 'state')) }}
                                </div>
                                <div class="text-sm text-gray-500 whitespace-nowrap">
                                    {{$affected->contacts->pluck('value')->implode(', ')}}
                                </div>
                            </div>
                        </div>
                    </x-table.cell>
{{--                    <x-table.cell>{{$affected->contacts->pluck('value')->implode(', ')}}</x-table.cell>--}}
                    <x-table.cell class="text-right whitespace-nowrap">
                        <x-output.currency value="{{$affected->pivot->amount}}" :currency="\App\Models\Admin\Currency::find($affected->pivot->currency_id)" />
                    </x-table.cell>

                    <x-table.cell class="whitespace-nowrap">
                        <x-button.primary wire:click="editAffected({{$affected->id}})" size="sm">
                            <x-icon.pencil size="4" />
                        </x-button.primary>

                        <x-button.danger wire:click="removeAffected({{$affected->id}})" size="sm"><x-icon.minus-sm size="4" /></x-button.danger>

                    </x-table.cell>

                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="8">
                        <div class="flex justify-center items-center space-x-2">
                            <x-icon.inbox class="h-6 w-6 text-cool-gray-300"/>
                            <span class="text-cool-gray-500 text-medium">{{__('No hay ningún causante o perjudicado asociado a este expediente.')}}</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>
{{--    {{ $gabinetes->links() }}--}}
</div>
