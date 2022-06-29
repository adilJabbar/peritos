<x-table.table>
    <x-slot name="head">
        <x-table.heading >{{__('Name')}}</x-table.heading>
        <x-table.heading ></x-table.heading>
    </x-slot>

    <x-slot name="body">
        @forelse($capitals->sortBy('position') as $capital)
            <livewire:administration.capital.row :capital="$capital" :key="'capital' . $capital->id" :total="$total = $loop->count" />
        @empty
            <x-table.row>
                <x-table.cell colspan="2">
                    {{__('No hay ningún tipo de capital disponible')}}
                </x-table.cell>
            </x-table.row>
        @endforelse
            <livewire:administration.capital.row :capital="$ramo->capitals()->make(['position' => $ramo->capitals->count() + 1])" :key="'newCapital' . $ramo->id" />
    </x-slot>
</x-table.table>
