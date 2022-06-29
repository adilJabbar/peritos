<div class="mt-1 sm:mt-0 sm:col-span-2 space-y-2">
    @foreach($arrayRelations as $key => $value)
        <div wire:key="{{ $arrayRelations . $loop->index }}">
            <div class="sm:grid sm:grid-cols-3 sm:gap-2" >
                <div class="mt-1 sm:mt-0 w-full" >
                    <x-input.select wire:model="{{$arrayRelations}}.{{$key}}.type" :readonly="$readonly" :error="$errors->first($arrayRelations . '.contacts.' . $key . '.type')">
                        <option value="" disabled >{{__('Tipo...')}}</option>
                        <option value="phone">{{ __('Phone') }}</option>
                        <option value="email">{{ __('email') }}</option>
                    </x-input.select>
                </div>

                <div class="mt-1 sm:mt-0 sm:col-span-2 flex justify-between space-x-2">

                    <x-input.text wire:model="{{ $arrayRelations }}.{{ $key }}.value" :readonly="$readonly" :error="$errors->first($arrayRelations . '.contacts.' . $key . '.value')" id="{{ $arrayRelations }}contact-value-{{ $key }}" />
                    @unless($readonly)
                        @if(count($arrayRelations) > 1)
                            <x-button.danger wire:click="removeContactOption('{{$arrayRelations}}', {{$key}})" size="sm"><x-icon.minus-sm size="4" /></x-button.danger>
                        @endif
                        @if($loop->last)
                            <x-button.primary wire:click="addContactOption('{{$arrayRelations}}', {{$key}})" size="sm"><x-icon.plus size="4" /></x-button.primary>
                        @endif
{{--                        @if(array[$model][$key]['value'])--}}

{{--                        @endif--}}
                    @endunless
                </div>
            </div>
            @if ($errors->first( $arrayRelations . '.' . $key . '.*' ))
                <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first( $arrayRelations . '.' . $key . '.*' ) }}</div>
            @endif
        </div>
    @endforeach
</div>
