<x-layouts.auth>

    <x-slot name="title">
        {{__('Sign in to your account')}}
    </x-slot>
    <x-slot name="background">
        {{asset('img/backgrounds/login.jpg')}}
    </x-slot>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <div class="mt-1">
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>
        </div>

        <div class="space-y-1">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <div class="mt-1">
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                    {{__('Remember me')}}
                </label>
            </div>

            <div class="text-sm">
                <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    {{__('Forgot your password?')}}
                </a>
            </div>
        </div>

        <div>
            <x-button.primary fullWidth="true" class="w-full justify-center py-2 px-4" type="submit">{{__('Sign in')}}</x-button.primary>
        </div>


    </form>


</x-layouts.auth>
