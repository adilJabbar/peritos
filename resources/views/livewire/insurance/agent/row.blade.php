<x-table.row>
    <x-table.cell noPadding class="pl-2">
        <x-input.text wire:model.lazy="agent.name" id="{{$agent->id}}-agent-name" placeholder="Nombre del tramitador" :error="$errors->first('agent.name')"/>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.text wire:model.lazy="agent.phone" id="{{$agent->id}}-agent-phone" placeholder="Teléfono principal" :error="$errors->first('agent.phone')"/>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.text wire:model.lazy="agent.phone2" id="{{$agent->id}}-agent-phone2" placeholder="Teléfono secundario" :error="$errors->first('agent.phone2')"/>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.text wire:model.lazy="agent.email" id="{{$agent->id}}-agent-email" placeholder="Dirección de correo electrónico" :error="$errors->first('agent.email')"/>
    </x-table.cell>
    <x-table.cell class="text-center">
        {{$agent->gabinetes->count()}}
    </x-table.cell>
    <x-table.cell noPadding>
        @if($agent->is_active)
            <x-button.danger size="xs" wire:click="delete"><x-icon.trash size="5"/></x-button.danger>
        @else
            <x-button.success size="xs" wire:click="activate"><x-icon.chevron-double-up size="5"/></x-button.success>
        @endif
    </x-table.cell>
</x-table.row>
