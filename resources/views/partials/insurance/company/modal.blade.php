<form wire:submit.prevent="save">
    <x-modal.dialog wire:model.defer="showEditModal" class="w-full max-h-full overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {!! $company->getKey()
                    ? '<strong>'.__('Crear una nueva compañía aseguradora').'</strong>'
                    : '<strong>'. $company->name .'</strong> · ' . __('Editar datos de compañía') !!}
            </h3>
            <x-button.close wire:click="$set('showEditModal', false)" />
        </x-slot>

        <x-slot name="content">

            @include('partials.insurance.company.form-inputs')

            @include('partials.forms.address', ['model' => 'billingAddress', 'readonly' => false])

        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    @can('insurance.update')
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
