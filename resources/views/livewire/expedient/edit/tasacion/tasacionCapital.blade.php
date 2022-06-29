<div class="space-y-4">
@forelse($capitals->sortBy('position') as $capitalOption)
    @php
        $totalLiquidoCapital = 0;
        $totalCubiertoCapital = 0;
        $totalExcluidoCapital = 0;
    @endphp
    <x-card.card class="divide-y divide-gray-200 pb-0">
        <x-card.header>
            <div>{{$capitalOption->name}}</div>
            <div class="flex space-x-4 text-xs">
                <div>{{$capitalOption->pivot->primer_riesgo ? __('Primer Riesgo') : ''}}</div>
                <div class="flex flex-col"><span class="text-xs text-gray-500">{{__('Límite')}}</span> <x-output.currency value="{{$capitalOption->limitValue()}}" :currency="$expedient->currency()" /></div>
                @if($capitalOption->infraseguroPercent())
                <div class="flex flex-col"><span class="text-xs text-gray-500">{{__('Infraseguro')}}</span> <x-output.percent value="{{$capitalOption->infraseguroPercent()}}" :currency="$expedient->currency()" /></div>
                @endif
                <div class="flex flex-col"><span class="text-xs text-gray-500">{{__('Valorados')}}</span> <x-output.currency value="{{$capitalOption->assessments->sum('total_proposed') + $capitalOption->assessments->sum('total_excluded')}}" :currency="$expedient->currency()" /></div>
                <div class="flex flex-col"><span class="text-xs text-gray-500">{{__('Cubiertos')}}</span> <x-output.currency value="{{$capitalOption->assessments->sum('total_proposed')}}" :currency="$expedient->currency()" /></div>
                <div class="flex flex-col"><span class="text-xs text-gray-500">{{__('Excluidos')}}</span> <x-output.currency value="{{$capitalOption->assessments->sum('total_excluded')}}" :currency="$expedient->currency()" /></div>
            </div>
        </x-card.header>

        <div class="space-y-4">

            <x-table.table>
                <x-slot name="head">
                    <x-table.heading class="whitespace-nowrap">{{__('Garantía')}}</x-table.heading>
                    <x-table.heading class="whitespace-nowrap">{{__('Subgarantía')}}</x-table.heading>
                    <x-table.heading>{{__('Afectado')}}</x-table.heading>
                    <x-table.heading class="whitespace-nowrap">{{__('Daños cubiertos')}}</x-table.heading>
                    <x-table.heading class="whitespace-nowrap">{{__('Infraseguro')}}</x-table.heading>
                    <x-table.heading class="whitespace-nowrap">{{__('Franquicia')}}</x-table.heading>
                    <x-table.heading class="whitespace-nowrap">{{__('Daños líquidos')}}</x-table.heading>
                    <x-table.heading class="whitespace-nowrap">{{__('Daños excluidos')}}</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($capitalOption->subguarantees as $subguaranteeOption)
                        <?php
                        $subguaranteeAssessments = $capitalOption->assessments->where('subguarantee_id', $subguaranteeOption->id);
                        $limit = $subguaranteeOption->limit;
                        $limitAvailable = $limit;
                        $totalLiquidoSubgarantia = 0;
                        ?>

                        <?php
                            $franquiciaPending = $capitalOption->franquicia($subguaranteeOption, $subguaranteeAssessments->sum('total_liquid'));
                            $deductibleToDiscount = $franquiciaPending;
                            $subguaranteePeople = $people->whereIn('id', $subguaranteeAssessments->pluck('person_id')->unique());
                        ?>
                        <tr class="bg-white">
                            <x-table.cell rowspan="{{$subguaranteePeople->count()}}">
                                {{$subguaranteeOption->guarantee->name}}
                            </x-table.cell>
                            <x-table.cell rowspan="{{$subguaranteePeople->count()}}">
                                <span class="whitespace-nowrap">{{$subguaranteeOption->name}}</span>
                                @if($subguaranteeOption->primer_riesgo)<span class="whitespace-nowrap">{{__('Primer Riesgo')}}</span>  @endif
                                @if($subguaranteeOption->limit)
                                    <span class="whitespace-nowrap text-xs text-gray-500 flex justify-between">
                                        {{__('Límite')}}: <x-output.currency value="{{$subguaranteeOption->limit}}" :currency="$expedient->currency()" />
                                    </span>
                                @endif
                                @if($franquicia = $capitalOption->franquicia($subguaranteeOption, $subguaranteeAssessments->sum('total_liquid')))
                                    <span class="whitespace-nowrap text-xs text-gray-500 flex justify-between">
                                        {{__('Franquicia')}}: <x-output.currency value="{{$capitalOption->franquicia($subguaranteeOption, $subguaranteeAssessments->sum('total_liquid'))}}" :currency="$expedient->currency()" />
                                    </span>
                                @endif
                            </x-table.cell>
                            @foreach($subguaranteePeople as $personOption)
                                <x-table.cell class="w-full">{{$personOption->name}}</x-table.cell>

                                <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$covered = $subguaranteeAssessments->where('person_id', $personOption->id)->sum('total_proposed')}}" :currency="$expedient->currency()" /></x-table.cell>

                                <x-table.cell class="text-right">
                                    <x-output.currency-no-symbol value="{{$infraseguro = $subguaranteeAssessments->where('person_id', $personOption->id)->sum('total_infraseguro')}}" :currency="$expedient->currency()" /></x-table.cell>

{{--                                    @if($subguaranteeOption->id == 8)--}}
{{--                                        @json($subguaranteeAssessments->where('person_id', $personOption->id))--}}
{{--                                    @endif--}}

                                <?php
                                    $deductibleToDiscount = $covered + $infraseguro < $franquiciaPending ? $covered + $infraseguro : $franquiciaPending;
                                    $franquiciaPending -= $deductibleToDiscount;
                                    $liquidDamages = $covered + $infraseguro - $deductibleToDiscount;
                                    $limitForSubguarantee = ($limitAvailable && $liquidDamages > $limitAvailable)
                                        ?  $limitAvailable
                                        : $liquidDamages;
                                    $limitAvailable && $limitAvailable -= $limitForSubguarantee;
                                    $totalLiquidoSubgarantia += $limitForSubguarantee;
                                ?>
                                <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$deductibleToDiscount }}" :currency="$expedient->currency()" /></x-table.cell>

                                <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$limitForSubguarantee}}" :currency="$expedient->currency()" /></x-table.cell>

                                <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$subguaranteeAssessments->where('person_id', $personOption->id)->sum('total_excluded')}}" :currency="$expedient->currency()" /></x-table.cell>

                                @unless($loop->last)
                                    </tr>
                                    <tr>
                                @endunless
                            @endforeach
                        </tr>
                        @php
                            $totalCubiertoCapital += $subguaranteeAssessments->sum('total_proposed');
                            $totalLiquidoCapital += $totalLiquidoSubgarantia;
                            $totalExcluidoCapital += $subguaranteeAssessments->sum('total_excluded');
                        @endphp
                    @empty
                    @endforelse
                    <x-table.row>
                        <x-table.heading colspan="3">{{__('Total capital')}}</x-table.heading>
                        <x-table.heading class="text-right">
                            <x-output.currency-no-symbol class="text-base font-bold" value="{{$totalCubiertoCapital}}" :currency="$expedient->currency()" />
                        </x-table.heading>
                        <x-table.heading colspan="2" />
                        <x-table.heading class="text-right">
                            <x-output.currency-no-symbol class="text-base font-bold" value="{{$totalLiquidoCapital }}" :currency="$expedient->currency()" />
                        </x-table.heading>
                        <x-table.heading class="text-right">
                            <x-output.currency-no-symbol class="text-base font-bold" value="{{$totalExcluidoCapital }}" :currency="$expedient->currency()" />
                        </x-table.heading>
                    </x-table.row>
                </x-slot>
            </x-table.table>

        </div>
    </x-card.card>
@empty
    No hay ningún capital asegurado
@endforelse
</div>
