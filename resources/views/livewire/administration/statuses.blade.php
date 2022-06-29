<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>{{__('Tipos de propuesta')}}</div>
        </x-card.header>
    </x-card.card>
    <x-card.card>
        <x-table.table>
            <x-slot name="head">
                <x-table.heading >{{__('Order')}}</x-table.heading>
                <x-table.heading >{{__('Name')}}</x-table.heading>
                <x-table.heading class="w-0"></x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse($statuses->sortBy('order') as $statusRow)
                    <livewire:administration.status.row :status="$statusRow" wire:key="status{{$statusRow->id}}" />
{{--                    <livewire:administration.destiny.row :destiny="$destiny" :key="$destiny->id" />--}}
                @empty
                    <x-table.row>
                        <x-table.cell colspan="3">
                            {{__('No hay ningún estado disponible')}}
                        </x-table.cell>
                    </x-table.row>
                @endforelse

                <livewire:administration.status.row :status="$newStatus" :key="'newStatus'" />

            </x-slot>
        </x-table.table>
    </x-card.card>
</div>
