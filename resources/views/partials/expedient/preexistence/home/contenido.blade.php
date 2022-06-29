<x-modal.dialog wire:model.defer="showContenidoCalculations" class="w-full max-h-full overflow-auto" max-width="xl">

    <x-slot name="title">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{__('Contenido calculado')}}
        </h3>
        <x-button.close wire:click="$set('showContenidoCalculations', false)" />
    </x-slot>

    <x-slot name="content">

        <div class="space-y-4">
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading></x-table.heading>
                    <x-table.heading>{{__('Reposición')}}</x-table.heading>
                    {{--                <x-table.heading>{{__('Real')}}</x-table.heading>--}}
                </x-slot>

                <x-slot name="body">
                    <x-table.row>
                        <x-table.cell>{{__('Valor de contenido base')}}</x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->contentBase()}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                        {{--                    <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->building_real_value}}" :currency="$preexistence->address->country->currency" /></x-table.cell>--}}
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell>{{__('Estancias')}}</x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->contentRooms()}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                        {{--                    <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->address->country->seg_salud}}" :currency="$preexistence->address->country->currency" /></x-table.cell>--}}
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell>{{__('Enseres personales')}}</x-table.cell>
                        <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->contentPeople()}}" :currency="$preexistence->address->country->currency" /></x-table.cell>
                        {{--                    <x-table.cell class="text-right"><x-output.currency-no-symbol value="{{$preexistence->gastosGenerales($preexistence->building_real_value)}}" :currency="$preexistence->address->country->currency" /></x-table.cell>--}}
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell class="text-right">{{__('Subtotal')}}</x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="text-gray-400" value="{{$preexistence->contentSubtotal()}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                        {{--                    <x-table.cell class="text-right">--}}
                        {{--                        <x-output.currency-no-symbol class="text-gray-400"  value="{{$preexistence->subtotal($preexistence->building_real_value)}}" :currency="$preexistence->address->country->currency" />--}}
                        {{--                    </x-table.cell>--}}
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell class="text-right">{{$preexistence->address->country->taxes}}{{__('% Impuestos')}}</x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="text-gray-400" value="{{$preexistence->contentSubtotalTaxes()}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                        {{--                    <x-table.cell class="text-right">--}}
                        {{--                        <x-output.currency-no-symbol class="text-gray-400"  value="{{$preexistence->subtotal($preexistence->building_real_value) * $preexistence->address->country->reduced_taxes / 100}}" :currency="$preexistence->address->country->currency" />--}}
                        {{--                    </x-table.cell>--}}
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell class="text-right font-bold">{{__('Total')}}</x-table.cell>
                        <x-table.cell class="text-right">
                            <x-output.currency-no-symbol class="font-bold" value="{{$preexistence->contentValueProposal()}}" :currency="$preexistence->address->country->currency" />
                        </x-table.cell>
                        {{--                    <x-table.cell class="text-right">--}}
                        {{--                        <x-output.currency-no-symbol class="font-bold"  value="{{$preexistence->total($preexistence->building_real_value)}}" :currency="$preexistence->address->country->currency" />--}}
                        {{--                    </x-table.cell>--}}
                    </x-table.row>
                </x-slot>

            </x-table.table>

        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="w-full flex justify-end">
            <x-button.secondary wire:click="$set('showContenidoCalculations', false)">{{__('Cerrar')}}</x-button.secondary>
        </div>

    </x-slot>

</x-modal.dialog>
