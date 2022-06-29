<div>
    <div class="sm:grid sm:grid-cols-3 sm:gap-2" >
        <div class="mt-1 sm:mt-0 w-full" >
            <x-input.select wire:model="{{$array}}.{{$loop->index}}.type" :readonly="$readonly" :error="$errors->first($array . '.' . $loop->index . '.type')">
                <option value="" disabled >{{__('Tipo...')}}</option>
                <option value="phone">{{ __('Phone') }}</option>
                <option value="email">{{ __('email') }}</option>
            </x-input.select>
        </div>

        <div class="mt-1 sm:mt-0 sm:col-span-2 flex justify-between space-x-2">

            <x-input.text wire:model="{{$array}}.{{$loop->index}}.value" :readonly="$readonly" :error="$errors->first($array . '.' . $loop->index . '.value')" id="{{$array}}-contact-value-{{ $loop->index }}" />
            @unless($readonly)
                @if($total > 1)
                    <x-button.danger wire:click="removeContactOption('{{$array}}', '{{$loop->index}}')" size="sm"><x-icon.minus-sm size="4" /></x-button.danger>
                @endif
                @if($loop->last)
                    <x-button.primary wire:click="addContactOption('{{$array}}')" size="sm"><x-icon.plus size="4" /></x-button.primary>
                @endif
            @endunless
        </div>
    </div>
    @if ($errors->first( $array . '.' . $loop->index . '.*' ))
        <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first( $array . '.' . $loop->index . '.*' ) }}</div>
    @endif
</div>
