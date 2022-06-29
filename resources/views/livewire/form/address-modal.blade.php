<div>

    <form wire:submit.prevent="saveAddress">
        <x-modal.dialog wire:model.defer="showAddressModal" class="w-full max-h-full overflow-auto" un-closable>

            <x-slot name="title">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{__('Address')}}
                </h3>
                <x-button.close wire:click="$set('showAddressModal', false)" />
            </x-slot>

            <x-slot name="content">

                @include('partials.forms.address', ['model' => 'address', 'address' => $address, 'readonly' => false])

            </x-slot>

            <x-slot name="footer">
                <div class="w-full flex justify-end">
                    <div>
                        <x-button.secondary wire:click="$set('showAddressModal', false)">{{__('Cerrar')}}</x-button.secondary>
                        <x-button.primary type="submit">{{__('Confirmar')}}</x-button.primary>
                    </div>
                </div>

            </x-slot>

        </x-modal.dialog>
    </form>

</div>
