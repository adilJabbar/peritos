<!-- User modal -->
<form wire:submit.prevent="save">
    <x-modal.dialog wire:model.defer="showEditModal" class="w-full  overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $isANewUser ? __('Create a new user') : __('Edit user') . ': ' . $user->full_name}}
            </h3>
            <x-button.close wire:click="$set('showEditModal', false)" />
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                @include('livewire.user.form-inputs-personal-data')

                <x-card.card class="divide-gray-200 divide-y">
                    <x-card.body>
                        @include('livewire.user.form-inputs-gabinetes')
                    </x-card.body>
                </x-card.card>

                @include('livewire.user.form-inputs-roles')
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    @can('user.update')
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
