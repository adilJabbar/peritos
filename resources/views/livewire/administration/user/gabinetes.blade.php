<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Users">{{__('Usuarios')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($user->full_name) }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Gabinetes') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <div class="space-y-4">

        <x-card.card class="divide-gray-200 divide-y">
            <x-card.body>
                @include('livewire.user.form-inputs-gabinetes', ['gabinetes' => $gabinetes->whereNotIn('id', $user->gabinetes->pluck('id'))])
            </x-card.body>
            @if($gabineteSelected)
                <x-card.footer class="flex justify-end space-x-4 bg-gray-50">
                    <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
                </x-card.footer>
            @endif
        </x-card.card>

        @forelse($user->gabinetes as $gabineteRow)
            <livewire:gabinete.user.relation :user="$user" :gabinete="$gabineteRow" wire:key="gabineteRelation{{$loop->index}}" />
        @empty
            <x-card.card>
                <x-card.body>
                    {{__('Este usuario no está asociado a ningún gabinete')}}
                </x-card.body>
            </x-card.card>
        @endforelse
    </div>
</div>
