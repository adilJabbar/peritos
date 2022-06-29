<!-- Gabinete modal -->
<form wire:submit.prevent="saveNewGabinete">
    <x-modal.dialog wire:model.defer="showEditModal" class="w-full max-h-full overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{__('Gabinete')}}
            </h3>
            <x-button.close wire:click="$set('showEditModal', false)" />
        </x-slot>

        <x-slot name="content">

            <!-- name -->
            <x-input.group label="Name" for="name" :error="$errors->first('newGabinete.name')" borderless>
                <x-input.text wire:model.lazy="newGabinete.name" id="name" placeholder="Name" :error="$errors->first('newGabinete.name')" />
            </x-input.group>

            <!-- legal_name -->
            <x-input.group label="Legal name" for="legal_name" class="sm:pt-0" borderless :error="$errors->first('newGabinete.legal_name')">
                <x-input.text wire:model.lazy="newGabinete.legal_name" id="legal_name" :error="$errors->first('newGabinete.legal_name')" placeholder="Legal name"/>
            </x-input.group>

            <!-- cif -->
            <x-input.group label="CIF" for="cif" class="sm:pt-0" borderless :error="$errors->first('newGabinete.cif')">
                <x-input.text wire:model.lazy="newGabinete.legal_id" id="cif" :error="$errors->first('newGabinete.cif')" placeholder="CIF"/>
            </x-input.group>

            <!-- address -->
            <x-input.group label="Address" for="address" :error="$errors->first('newGabinete.address')">
                <x-input.text wire:model.lazy="newGabinete.address" id="address" :error="$errors->first('newGabinete.address')" placeholder="Address"/>
            </x-input.group>

            <!-- city -->
            <x-input.group label=" " for="city" :error="$errors->first('newGabinete.city')" borderless>
                <x-input.text wire:model.lazy="newGabinete.city" id="city" :error="$errors->first('newGabinete.city')" placeholder="City"/>
            </x-input.group>

            <x-input.group label=" " for="zip" borderless>
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                    <!-- zip -->
                    <x-input.text wire:model.lazy="newGabinete.zip" id="zip" :error="$errors->first('newGabinete.zip')" placeholder="Zip code"/>
                    <!-- state -->
                    <x-input.text wire:model.lazy="newGabinete.state" id="state" :error="$errors->first('newGabinete.state')" placeholder="State"/>
                </div>
            </x-input.group>

            <!-- country_id -->
            <x-input.group label="Country" for="country_id" :error="$errors->first('newGabinete.country_id')" borderless>
                <x-input.select wire:model="newGabinete.country_id" id="country_id" :error="$errors->first('newGabinete.country_id')" placeholder="Select country">
                    @foreach(\App\Models\Admin\Country::all() as $country)
                        <option value="{{$country->id}}">{{ $country->name }}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>

            <!-- phone -->
            <x-input.group label="Phone" for="phone" :error="$errors->first('newGabinete.phone')">
                <x-input.text wire:model="newGabinete.phone" id="phone"  :error="$errors->first('newGabinete.phone')" placeholder="Phone number"/>
            </x-input.group>

            <!-- email -->
            <x-input.group label="Email address" for="email" :error="$errors->first('newGabinete.email')" borderless>
                <x-input.text wire:model="newGabinete.email" id="email" type="email" autocomplete="new-email" :error="$errors->first('newGabinete.email')" placeholder="Email adress"/>
            </x-input.group>

            <!-- is_active -->
            <x-input.group label="Status" for="is_active" :error="$errors->first('newGabinete.is_active')">
                <x-input.checkbox wire:model.defer="newGabinete.is_active" id="is_active" label="Activo" label-notes="Los usuarios de los gabinetes no activos no podrán iniciar sesión" />
            </x-input.group>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200  sm:py-2">
                <div class="mt-1 sm:mt-0 sm:col-span-4">
                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                        <x-input.group label="Logo" for="logo"  :error="$errors->first('logo')" inline no-shadow>

                            <!-- logo -->
                            <x-input.file wire:model="logo" id="logo" button-below>
                                <div class="h-32 w-full bg-white text-gray-300 flex items-center">
                                    @if($logo)
                                        <img class="max-h-32 mx-auto" src="{{ $logo->temporaryUrl() }}" alt="{{ __('Company Logo') }}">
                                    @else
                                        <img class="max-h-32 mx-auto" src="{{ $newGabinete->logo_url }}" alt="{{ __('Company Logo') }}">
                                    @endif
                                </div>
                            </x-input.file>
                        </x-input.group>

                        <!-- logo_horiz -->
                        <x-input.group label="Logo horizontal" for="logo_horiz"  :error="$errors->first('logo_horiz')" inline no-shadow>
                            <x-input.file wire:model="logo_horiz" id="logo_horiz" button-below>
                                <div class="h-32 w-full bg-white text-gray-300 flex items-center">
                                    @if($logo_horiz)
                                        <img class="max-h-32 mx-auto" src="{{ $logo_horiz->temporaryUrl() }}" alt="{{ __('Company Logo Horizontal') }}">
                                    @else
                                        <img class="max-h-32 mx-auto" src="{{ $newGabinete->logo_horiz_url }}" alt="{{ __('Company Logo Horizontal') }}">
                                    @endif
                                </div>
                            </x-input.file>
                        </x-input.group>

                        <!-- logo_icon -->
                        <x-input.group label="Icon" for="logo_icon"  :error="$errors->first('logo_icon')" inline no-shadow>
                            <x-input.file wire:model="logo_icon" id="logo_icon" button-below>
                                <div class="h-32 w-full bg-white text-gray-300 flex items-center">
                                    @if($logo_icon)
                                        <img class="max-h-32 mx-auto" src="{{ $logo_icon->temporaryUrl() }}" alt="{{ __('Company Icon') }}">
                                    @else
                                        <img class="max-h-32 mx-auto" src="{{ $newGabinete->logo_icon_url }}" alt="{{ __('Company Icon') }}">
                                    @endif
                                </div>
                            </x-input.file>
                        </x-input.group>

                    </div>
                </div>
            </div>


        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
{{--                <div>--}}
{{--                    <x-button.secondary wire:click="createNewToken()">{{__('Crear un nuevo token')}}</x-button.secondary>--}}
{{--                </div>--}}
                <div>
                    @can('newGabinete.update')
                        {{--                        <x-notification.inline notification="notify-saved">{{__('¡¡ Guardado !!')}}</x-notification.inline>--}}
                        <x-button.secondary wire:click="$set('showEditModal', false)">{{__('Cancel')}}</x-button.secondary>
                        <x-button.primary type="submit">{{__('Save')}}</x-button.primary>
                    @else
                        <x-button.secondary wire:click="$set('showEditModal', false)">{{__('Cerrar')}}</x-button.secondary>
                    @endcan
                </div>
            </div>

        </x-slot>

    </x-modal.dialog>
</form>
