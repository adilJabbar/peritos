<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Countries">{{__('Countries')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($country->name) }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header class="border-b border-gray-200">
            <h3>
                {{__('Datos del país')}}
            </h3>
        </x-card.header>
        <x-card.body>
            @include('livewire.administration.country.form-inputs')
        </x-card.body>
        <x-card.footer class="flex justify-end">
            <x-button.primary wire:click="saveData">{{__('Update')}}</x-button.primary>
        </x-card.footer>
    </x-card.card>
</div>
