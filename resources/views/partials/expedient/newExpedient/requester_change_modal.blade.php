<x-jet-confirmation-modal wire:model="showChangeRequesterTypeModal">
    <x-slot name="title">
        {{ __('Cambiar el tipo de solicitante') }}
    </x-slot>

    <x-slot name="content">
        {{ __('¿Estás seguro de que quieres cambiar el tipo de solicitante?') }}
        <p class="text-gray-500 text-sm">{{__('Los datos del actual soilcitante se eliminarán y tendrás que introducirlos de nuevo.')}}</p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="doNotChangeRequesterType" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="changeRequesterType" wire:loading.attr="disabled">
            {{ __('Cambiar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
