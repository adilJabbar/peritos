<form wire:submit.prevent="save">
    <x-modal.dialog wire:model.defer="showEditModal" class="w-full max-h-full overflow-auto" max-width="3xl" un-closable>

        <x-slot name="title">
            <div class="flex justify-between space-x-4 items-baseline">
                <span class="text-sm text-gray-400" >
                    {{ $expedient->full_code}}
                </span>
                <span class="text-lg leading-6 font-medium text-gray-900">{{ $assessment->getKey() ?  __('Editar línea de valoración') : __('Agregar línea de valoración')}}</span>
            </div>
            <x-button.close wire:click="$set('showEditModal', false)" />
        </x-slot>

        <x-slot name="content">

            @include('livewire.expedient.edit.assessment.form_inputs')
        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    @can('expedient.update')
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
