<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('company.show', ['company' => $company->id]) }}">{{ $company->name }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Tramitadores') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>


    <div class="space-y-4">
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3>{{__('Tramitadores de')}} {{$company->name}}</h3>
            </x-card.header>
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Nombre')}}</x-table.heading>
                    <x-table.heading>{{__('Teléfono 1')}}</x-table.heading>
                    <x-table.heading>{{__('Teléfono 2')}}</x-table.heading>
                    <x-table.heading>{{__('email')}}</x-table.heading>
                    <x-table.heading class="w-0">{{__('Gabinetes')}}</x-table.heading>
                    <x-table.heading class="w-0"></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($company->agents->where('is_active', true) as $agentRow)
                        <livewire:insurance.agent.row :agent="$agentRow" :key="'agentRow' . $agentRow->id">
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6" class="text-sm text-gray-800">{{__('No hay ningún tramitador en activo para :company', ['company' => $company->name])}}</x-table.cell>
                        </x-table.row>
                    @endforelse

                    @forelse($company->agents->where('is_active', false) as $agentRow)
                        <livewire:insurance.agent.row :agent="$agentRow" :key="'agentRow' . $agentRow->id">
                    @empty
                    @endforelse
                </x-slot>
            </x-table.table>
        </x-card.card>
    </div>
</div>
