<div>
    <div class="sm:grid sm:grid-cols-3 sm:gap-2" >
        <div class="mt-1 sm:mt-0 w-full" >
            <x-input.select wire:model="contact.type" :readonly="$readonly" :error="$errors->first('contact.type')">
                <option value="" disabled >{{__('Tipo...')}}</option>
                <option value="phone">{{ __('Phone') }}</option>
                <option value="email">{{ __('email') }}</option>
            </x-input.select>
        </div>

        <div class="mt-1 sm:mt-0 sm:col-span-2 flex justify-between space-x-2">

            <x-input.text wire:model="contact.value" :readonly="$readonly" :error="$errors->first('contact.value')" id="contact-value-{{ $contact->id }}" />
            @unless($readonly)
                <x-button.danger wire:click="removeContact" size="sm">
                    <x-icon.minus-sm size="4" />
                </x-button.danger>
            @endunless
        </div>
    </div>
    @if ($errors->first('contact.*' ))
        <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first( 'contact.*' ) }}</div>
    @endif
</div>
