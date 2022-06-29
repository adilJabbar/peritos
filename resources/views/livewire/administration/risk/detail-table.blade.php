<x-table.table>
    <x-slot name="head">
        <x-table.heading class="w-full" >{{__('Description')}}</x-table.heading>
        <x-table.heading >{{__('Mod. base')}}</x-table.heading>
        <x-table.heading >{{__('Mod. luxe')}}</x-table.heading>
        <x-table.heading >{{__('Mod. high')}}</x-table.heading>
        <x-table.heading >{{__('Mod. low')}}</x-table.heading>
        <x-table.heading >{{__('Mod. vpo')}}</x-table.heading>
        <x-table.heading ></x-table.heading>
    </x-slot>
    <x-slot name="body">
        @forelse($details as $detail)
            <livewire:administration.risk.detail-row :detail="$detail" :key="'riskDetailRow'.$detail->id" />
        @empty
            <x-table.row>
                <x-table.cell colspan="7">
                    {{__('No hay ningún detalle definido para ') . __($riskSubgroup->name) }}
                </x-table.cell>
            </x-table.row>
        @endforelse
        <livewire:administration.risk.detail-row :detail="$riskSubgroup->riskdetails()->make()" :key="'newriskDetailRow'" />
    </x-slot>
</x-table.table>
