<div>
    <x-input.group for="billable-person-legal_id" label="CIF" borderless
                   :error="$errors->first('person.legal_id')">
        <x-input.text wire:model.lazy="person.legal_id" id="billable-person-legal_id" placeholder="CIF" :error="$errors->first('person.legal_id')"
                      :readonly="$person->getKey()"
        />
    </x-input.group>

    @if($person->getKey() && $person->id != $expedient->billable->id)
        <div class="flex justify-end">
            <x-button.link wire:click="resetAll" >{{__('Resetear')}}</x-button.link>
        </div>
    @endif

    <x-input.group for="billable-person-name" label="Name" borderless
                   :error="$errors->first('person.name')">
        <x-input.text wire:model.lazy="person.name" id="billable-person-name" placeholder="Name"
                      :error="$errors->first('person.name')" :readonly="$readonly ?? false"/>
    </x-input.group>

    <x-input.group for="billable-person-legal_name" label="Legal Name" borderless
                   :error="$errors->first('person.legal_name')">
        <x-input.text wire:model.lazy="person.legal_name" id="billable-person-legal_name"
                      placeholder="Legal Name" :error="$errors->first('person.legal_name')" :readonly="$readonly ?? false"/>
    </x-input.group>
</div>
