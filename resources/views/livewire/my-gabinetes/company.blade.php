<div class="space-y-4">

    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('my_gabinetes.show') }}">{{trans_choice('Mi Gabinete|Mis Gabinetes', auth()->user()->gabinetes->count())}}</x-breadcumb.item>
                <x-breadcumb.item>{{__($gabinete->name)}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('my_gabinetes.show') }}?showSubmenu=Companies&gabineteSelectedId={{$gabinete->id}}">{{ __('Companies') }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($company->name) }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <div class="divide-gray-200 divide-y space-y-4">
        <livewire:my-gabinetes.company.edit :gabinete="$gabinete" :company="$company"/>
    </div>
</div>
