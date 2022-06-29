<div class="flex-column space-y-4">
    <x-table.table>
        <x-slot name="head">
            <x-table.heading class="pr-0 w-8">
                <x-input.checkbox wire:model="selectPage" />
            </x-table.heading>
            <x-table.heading>{{__('Destino')}}</x-table.heading>
            <x-table.heading>{{__('Unid.')}}</x-table.heading>
            <x-table.heading class="w-full">{{__('Descripción')}}</x-table.heading>
            <x-table.heading>{{__('P/U')}}</x-table.heading>
            <x-table.heading>{{__('Impuestos')}}</x-table.heading>
            <x-table.heading>{{__('Total')}}</x-table.heading>
            <x-table.heading>{{__('V.Real')}}</x-table.heading>
{{--            <x-table.heading>{{__('V.Asegurado')}}</x-table.heading>--}}
            <x-table.heading>{{__('V.Propuesto')}}</x-table.heading>
            <x-table.heading></x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if($selected)
                @include('components.table.rows_selected_row', ['total' => $assessments->total(), 'colspan' => 12])
            @endif

            @forelse($subguaranteesUsed as $subguaranteeGroup)
                    <tr class="bg-gray-50">
                        <x-table.cell colspan="9" class="px-4 py-2" no-padding>
{{--                            <div class="flex justify-between items-center">--}}
                                <span class="font-medium">{{$subguaranteeGroup->guarantee->name}}: {{$subguaranteeGroup->name}}</span>
{{--                                <x-button.secondary wire:click="addOneForSubguarantee({{$subguaranteeGroup->id}}, {{$expedient->person_id}})" size="xs">--}}
{{--                                    <x-icon.plus solid size="4" />--}}
{{--                                </x-button.secondary>--}}

{{--                            </div>--}}
                        </x-table.cell>
                        <x-table.cell class="px-4 py-2" no-padding>
                            <x-button.secondary wire:click="addOneForSubguarantee({{$subguaranteeGroup->id}}, {{$person->id}})" size="xs">
                                <x-icon.plus solid size="4" />
                            </x-button.secondary>
                        </x-table.cell>
                    </tr>

                @forelse ($assessments->where('subguarantee_id', $subguaranteeGroup->id) as $assessment)
                    <x-table.row wire:loading.class.delay="opacity-50" class="cursor-pointer hover:bg-gray-100 text-sm" wire:key="assessment-row-{{ $assessment->id }}">

                        <x-table.cell class="py-2 pl-6 pr-0" no-padding>
                            <x-input.checkbox wire:model="selected" value="{{ $assessment->id }}" />
                        </x-table.cell>
                        <x-table.cell class="px-2 text-center" wire:click="edit({{$assessment->id}})" no-padding>
                            {{ $assessment->destiny->code }}
                        </x-table.cell>

                        <x-table.cell class="text-center px-2" wire:click="edit({{$assessment->id}})" no-padding>
                            {{ floatval($assessment->unit) }}
                        </x-table.cell>

                        <x-table.cell class="px-2" wire:click="edit({{$assessment->id}})" no-padding>
                            {{ $assessment->description }}
                        </x-table.cell>

                        <x-table.cell class="text-right px-2" wire:click="edit({{$assessment->id}})" no-padding>
                            {{ $assessment->unit_price }}
                        </x-table.cell>

                        <x-table.cell class="text-center px-2 text-gray-400" wire:click="edit({{$assessment->id}})" no-padding>
                            {{ $assessment->taxes }} %
                        </x-table.cell>

                        <x-table.cell class="text-right px-2" wire:click="edit({{$assessment->id}})" no-padding>
                            <x-output.currency-no-symbol value="{{ $assessment->total }}" :currency="$assessment->currency"/>
                        </x-table.cell>

                        <x-table.cell class="text-right px-2" wire:click="edit({{$assessment->id}})" no-padding>
                            <x-output.currency-no-symbol value="{{ $assessment->total_real }}" :currency="$assessment->currency"/>
                        </x-table.cell>

{{--                        <x-table.cell class="text-right px-2" wire:click="edit({{$assessment->id}})" no-padding>--}}
{{--                            <x-output.currency-no-symbol value="{{ $assessment->total_covered }}" :currency="$assessment->currency"/>--}}
{{--                        </x-table.cell>--}}

                        <x-table.cell class="text-right px-2" wire:click="edit({{$assessment->id}})" no-padding>
                            <x-output.currency value="{{ $assessment->total_proposed }}" :currency="$assessment->currency"/>
                        </x-table.cell>

                        <x-table.cell class="text-right px-2" no-padding>
                            <x-button.secondary wire:click="duplicate({{ $assessment->id }})" size="xs"><x-icon.document-duplicate size="4" /></x-button.secondary>
                        </x-table.cell>
                    </x-table.row>
                @empty

                @endforelse



            @empty
                <x-table.row>
                <x-table.cell colspan="9">
                    <div class="flex justify-center items-center space-x-2">
                        <x-icon.inbox class="h-6 w-6 text-cool-gray-300"/>
                        <span class="text-cool-gray-500 text-medium">{{__('No hay ninguna partida de daños propios que cumpla con ese criterio.')}}</span>
                    </div>
                </x-table.cell>
                </x-table.row>
            @endforelse
            @if($assessments->where('subguarantee_id', $subguaranteeGroup->id ?? null))
                <x-table.row wire:loading.class.delay="opacity-50" class="bg-gray-100 text-md" wire:key="assessment-totals">
                    <x-table.cell colspan="5" class="px-4 py-2 text-right" no-padding>
                        <span class="font-medium">{{__('Totales')}}:</span>
                    </x-table.cell>
                    <x-table.cell class="text-right px-2" no-padding>
                        <x-output.currency-no-symbol value="{{ $expedient->totalByPerson($person->id) }}" :currency="$assessment->currency"/>
                    </x-table.cell>
                    <x-table.cell class="text-right px-2" no-padding>
                        <x-output.currency-no-symbol value="{{ $expedient->totalRealByPerson($person->id) }}" :currency="$assessment->currency"/>
                    </x-table.cell>
                    <x-table.cell class="text-right px-2" no-padding>
{{--                        <x-output.currency-no-symbol value="{{ $expedient->totalAssessmentsByPerson($expedient->person_id) }}" :currency="$assessment->currency"/>--}}
                    </x-table.cell>
                    <x-table.cell class="text-right px-2" no-padding>
                        <x-output.currency value="{{ $expedient->totalProposedByPerson($person->id) }}" :currency="$assessment->currency"/>
                    </x-table.cell>
                    <x-table.cell class="text-right px-2" no-padding>

                    </x-table.cell>
                </x-table.row>
            @endif
        </x-slot>
    </x-table.table>
    {{--    {{ $assessments->links() }}--}}
</div>
