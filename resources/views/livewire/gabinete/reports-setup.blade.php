<x-card.card class="divide-y divide-gray-200">
    <x-card.header>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            <strong>{{$gabinete->name}}</strong> · {{__('Documentos a generar')}}
        </h3>
    </x-card.header>
    <x-table.table>
        <x-slot name="head">
            <x-table.heading>{{__('Document Type')}}</x-table.heading>
            <x-table.heading>{{__('Document selected')}}</x-table.heading>
        </x-slot>
        <x-slot name="body">
{{--                    @dd($reportsOptions)--}}
            @foreach($reportsOptions->unique('type') as $reportOption)
                <x-table.row>
                    <x-table.cell>{{__($reportOption->type)}}</x-table.cell>
                    <x-table.cell>
                        <x-input.select wire:model="gabinete.{{$reportOption->type}}_id" placeholder="Select your {{$reportOption->type}}">
                            @foreach($reportsOptions->where('type', $reportOption->type) as $selectOption)
                                <option value="{{$selectOption->id}}">{{$selectOption->name}}</option>
                            @endforeach
                        </x-input.select>
                    </x-table.cell>
                </x-table.row>
            @endforeach

        </x-slot>
    </x-table.table>
</x-card.card>
