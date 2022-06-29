<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Users">{{__('Usuarios')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($user->full_name) }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Security') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <div class="space-y-4">

        <livewire:user.security :user="$user" />

        <x-card.card>
            <x-card.body>
                <x-button.primary wire:click="resetPasswordAccount">{{__('Reset account and send a new password')}}</x-button.primary>
            </x-card.body>
        </x-card.card>

    </div>
</div>
