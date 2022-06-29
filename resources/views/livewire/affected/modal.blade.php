<!-- User modal -->
<form wire:submit.prevent="save" wire:key="affectedModal">
    <x-modal.dialog wire:model.defer="showAffectedModal" class="w-full  overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $person->getKey() ? __('Editar afectado') : __('Añadir afectado al expediente') }}
            </h3>
            <x-button.close wire:click="$set('showAffectedModal', false)" />
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <x-input.group for="affected-type" label="Type"
                               :error="$errors->first('affected.type')" borderless>
                    <x-input.select wire:model="affected.type" placeholder="Tipo de afectado...">
                        <option value="causante">{{__('Causante')}}</option>
                        <option value="perjudicado">{{__('Perjudicado')}}</option>
                    </x-input.select>
                </x-input.group>

                <div>
                    @if($affected['type'])
                        <x-input.group for="affected.reclamation" label="{{ $affected['type'] == 'causante' ? __('Importe a reclamar') : __('Importe que reclama') }}" :error="$errors->first('affected.reclamation')" borderless>
                            <x-input.money wire:model="affected.reclamation" :currency="$expedient->address->country->currency" id="affected.reclamation" :error="$errors->first('affected.reclamation')" />
                        </x-input.group>
                    @endif
                </div>

                @include('livewire.person.person_data')
                <div>
                    @if($person->name || $person->legal_id)
                        @include('livewire.person.address_data')
                        @include('livewire.person.contact_data')
                    @endif
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    <x-button.secondary wire:click="$set('showAffectedModal', false)">{{__('Cancel')}}</x-button.secondary>
                    <x-button.primary type="submit">{{__('Save')}}</x-button.primary>
                </div>
            </div>

        </x-slot>

    </x-modal.dialog>
</form>
