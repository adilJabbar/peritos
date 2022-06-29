<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>{{__('Plantillas de documentos')}}</div>
        </x-card.header>
    </x-card.card>
    <div class="grid grid-cols-2 gap-4">

        <!-- advances -->
        <x-card.card class="divide-y divide-gray-200">
            <x-card.header>
                <h3>{{__('Avances')}}</h3>
            </x-card.header>
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Name')}}</x-table.heading>
                    <x-table.heading>{{__('Path')}}</x-table.heading>
                    <x-table.heading class="w-0"></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($advances as $advanceRow)
                        <livewire:administration.document-version.row :document="$advanceRow" :key="'document-' . $advanceRow->id" />
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="2" class="text-center">{{ __('No hay ningún avance disponible') }}</x-table.cell>
                        </x-table.row>
                    @endforelse
                    <livewire:administration.document-version.row :document="$newAdvance" :key="'newAdvance'" />
                </x-slot>
            </x-table.table>
        </x-card.card>

        <!-- prereports -->
        <x-card.card class="divide-y divide-gray-200">
            <x-card.header>
                <h3>{{__('Informes Preliminares')}}</h3>
            </x-card.header>
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Name')}}</x-table.heading>
                    <x-table.heading>{{__('Path')}}</x-table.heading>
                    <x-table.heading class="w-0"></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($prereports as $prereportRow)
                        <livewire:administration.document-version.row :document="$prereportRow" :key="'document-' . $prereportRow->id" />
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="2" class="text-center">{{ __('No hay ningún informe preliminar disponible') }}</x-table.cell>
                        </x-table.row>
                    @endforelse
                    <livewire:administration.document-version.row :document="$newPreReport" :key="'newPreReport'" />
                </x-slot>
            </x-table.table>
        </x-card.card>

        <!-- reports -->
        <x-card.card class="divide-y divide-gray-200">
            <x-card.header>
                <h3>{{__('Informes')}}</h3>
            </x-card.header>
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Name')}}</x-table.heading>
                    <x-table.heading>{{__('Path')}}</x-table.heading>
                    <x-table.heading class="w-0"></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($reports as $reportRow)
                        <livewire:administration.document-version.row :document="$reportRow" :key="'document-' . $reportRow->id" />
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="2" class="text-center">{{ __('No hay ningún informe disponible') }}</x-table.cell>
                        </x-table.row>
                    @endforelse
                    <livewire:administration.document-version.row :document="$newReport" :key="'newReport'" />
                </x-slot>
            </x-table.table>
        </x-card.card>

        <!-- invoices -->
        <x-card.card class="divide-y divide-gray-200">
            <x-card.header>
                <h3>{{__('Facturas')}}</h3>
            </x-card.header>
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Name')}}</x-table.heading>
                    <x-table.heading>{{__('Path')}}</x-table.heading>
                    <x-table.heading class="w-0"></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($invoices as $invoiceRow)
                        <livewire:administration.document-version.row :document="$invoiceRow" :key="'document-' . $invoiceRow->id" />
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="2" class="text-center">{{ __('No hay ninguna factura disponible') }}</x-table.cell>
                        </x-table.row>
                    @endforelse
                    <livewire:administration.document-version.row :document="$newInvoice" :key="'newInvoice'" />
                </x-slot>
            </x-table.table>
        </x-card.card>


    </div>
</div>
