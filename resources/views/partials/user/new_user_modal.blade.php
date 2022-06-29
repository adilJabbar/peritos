<!-- User modal -->
<form wire:submit.prevent="saveNewUser">
    <x-modal.dialog wire:model.defer="showEditModal" class="w-full  overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('Create a new user') }}
            </h3>
            <x-button.close wire:click="$set('showEditModal', false)" />
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                @include('livewire.user.form-inputs-personal-data')

                <x-card.card class="divide-gray-200 divide-y">
                    <x-card.body>
                        @if(($gabinete ?? false) && $gabinete->subcontractors->count() > 0)
                            <x-input.group label="Subcontrata" for="subcontractor-id{{$gabinete->id}}" :error="$errors->first('subcontractorId')" borderless>
                                <x-input.select wire:model="subcontractorId" placeholder="Selecciona la empresa..." id="subcontractor-id{{$gabinete->id}}" :error="$errors->first('subcontractorId')">
                                    <option value="0">{{__('Empleado de :Gabinete', ['gabinete' => $gabinete->name])}}</option>
                                    @foreach($gabinete->subcontractors->sortBy('name') as $subcontractorRow)
                                        <option value="{{$subcontractorRow->id}}">{{ $subcontractorRow->name }}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                        @endif
                        @include('livewire.user.form-inputs-gabinetes', ['showGabineteSelector' => $showGabineteSelector ?? true])
                    </x-card.body>
                </x-card.card>

                @if($gabineteSelected)
                    @include('livewire.user.form-inputs-roles')
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    @can('user.update')
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
