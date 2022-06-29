<form wire:submit.prevent="save">
    <x-modal.dialog wire:model.defer="showCalculationModal" class="w-full max-h-full overflow-auto" max-width="3xl" un-closable>

        <x-slot name="title">
            <div class="flex justify-between space-x-4 items-baseline">
                <span class="text-sm text-gray-400" >
                    {{ $expedient->full_code}}
                </span>
{{--                <span class="text-lg leading-6 font-medium text-gray-900">{{ $assessment->getKey() ?  __('Editar línea de valoración') : __('Agregar línea de valoración')}}</span>--}}
            </div>
            <x-button.close wire:click="$set('showCalculationModal', false)" />
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                @json($subguarantee)
                <x-table.table>
                    <x-slot name="head">
                        <x-table.heading>{{__('Capital')}}</x-table.heading>
                        <x-table.heading>{{__('Daños')}}</x-table.heading>
                        <x-table.heading>{{__('Límite')}}</x-table.heading>
                        <x-table.heading>{{__('Infraseguro')}}</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($capitals as $capitalOption)
                            @php($capital = $expedient->policy->capitals->where('id', $capitalOption)->first())
                            <x-table.row wire:key="capital-{{$capital->id}}">
                                <x-table.cell>{{$capital->name}}</x-table.cell>
                                <x-table.cell class="text-right">
                                    <x-output.currency-no-symbol value="{{$expedient->totalProposedByCapital($capital->id)}}" :currency="$expedient->currency()" />
                                </x-table.cell>
                                <x-table.cell class="text-right">
                                    <x-output.currency-no-symbol value="{{$capital->limitValue()}}" :currency="$expedient->currency()" />
                                </x-table.cell>
                                <x-table.cell class="text-right">
                                    <x-output.percent value="{{$capital->infraseguroPercent()}}" :currency="$expedient->currency()" />
                                </x-table.cell>
                            </x-table.row>
                        @empty
                        @endforelse

                    </x-slot>
                </x-table.table>

                <x-table.table class="ml-6">
                    <x-slot name="head">
                        <x-table.heading>{{__('Subgarantia')}}</x-table.heading>
                        <x-table.heading>{{__('Primer Riesgo')}}</x-table.heading>
                        <x-table.heading>{{__('Límite')}}</x-table.heading>
                        <x-table.heading>{{__('Franquicia')}}</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($capitals as $capitalOption)
                            @php($capital = $expedient->policy->capitals->where('id', $capitalOption)->first())
                            <x-table.row wire:key="capital-{{$capital->id}}">
                                <x-table.cell>{{$capital->name}}</x-table.cell>
                                <x-table.cell class="text-center">{{$capital->pivot->primer_riesgo ? __('Yes') : __('No')}}</x-table.cell>
                                <x-table.cell class="text-right">
                                    <x-output.currency-no-symbol value="{{$expedient->totalProposedByCapital($capital->id)}}" :currency="$expedient->currency()" />
                                </x-table.cell>
                                <x-table.cell class="text-right">
                                    <x-output.currency-no-symbol value="{{$capital->limitValue()}}" :currency="$expedient->currency()" />
                                </x-table.cell>
                            </x-table.row>
                        @empty
                        @endforelse

                    </x-slot>
                </x-table.table>
            </div>



{{--            @json($assessments->pluck('capital_id')->unique())--}}

{{--            @include('livewire.expedient.edit.assessment.form_inputs')--}}
        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    <x-button.secondary wire:click="$set('showCalculationModal', false)">{{__('Cerrar')}}</x-button.secondary>
                </div>
            </div>

        </x-slot>

    </x-modal.dialog>
</form>
