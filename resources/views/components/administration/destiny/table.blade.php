<x-table.table>
    <x-slot name="head">
        <x-table.heading >{{__('Code')}}</x-table.heading>
        <x-table.heading >{{__('Name')}}</x-table.heading>
        <x-table.heading ></x-table.heading>
    </x-slot>

    <x-slot name="body">
        @forelse($destinies as $destiny)
            <livewire:administration.destiny.row :destiny="$destiny" :key="$destiny->id" />
        @empty
            <x-table.row>
                <x-table.cell colspan="3">
                    {{__('No hay ningún tipo de destino disponible')}}
                </x-table.cell>
            </x-table.row>
        @endforelse

        <livewire:administration.destiny.row :destiny="\App\Models\Admin\Destiny::make()" :key="'newDestiny'" />

    </x-slot>
</x-table.table>
