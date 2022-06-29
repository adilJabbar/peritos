<!-- Gabinete modal -->
<form wire:submit.prevent="save">
    <x-modal.dialog wire:model.defer="showEditModal" class="w-full max-h-full overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {!! !$currency->getKey()
                    ? '<strong>'.__('Crear una nueva moneda').'</strong>'
                    : '<strong>'. $currency->name .'</strong> · ' . __('Editar datos de la moneda') !!}
            </h3>
            <x-button.close wire:click="$set('showEditModal', false)" />
        </x-slot>

        <x-slot name="content">

            @include('livewire.administration.currency.form-inputs')

        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    <x-button.secondary wire:click="$set('showEditModal', false)">{{__('Cancel')}}</x-button.secondary>
                    <x-button.primary type="submit">{{__('Save')}}</x-button.primary>
                </div>
            </div>

        </x-slot>

    </x-modal.dialog>
</form>
