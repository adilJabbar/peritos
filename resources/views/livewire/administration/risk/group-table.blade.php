<div>
    <x-table.table>
        <x-slot name="head">
            <x-table.heading colspan="2" >{{__('Grupo')}}</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @forelse($groups as $group)
                <livewire:administration.risk.group-row :group="$group" :key="'riskGroupRow'.$group->id.'-'.$riskgroupSelected" :selected="$riskgroupSelected == $group->id" />
            @empty
            <x-table.row>
                <x-table.cell colspan="2">
                    {{__('No hay ningún grupo de riesgos disponible para ') . __($country->name) }}
                </x-table.cell>
            </x-table.row>
            @endforelse
            <livewire:administration.risk.group-row :group="$country->riskgroups()->make()" :key="'newRiskGroupRow'" />
        </x-slot>
    </x-table.table>
</div>
