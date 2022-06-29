<div>
    <x-input.group for="addresses-existing-contact" label="Direcciones disponibles" borderless :error="$errors->first('address.*')">

        <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
            @forelse($person->addresses as $addressOption)
                <div class="flex px-4 py-3 space-x-2 {{($address->id ?? null) == $addressOption->id ? '' : 'opacity-50'}} {{ $loop->first ? '' : 'border-t border-gray-200' }}" wire:key="address{{$addressOption->id}}" selected="{{($address->id ?? null) == $addressOption->id}}">
                    <div wire:click="editAddress({{$addressOption->id}})">
                        <x-icon.pencil size="5" />
                    </div>
                    <div class="w-full" wire:click="selectAddress({{$addressOption->id}})">
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-600 {{($address->id ?? null) == $addressOption->id ? 'font-semibold' : ''}}">
                                @if($addressOption->name)
                                    <p >{{ $addressOption->name }}</p>
                                @endif
                                <p class="font-normal text-gray-500">
                                    {{ $addressOption->address }}
                                </p>
                            </div>
                            @if(($address->id ?? null) == $addressOption->id)
                                <svg class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @endif
                        </div>
                        <div class="mt-2 text-xs text-gray-600">
                            {{ $addressOption->full_city }}
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

            <div class="flex px-4 py-3 space-x-2 opacity-50 border-t border-gray-200" :key="'newaddress'"  wire:click="newAddress">
                <div>
                    <x-icon.plus size="5" />
                </div>
                <div class="w-full">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <p>{{ __('Nueva dirección') }}</p>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-600">
                        {{ __('Crear una nueva dirección para este contacto') }}
                    </div>
                </div>
            </div>
        </div>

    </x-input.group>

</div>
