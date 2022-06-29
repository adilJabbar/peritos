<x-table.table>
    <x-slot name="head">
        <x-table.heading >{{__('Name')}}</x-table.heading>
        <x-table.heading >{{__('Texts')}}</x-table.heading>
        <x-table.heading >{{__('Preexistences')}}</x-table.heading>
        <x-table.heading >{{__('Tasacion')}}</x-table.heading>
        <x-table.heading ></x-table.heading>
    </x-slot>

    <x-slot name="body">
        @forelse($typecases as $typecase)
            <livewire:administration.typecase.row :typecase="$typecase" :key="'typecase'.$typecase->id" />
        @empty
            <x-table.row>
                <x-table.cell colspan="5">
                    {{__('No hay ningún tipo de siniestro disponible')}}
                </x-table.cell>
            </x-table.row>
        @endforelse
            <livewire:administration.typecase.row :typecase="$ramo->typecases()->make()" :key="'newTypecase' . $ramo->id" />
    </x-slot>
</x-table.table>
