<x-card.card class="divide-y divide-gray-200">

    <x-card.header>
        <h3>{{__('Datos personales')}}</h3>
    </x-card.header>

    <x-card.body>
        <x-input.group label="Name" for="name" :error="$errors->first('user.name')" borderless>
            <x-input.text wire:model.lazy="user.name" id="name" placeholder="Name" :error="$errors->first('user.name')" />
        </x-input.group>

        <x-input.group label="Last name" for="last_name" class="sm:pt-0" borderless :error="$errors->first('user.last_name')">
            <x-input.text wire:model.lazy="user.last_name" id="last_name" :error="$errors->first('user.last_name')" placeholder="Last name"/>
        </x-input.group>

        <x-input.group label="Email address" for="email" :error="$errors->first('user.email')">
            <x-input.text wire:model="user.email" id="email" type="email" autocomplete="new-email" :error="$errors->first('user.email')" placeholder="Email address"/>
        </x-input.group>

        {{--        <x-input.group label="Birthday" for="birthday" :error="$errors->first('user.birthday')">--}}
        {{--            <x-input.text type="date" id="birthday" wire:model.defer="user.birthday" />--}}
        {{--        </x-input.group>--}}

        <x-input.group label="Language" for="languageSelect" :error="$errors->first('user.language')">
            <x-input.select wire:model="user.language" placeholder="Selecciona el idioma...">
                @foreach(config('app.languages') as $key => $value)
                    <option value="{{$key}}">{{ __($value) }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group label="Country" for="country" :error="$errors->first('user.country_id')" borderless>
            <x-input.select wire:model="user.country_id" placeholder="Selecciona el pais de residencia..." id="country">
                @foreach(App\Models\Admin\Country::all() as $country)
                    <option value="{{$country->id}}">{{ __($country->name) }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>
        <x-input.group label="Status" for="is_active" :error="$errors->first('user.is_active')">
            <x-input.checkbox wire:model.defer="user.is_active" id="is_active" label="Activo" label-notes="Los usuarios inactivos no podrán iniciar sesión" />
        </x-input.group>

        <x-input.group label="Avatar" for="avatar"  :error="$errors->first('photoUpload')">
            <x-input.file wire:model="photoUpload" id="avatar" accept="image/png, image/gif, image/jpeg" >
                        <span class="inline-block max-w-sm rounded-full overflow-hidden bg-gray-100">
                            @if($photoUpload)
                                <img class="h-32" src="{{ $photoUpload->temporaryUrl() }}" alt="{{ __('Profile Photo') }}">
                            @else
                                <img class="h-32" src="{{ $user->profile_photo_url }}" alt="{{ __('Profile Photo') }}">
                            @endif

                        </span>
            </x-input.file>
        </x-input.group>

        <x-input.group label="Firma" for="signatureUpload"  :error="$errors->first('signatureUpload')">
            <x-input.file wire:model="signatureUpload" id="signatureUpload" accept="image/png, image/gif, image/jpeg" >
                        <span class="inline-block h-24 overflow-hidden bg-gray-100">
                            @if($signatureUpload)
                                <img class="h-full" src="{{ $signatureUpload->temporaryUrl() }}" alt="{{ __('Firma') }}">
                            @else
                                {{--                    <img src="{{ $user->profile_photo_url }}" alt="{{ __('Profile Photo') }}">--}}
                            @endif

                        </span>
            </x-input.file>
        </x-input.group>

    </x-card.body>
    @if(auth()->user()->can('user.update') || auth()->user()->id === $user->id)
        <x-card.footer class="flex justify-end space-x-4">
            <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
        </x-card.footer>
    @endif
</x-card.card>
