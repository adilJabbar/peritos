<x-table.table>
    <x-slot name="head">
        <x-table.heading colspan="2" >{{__('Tipo')}}</x-table.heading>
    </x-slot>
    <x-slot name="body">
        @forelse($subgroups as $subgroup)
            <livewire:administration.risk.subgroup-row :subgroup="$subgroup" :key="'subgroupRow'.$subgroup->id.'-'.$risksubgroupSelected" :selected="$risksubgroupSelected == $subgroup->id" />
        @empty
            <x-table.row>
                <x-table.cell colspan="2">
                    {{__('No hay ningún tipo de riesgos disponible para el grupo ') . __($riskgroup->name) }}
                </x-table.cell>
            </x-table.row>
        @endforelse
        <livewire:administration.risk.subgroup-row :subgroup="$riskgroup->risksubgroups()->make()" :key="'newsubgroupRow'" />
    </x-slot>
</x-table.table>
