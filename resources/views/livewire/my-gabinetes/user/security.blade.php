<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('my_gabinetes.show') }}">{{trans_choice('Mi Gabinete|Mis Gabinetes', auth()->user()->gabinetes->count())}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('my_gabinetes.show') }}?showSubmenu=Users&gabineteSelectedId={{$gabinete->id}}">{{__($gabinete->name)}}</x-breadcumb.item>
                @if($subcontractor)
                    <!-- Subcontrata -->
                    <x-breadcumb.item link="{{ route('my_gabinetes.subcontractor.show', ['gabinete' => $subcontractor->gabinete->id, 'subcontractor' => $subcontractor->id]) }}?showSubmenu=Users">{{ __($subcontractor->name) }}</x-breadcumb.item>
                @endif
                <x-breadcumb.item>{{ __($user->full_name) }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <div class="space-y-4">

        <livewire:user.security :user="$user" :gabinete="$gabinete" />

        @can('password.update')
        <x-card.card>
            <x-card.body>
                <x-button.primary wire:click="resetPasswordAccount">{{__('Reset account and send a new password')}}</x-button.primary>
            </x-card.body>
        </x-card.card>
        @endcan

    </div>
</div>
