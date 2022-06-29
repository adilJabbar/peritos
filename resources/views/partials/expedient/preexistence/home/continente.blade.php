<x-modal.dialog wire:model.defer="showContinenteCalculations" class="w-full max-h-full overflow-auto" max-width="xl">

    <x-slot name="title">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{__('Contiente calculado')}}
        </h3>
        <x-button.close wire:click="$set('showContinenteCalculations', false)" />
    </x-slot>

    <x-slot name="content">

        <div class="flex text-sm mb-4">
            <div class="w-1/2">
                <span>{{__('Valor m² según ubicación y tipología')}}</span>
            </div>
            <div class="w-1/2">
                <x-output.currency value="{{$preexistence->valuem2()}}" :currency="$preexistence->address->country->currency" />
            </div>
        </div>
        <div class="space-y-4">

             <x-table.table>
                <x-slot name="head">
                    <x-table.heading></x-table.heading>
                    <x-table.heading>{{__('Reposición')}}</x-table.heading>
                    <x-table.heading>{{__('Real')}}</x-table.heading>
                </x-slot>

                <x-slot name="body">
                    <x-table.row>
                        <x-table.cell>{{__('Presupuesto Ejecución Material')}}</x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->building_value}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->building_real_value}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell>{{__('Proyecto Seguridad y Salud')}}</x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->address->country->seg_salud}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->address->country->seg_salud * $preexistence->building_deprecation_coeficient}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell>{{__('Gastos Generales')}}</x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->gastosGenerales($preexistence->building_value)}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->gastosGenerales($preexistence->building_value) * $preexistence->building_deprecation_coeficient}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell>{{__('Beneficio Industrial')}}</x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->beneficioIndustrial($preexistence->building_value)}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->beneficioIndustrial($preexistence->building_value) * $preexistence->building_deprecation_coeficient}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell class="text-right">{{__('Subtotal')}}</x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="text-gray-400" value="{{$preexistence->subtotal($preexistence->building_value)}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="text-gray-400"  value="{{$preexistence->subtotal($preexistence->building_value) * $preexistence->building_deprecation_coeficient}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell class="text-right">{{$preexistence->address->country->reduced_taxes}}{{__('% Impuestos')}}</x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="text-gray-400" value="{{$preexistence->subtotal($preexistence->building_value) * $preexistence->address->country->reduced_taxes / 100}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="text-gray-400"  value="{{$preexistence->subtotal($preexistence->building_value) * $preexistence->building_deprecation_coeficient * $preexistence->address->country->reduced_taxes / 100}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell class="text-right font-bold">{{__('Total')}}</x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="font-bold" value="{{$preexistence->total($preexistence->building_value)}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="font-bold"  value="{{$preexistence->total($preexistence->building_value) * $preexistence->building_deprecation_coeficient}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                    </x-table.row>
                    <tr>
                        <td></td>
                    </tr>
                <x-table.row>
                    <x-table.cell>{{__('Honorarios arquitecto y aparejador')}}</x-table.cell>
                    <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->building_value * $preexistence->address->country->arquitecto_perc / 100}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                    <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->building_real_value * $preexistence->address->country->arquitecto_perc / 100}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.cell class="text-right">{{$preexistence->address->country->reduced_taxes}}{{__('% Impuestos')}}</x-table.cell>
                    <x-table.cell class="text-right">
                        <x-output.currency-no-symbol class="text-gray-400" value="{{$preexistence->building_value * $preexistence->address->country->arquitecto_perc / 100 * $preexistence->address->country->reduced_taxes / 100}}" :currency="$preexistence->address->country->currency" />
                    </x-table.cell>
                    <x-table.cell class="text-right">
                        <x-output.currency-no-symbol class="text-gray-400"  value="{{$preexistence->building_real_value * $preexistence->address->country->arquitecto_perc / 100 * $preexistence->address->country->reduced_taxes / 100}}" :currency="$preexistence->address->country->currency" />
                    </x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.cell class="text-right">{{__('Licencia')}}</x-table.cell>
                    <x-table.cell class="text-right">
                        <x-output.currency-no-symbol class="text-gray-400" value="{{$preexistence->building_value * $preexistence->address->country->license_perc / 100 }}" :currency="$preexistence->address->country->currency" />
                    </x-table.cell>
                    <x-table.cell class="text-right">
                        <x-output.currency-no-symbol class="text-gray-400"  value="{{$preexistence->building_real_value * $preexistence->address->country->license_perc / 100 }}" :currency="$preexistence->address->country->currency" />
                    </x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.cell class="text-right font-bold">{{__('Total')}}</x-table.cell>
                    <x-table.cell class="text-right">
                        <x-output.currency-no-symbol class="font-bold" value="{{$preexistence->continentValueProposal($preexistence->building_value)}}" :currency="$preexistence->address->country->currency" />
                    </x-table.cell>
                    <x-table.cell class="text-right">
                        <x-output.currency-no-symbol class="font-bold"  value="{{$preexistence->continentValueProposal($preexistence->building_value) * $preexistence->building_deprecation_coeficient}}" :currency="$preexistence->address->country->currency" />
                    </x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table.table>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="w-full flex justify-end">
            <x-button.secondary wire:click="$set('showContinenteCalculations', false)">{{__('Cerrar')}}</x-button.secondary>
        </div>

    </x-slot>

</x-modal.dialog>
