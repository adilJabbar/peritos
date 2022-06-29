<div>
{{--    {{$capital->id}}--}}
{{--   @dd($capital->id)--}}
    <x-input.group for="capital-{{$capital->id}}" wire:key="capital-group-{{$capital->id}}" label="{{__($capital['name'])}}"  :helpLabel="$capital['predefined'] ? ('(' . __('predef. para :capital', ['capital' => $capital['predefined']]) . ')') : ''" :error="$errors->first('capital.name')" borderless >
        <div class="flex justify-between space-x-4 items-center">
            <x-input.checkbox wire:model="showCapital" size="7"/>
            @if($showCapital)
            <div class="flex-grow">
{{--                @if($this->policy->product->ramo)--}}
                <x-input.money wire:model.lazy="capital.pivot.amount" id="capital-amount-{{$capital->id}}" :error="$errors->first('capital.name')" placeholder="Importe asegurado" />
{{--                @endif--}}
            </div>
            <x-input.checkbox wire:model="capital.pivot.primer_riesgo" size="7"/>
            @endif
        </div>
    </x-input.group>
</div>
