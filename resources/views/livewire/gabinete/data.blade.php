<x-card.card class="divide-y divide-gray-200">
    <x-card.header>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            <strong>{{$gabinete->name}}</strong> · {{__('Datos de la empresa')}}
        </h3>
    </x-card.header>

    <x-card.body>
        <!-- Name -->
        <x-input.group label="Name" for="name" :error="$errors->first('gabinete.name')" borderless>
            <x-input.text wire:model="gabinete.name" id="name" placeholder="Name" :error="$errors->first('gabinete.name')" />
        </x-input.group>

        <x-input.group label="Legal name" for="legal_name" class="sm:pt-0" borderless :error="$errors->first('gabinete.legal_name')">
            <x-input.text wire:model.lazy="gabinete.legal_name" id="legal_name" :error="$errors->first('gabinete.legal_name')" placeholder="Legal name"/>
        </x-input.group>

        <x-input.group label="CIF" for="legal_id" class="sm:pt-0" borderless :error="$errors->first('gabinete.legal_id')">
            <x-input.text wire:model.lazy="gabinete.legal_id" id="legal_id" :error="$errors->first('gabinete.legal_id')" placeholder="CIF"/>
        </x-input.group>

        <!-- Address -->
        <x-input.group label="Address" for="address" :error="$errors->first('gabinete.address')">
            <x-input.text wire:model="gabinete.address" id="address" :error="$errors->first('gabinete.address')" placeholder="Address"/>
        </x-input.group>

        <x-input.group label=" " for="city" :error="$errors->first('gabinete.city')" borderless>
            <x-input.text wire:model="gabinete.city" id="city" :error="$errors->first('gabinete.city')" placeholder="City"/>
        </x-input.group>

        <x-input.group label=" " for="zip" borderless>
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                <x-input.text wire:model="gabinete.zip" id="zip" :error="$errors->first('gabinete.zip')" placeholder="Zip code"/>
                <x-input.text wire:model="gabinete.state" id="state" :error="$errors->first('gabinete.state')" placeholder="State"/>
            </div>
        </x-input.group>

        <x-input.group label="Country" for="country_id" :error="$errors->first('gabinete.country_id')" borderless>
            <x-input.select wire:model="gabinete.country_id" id="country_id" :error="$errors->first('gabinete.country_id')" placeholder="Select country">
                @foreach(\App\Models\Admin\Country::all() as $country)
                    <option value="{{$country->id}}">{{ $country->name }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>


        <x-input.group label="Phone" for="phone" :error="$errors->first('gabinete.phone')">
            <x-input.text wire:model="gabinete.phone" id="phone"  :error="$errors->first('gabinete.phone')" placeholder="Phone number"/>
        </x-input.group>
        <x-input.group label="Email address" for="email" :error="$errors->first('gabinete.email')" borderless>
            <x-input.text wire:model="gabinete.email" id="email" type="email" autocomplete="new-email" :error="$errors->first('gabinete.email')" placeholder="Email adress"/>
        </x-input.group>

        @can('gabinete.create')
            <x-input.group label="Status" for="is_active" :error="$errors->first('gabinete.is_active')">
                <x-input.checkbox wire:model.defer="gabinete.is_active" id="is_active" label="Activo" label-notes="Los usuarios de los gabinetes no activos no podrán iniciar sesión" />
            </x-input.group>
            <x-input.group label="Llamadas Salientes" for="caller_number" :error="$errors->first('gabinete.caller_number')" borderless>
                <x-input.text wire:model="gabinete.caller_number" id="caller_number" :error="$errors->first('gabinete.caller_number')" placeholder="Número para utilizar en llamadas salientes"/>
            </x-input.group>
        @endcan

        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200  sm:py-2">
            {{--                            <label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">--}}
            {{--                                {{ __( 'Logo' ) }}--}}
            {{--                            </label>--}}
            <div class="mt-1 sm:mt-0 sm:col-span-4">
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                    <x-input.group label="Logo" for="logo"  :error="$errors->first('logo')" inline no-shadow>

                        <x-input.file wire:model="logo" id="logo" button-below>
                            <div class="h-32 w-full bg-white text-gray-300 flex items-center">
                                @if($logo)
                                    <img class="max-h-32 mx-auto" src="{{ $logo->temporaryUrl() }}" alt="{{ __('Company Logo') }}">
                                @else
                                    <img class="max-h-32 mx-auto" src="{{ $gabinete->logo_url }}" alt="{{ __('Company Logo') }}">
                                @endif
                            </div>
                        </x-input.file>
                    </x-input.group>

                    <x-input.group label="Logo horizontal" for="logo_horiz"  :error="$errors->first('logo_horiz')" inline no-shadow>
                        <x-input.file wire:model="logo_horiz" id="logo_horiz" button-below>
                            <div class="h-32 w-full bg-white text-gray-300 flex items-center">
                                @if($logo_horiz)
                                    <img class="max-h-32 mx-auto" src="{{ $logo_horiz->temporaryUrl() }}" alt="{{ __('Company Logo Horizontal') }}">
                                @else
                                    <img class="max-h-32 mx-auto" src="{{ $gabinete->logo_horiz_url }}" alt="{{ __('Company Logo Horizontal') }}">
                                @endif
                            </div>
                        </x-input.file>
                    </x-input.group>

                    <x-input.group label="Icon" for="logo_icon"  :error="$errors->first('logo_icon')" inline no-shadow>
                        <x-input.file wire:model="logo_icon" id="logo_icon" button-below>
                            <div class="h-32 w-full bg-white text-gray-300 flex items-center">
                                @if($logo_icon)
                                    <img class="max-h-32 mx-auto" src="{{ $logo_icon->temporaryUrl() }}" alt="{{ __('Company Icon') }}">
                                @else
                                    <img class="max-h-32 mx-auto" src="{{ $gabinete->logo_icon_url }}" alt="{{ __('Company Icon') }}">
                                @endif
                            </div>
                        </x-input.file>
                    </x-input.group>

                </div>
            </div>
        </div>
    </x-card.body>
    @can('gabinete.update')
        <x-card.footer class="flex justify-end space-x-4">
            <x-button.secondary wire:click="createNewToken()">{{__('Crear y enviar un nuevo token')}}</x-button.secondary>
            <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
        </x-card.footer>
    @endcan
</x-card.card>
