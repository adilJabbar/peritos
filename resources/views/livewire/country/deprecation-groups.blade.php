<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Countries">{{__('Countries')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($country->name) }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Grupos de depreciación') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            {{__('Grupos de depreciación')}}
        </x-card.header>
        <x-card.body class="space-y-4" wire:key="capital-table">
            <x-input.group for="country-deprecationgroups" borderless inline>
                <div class="space-y-2">
                    <livewire:administration.deprecationgroup.table :country="$country" :key="'countrySelected' . $country->id" />
                </div>
            </x-input.group>
        </x-card.body>
    </x-card.card>
</div>
