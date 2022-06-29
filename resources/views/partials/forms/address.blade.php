<div>
    @if(!isset($hideAddressName) || !$hideAddressName)
    <!-- Name -->
    <x-input.group label="Name" help-label="(opcional)" for="{{$model}}{{$address->id ?? '' }}-address-name" :error="$errors->first($model . '.name')" borderless>
        <x-input.text wire:model.lazy="{{ $model }}.name" id="{{$model}}{{$address->id ?? '' }}-address-name" :readonly="$readonly" :error="$errors->first($model . '.name')" placeholder="Nombre para identificar esta dirección"/>
    </x-input.group>
    @endif

    <x-input.group label="Country" for="{{$model}}{{$address->id ?? '' }}-address-country_id" :error="$errors->first($model . '.country_id')" borderless>

        <x-input.select wire:model="{{ $model }}.country_id" id="{{$model}}{{$address->id ?? '' }}-address-country_id"  :readonly="$readonly" :error="$errors->first($model . '.country_id')" placeholder="Select country">
            @foreach(\App\Models\Admin\Country::all() as $country)
                <option value="{{$country->id}}">{{ __($country->name) }}</option>
            @endforeach
        </x-input.select>
    </x-input.group>

    <!-- Address -->
    <x-input.group label="Address" for="address" :error="$errors->first($model . '.address')" borderless>
        <x-input.text wire:model.lazy="{{ $model }}.address" id="{{$model}}{{$address->id ?? '' }}-address-address" :readonly="$readonly" :error="$errors->first($model . '.address')" placeholder="Address"/>
    </x-input.group>

    <x-input.group label=" " for="{{$model}}{{$address->id ?? '' }}-address-city" :error="$errors->first($model . '.city')" borderless>
        <x-input.text wire:model.lazy="{{ $model }}.city" id="{{$model}}{{$address->id ?? '' }}-address-city" :readonly="$readonly" :error="$errors->first($model . '.city')" placeholder="City"/>
    </x-input.group>

    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start  sm:border-gray-200  sm:py-2">
        <div></div>
        <x-input.group for="{{$model}}{{$address->id ?? '' }}-address-zip" :error="$errors->first($model . '.zip')" borderless paddingless>
            <x-input.text wire:model.lazy="{{ $model }}.zip" id="{{$model}}{{$address->id ?? '' }}-address-zip"  :readonly="$readonly" :error="$errors->first($model . '.zip')" placeholder="Zip code"/>
        </x-input.group>
        <x-input.group for="{{$model}}{{$address->id ?? '' }}-address-state" :error="$errors->first($model . '.state')" borderless paddingless>
            @if(optional(${$model})->country && count(${$model}->country->states) > 0)
                <x-input.select wire:model="{{ $model }}.state" id="{{$model}}{{$address->id ?? '' }}-address-state"  :readonly="$readonly" placeholder="Select state...">
                    @foreach(${$model}->country->states as $state)
                        <option value="{{$state->name}}">{{ __($state->name) }}</option>
                    @endforeach
                </x-input.select>
            @else
                <x-input.text wire:model.lazy="{{ $model }}.state" id="{{$model}}{{$address->id ?? '' }}-address-state" :readonly="$readonly"  placeholder="State"/>
            @endif
        </x-input.group>
    </div>

</div>
