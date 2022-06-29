<div>
    <x-input.group for="company-id" label="Company Name" borderless
                   :error="$errors->first('expedient.billable_id')">
        <x-input.select wire:model="expedient.billable_id" id="company-id"
                        placeholder="Selecciona la compañía aseguradora..."
                        :error="$errors->first('expedient.billable_id')">
            @foreach($expedient->gabinete->companies->sortBy('name') as $companyOption)
                <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
            @endforeach
        </x-input.select>
    </x-input.group>
    @if($company->getKey())
        <x-input.group for="cia-tramitador" label="Tramitador" borderless
                       :error="$errors->first('expedient.agent_id')">
            <x-input.select wire:model="expedient.agent_id" id="cia-tramitador"
                            placeholder="Selecciona el tramitador..."
                            :error="$errors->first('expedient.agent_id')">
                @foreach($company->agents as $agentOption)
                    <option value="{{ $agentOption->id }}">{{ $agentOption->name }}</option>
                @endforeach
            </x-input.select>
            @if($expedient->agent) <span
                class="text-gray-500 text-sm">{{ implode('  ·  ', [$expedient->agent->phone, $expedient->agent->phone2, $expedient->agent->email]) }}</span> @endif
        </x-input.group>
    @endif
</div>
