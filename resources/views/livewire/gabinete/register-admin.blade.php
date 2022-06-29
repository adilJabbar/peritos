<div>
    <x-slot name="title">
        {{ $gabinete->name }}
    </x-slot>

    <x-slot name="subtitle">
        {{__('Crea tu usuario principal')}}
    </x-slot>

    <x-slot name="background">
        {{asset('img/backgrounds/login.jpg')}}
    </x-slot>

    <form wire:submit.prevent="save">
        @csrf
        <input type="hidden" name="token" value="{{$gabinete->token_expires}}" />
        <div class="space-y-4">

            <x-input.group for="name" label="{{ __('Name') }}" inline :error="$errors->first('user.name')">
                <x-input.text wire:model.lazy="user.name" id="name" required autofocus autocomplete="name" />
            </x-input.group>

            <x-input.group for="last_name" label="{{ __('Last name') }}" inline :error="$errors->first('user.last_name')">
                <x-input.text wire:model.lazy="user.last_name" id="last_name" autocomplete="last_name" />
            </x-input.group>

            <x-input.group for="email" label="{{ __('Email Address') }}" inline :error="$errors->first('user.email')">
                <x-input.text wire:model="user.email" id="email" autocomplete="email" />
            </x-input.group>

            <x-input.group for="password" label="{{ __('Password') }}" inline :error="$errors->first('password')">
                <x-input.text wire:model.lazy="password" type="password" id="password" />
            </x-input.group>

            <x-input.group for="passwordConfirmation" label="{{ __('Confirm Password') }}" inline>
                <x-input.text wire:model.lazy="passwordConfirmation" type="password" id="passwordConfirmation" />
            </x-input.group>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div>
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox wire:model.lazy="terms" name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('privacy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                    @if ($errors->first('terms'))
                        <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('terms') }}</div>
                    @endif

                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>

        </div>
    </form>

</div>
