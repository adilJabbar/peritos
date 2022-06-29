<?php
    $franquicia = [];
    $limite = [];
?>
@forelse($people as $personOption)
    <?php
        $personIndemnization = 0;
        $personReparation = 0;
        $personCovered = 0;
        $reparationExceedsCovered = false;
    ?>
    <div>
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>{{$personOption->name}}</div>
        </x-card.header>
        <x-table.table>
            <x-slot name="head">
                <x-table.heading>{{ __('Capital') }}</x-table.heading>
                <x-table.heading>{{ __('Garantia') }}</x-table.heading>
                <x-table.heading>{{ __('Subgarantia') }}</x-table.heading>
                <x-table.heading>{{ __('Cubierto') }}</x-table.heading>
                <x-table.heading>{{ __('Reparación') }}</x-table.heading>
                <x-table.heading>{{ __('Indemnización') }}</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse($personOption->capitals as $capitalOption)
                <?php
                        $capitalAssessments = $personOption->assessments->where('capital_id', $capitalOption->id);
                        $personSubguarantees = $personOption->subguarantees->whereIn('id', $capitalAssessments->pluck('subguarantee_id'))->unique();
                    ?>
                    <tr class="bg-white">
                        <x-table.cell rowspan="{{$personSubguarantees->count()}}" >{{$capitalOption->name}}</x-table.cell>
                        @foreach($personSubguarantees as $subguarantee)
                            <?php
                                if(!isset($franquicia[$subguarantee->id])) {$franquicia[$subguarantee->id] = ['available' => 0, 'used' => 0];}
                                $franquicia[$subguarantee->id]['available'] = $capitalOption->franquicia($subguarantee, $expedient->assessments->where('subguarantee_id', $subguarantee->id)->sum('total_liquid')) - $franquicia[$subguarantee->id]['used'];
                                $franquicia[$subguarantee->id]['used'] =
                                 0;
                                $covered = $capitalAssessments->where('subguarantee_id', $subguarantee->id)->sum('total_proposed') + $capitalAssessments->where('subguarantee_id', $subguarantee->id)->sum('total_infraseguro');
                                if ($franquicia[$subguarantee->id]['available'] > 0){
                                    if ($covered > $franquicia[$subguarantee->id]['available']){
                                        $covered = $covered - $franquicia[$subguarantee->id]['available'];
                                        $franquicia[$subguarantee->id]['used'] = $franquicia[$subguarantee->id]['used'] + $franquicia[$subguarantee->id]['available'];
                                        $franquicia[$subguarantee->id]['available'] = 0;
                                    } else {
                                        $franquicia[$subguarantee->id]['used'] = $franquicia[$subguarantee->id]['used'] + $covered;
                                        $franquicia[$subguarantee->id]['available'] = $franquicia[$subguarantee->id]['available'] - $covered;
                                        $covered = 0;
                                    }
                                }

                                if(!isset($limite[$subguarantee->id])) {$limite[$subguarantee->id] = ['totalLimit' => $subguarantee->limit, 'used' => 0];}
                                if($limite[$subguarantee->id]['totalLimit']){
                                    if( $covered > ($limite[$subguarantee->id]['totalLimit'] - $limite[$subguarantee->id]['used'] )){
                                        $limite[$subguarantee->id]['used'] = $limite[$subguarantee->id]['totalLimit'] - $limite[$subguarantee->id]['used'];
                                        $covered = $limite[$subguarantee->id]['used'];
                                    } else {
                                        $limite[$subguarantee->id]['used'] += $covered;
                                  }
                                }
                            ?>
                            <x-table.cell>{{$subguarantee->guarantee->name}}</x-table.cell>
                            <x-table.cell>{{$subguarantee->name}} <span class="text-xs text-gray-500">{{$franquicia[$subguarantee->id]['used'] ? '(' . __('Descontados :importe de franquicia', ['importe' => $franquicia[$subguarantee->id]['used']]) . ')' : ''}}</span></x-table.cell>
                            <x-table.cell class="text-right">
                                <x-output.currency-no-symbol value="{{$covered}}" :currency="$expedient->currency()" />
                                @php $personCovered += $covered; @endphp
                            </x-table.cell>
                                @php
                                    $reparation = $capitalAssessments->where('subguarantee_id', $subguarantee->id)->where('destiny_id', 2)->sum('total_proposed');
                                    $personReparation += $reparation;
                                    $reparation > $covered ? $reparationExceedsCovered = true : '';
                                @endphp
                            <x-table.cell class="text-right {{ $reparation > $covered ? 'bg-red-100 text-red-700' : '' }}">
                                <x-output.currency-no-symbol value="{{ $reparation }}" :currency="$expedient->currency()" />

                            </x-table.cell>
                                @php
                                    $indemnization = $covered - $capitalAssessments->where('subguarantee_id', $subguarantee->id)->where('destiny_id', 2)->sum('total_proposed');
                                    $personIndemnization += $indemnization;
                                @endphp
                            <x-table.cell class="text-right {{ $indemnization < 0 ? 'bg-red-100 text-red-700' : '' }}">
                                <x-output.currency-no-symbol value="{{ $indemnization }}" :currency="$expedient->currency()" />
                            </x-table.cell>

                            @unless($loop->last)
                            </tr>
                            <tr>
                            @endunless
                        @endforeach
                    </tr>
                @empty
                @endforelse
                <x-table.row>
                    <x-table.heading colspan="3">{{__('Totales')}}</x-table.heading>
                    <x-table.heading class="text-right"><x-output.currency class="text-base font-bold" value="{{$personCovered}}" :currency="$expedient->currency()" /></x-table.heading>
                    <x-table.heading class="text-right"><x-output.currency class="text-base font-bold" value="{{$personReparation}}" :currency="$expedient->currency()" /></x-table.heading>
                    <x-table.heading class="text-right"><x-output.currency class="text-base font-bold" value="{{$personIndemnization}}" :currency="$expedient->currency()" /></x-table.heading>
                </x-table.row>
            </x-slot>
        </x-table.table>
    </x-card.card>
    @if($reparationExceedsCovered)
        <div class="flex justify-end mt-1">
            <span class="text-red-700 text-xs">* {{__('Hay partidas asignadas a reparación que exceden el capital cubierto')}}</span>
        </div>
    @endif
    </div>
@empty
@endforelse
