<div>
    <x-layout.two-columns>
    <x-slot name="title">
        {{__(':ramo en :country', ['ramo' => __($ramo->name), 'country' => __($ramo->country->name)])}}
    </x-slot>

    <x-slot name="primary">
        <div class="pt-2 px-2 flex justify-between space-x-2 overflow-auto">
            <x-button.header_menu :menu="''" :showSubMenu="$showSubmenu">{{__('Datos')}}</x-button.header_menu>
            <x-button.header_menu :menu="'Typecases'" :showSubMenu="$showSubmenu">{{__('Tipos de siniestros')}}</x-button.header_menu>
            <x-button.header_menu :menu="'Capitals'" :showSubMenu="$showSubmenu">{{__('Capitales')}}</x-button.header_menu>
        </div>
    </x-slot>

    <x-slot name="secondary">

        <nav aria-label="Sidebar">
            <div class="space-y-1" :key="$country->id . 'nav-area'">

                <h3  wire:click="$set('showSubmenu', '')" class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400 cursor-pointer" id="expedient-headline">
                    {{__(':ramo en :country', ['ramo' => __($ramo->name), 'country' => __($ramo->country->name)])}}
                </h3>
                <x-administration.menu-item label="Tipos de siniestros" icon="adjustments" name="Typecases" badge="{{ $ramo->typecases->count() }}" is-active="{{ $showSubmenu == 'Typecases' }}" />
                <x-administration.menu-item label="Capitales" icon="cash" name="Capitals" badge="{{ $ramo->capitals->count() }}" is-active="{{ $showSubmenu == 'Capitals' }}" />
            </div>
        </nav>

    </x-slot>
    <div class="p-4 space-y-4 w-full">
        <x-card.card class="divide-y divide-gray-200">
            <x-card.header>
                <x-breadcumb.simple>
                    <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                    <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                    <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Countries">{{__('Countries')}}</x-breadcumb.item>
                    <x-breadcumb.item link="{{ route('administration.country.show', ['country' => $ramo->country->id]) }}">{{ __($ramo->country->name) }}</x-breadcumb.item>
                    <x-breadcumb.item link="{{ route('administration.country.show', ['country' => $ramo->country->id]) }}?showSubmenu=Ramos">{{ __('Ramos') }}</x-breadcumb.item>
                    <x-breadcumb.item>{{ __($ramo->name) }}</x-breadcumb.item>
                </x-breadcumb.simple>
            </x-card.header>
        </x-card.card>

        @if($showSubmenu == '')
            @include('partials.ramo.ramo_data')
        @elseif($showSubmenu == 'Typecases')
            <livewire:ramo.typecases :ramo="$ramo" />
        @elseif($showSubmenu == 'Capitals')
            <livewire:ramo.capitals :ramo="$ramo" />
        @endif

    </div>



</x-layout.two-columns>
</div>
