<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Llamadas'" />
    </x-card.card>

    <x-card.card>
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div>
                {{ __('La llamada se realizará desde el número :number', ['number' => $expedient->gabinete->caller_number]) }}
            </div>
            <div>
                <livewire:communication.dialer :callerNumber="$expedient->gabinete->caller_number"/>
            </div>
        </div>
    </x-card.card>
</div>
