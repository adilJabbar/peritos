<div>
    <x-input.group for="capital.{{$capital->id}}" label="{{__($capital->name)}}" :error="$errors->first('capital.pivot.amount')" borderless >
        <div class="flex justify-between space-x-4">
            <x-input.money wire:model.lazy="capital.pivot.amount" id="capital.{{$capital->id}}" :error="$errors->first('capital.pivot.amount')" placeholder="Importe asegurado" />
            <x-input.checkbox wire:model="capital.pivot.primer_riesgo" size="9"/>
        </div>
    </x-input.group>
</div>
