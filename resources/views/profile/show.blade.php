<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="w-full overflow-auto">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 ">
            <x-card.card class="divide-gray-200 divide-y">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())

                <x-card.body>
                @livewire('profile.update-profile-information-form')
                </x-card.body>

            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <x-card.body>
                    @livewire('profile.update-password-form')
                </x-card.body>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <x-card.body>
                    @livewire('profile.two-factor-authentication-form')
                    </x-card.body>
            @endif

                <x-card.body>
                @livewire('profile.logout-other-browser-sessions-form')
                </x-card.body>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-card.body>
                    @livewire('profile.delete-user-form')
                </x-card.body>
            @endif
            </x-card.card>
        </div>
    </div>
</x-app-layout>
