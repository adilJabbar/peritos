<!-- Gabinete modal -->
<form wire:submit.prevent="save">
    <x-modal.dialog wire:model.defer="showEditModal" class="w-full max-h-full overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{__('Gabinete')}}
            </h3>
            <x-button.close wire:click="$set('showEditModal', false)" />
        </x-slot>

        <x-slot name="content">

            @include('livewire.gabinete.form-inputs')

        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-between">
                <div>
                    <x-button.secondary wire:click="createNewToken()">{{__('Crear un nuevo token')}}</x-button.secondary>
                </div>
                <div>
                    @can('gabinete.update')
{{--                        <x-notification.inline notification="notify-saved">{{__('¡¡ Guardado !!')}}</x-notification.inline>--}}
                        <x-button.secondary wire:click="$set('showEditModal', false)">{{__('Cancel')}}</x-button.secondary>
                        <x-button.primary type="submit">{{__('Save')}}</x-button.primary>
                    @else
                        <x-button.secondary wire:click="$set('showEditModal', false)">{{__('Cerrar')}}</x-button.secondary>
                    @endcan
                </div>
            </div>

        </x-slot>

    </x-modal.dialog>
</form>
