<x-table.table>
    <x-slot name="head">
        <x-table.heading class="w-full" >{{__('Name')}}</x-table.heading>
        <x-table.heading >{{__('Años')}}</x-table.heading>
        <x-table.heading class="whitespace-nowrap">{{__('% Residual')}}</x-table.heading>
        <x-table.heading ></x-table.heading>
    </x-slot>

    <x-slot name="body">
        @forelse($deprecationGroups as $deprecationgroup)
            <livewire:administration.deprecationgroup.row :deprecationgroup="$deprecationgroup" :key="'deprecationgroup'.$deprecationgroup->id" />
        @empty
            <x-table.row>
                <x-table.cell colspan="5">
                    {{__('No hay ningún grupo de depreciación disponible')}}
                </x-table.cell>
            </x-table.row>
        @endforelse

        <livewire:administration.deprecationgroup.row :deprecationgroup="$country->deprecationgroups()->make()" :key="'newDeprecationgroup'" />
    </x-slot>
</x-table.table>
