<div>
    <x-layout.two-columns>
        <x-slot name="title">
            {{__($country->name)}}
        </x-slot>

        <x-slot name="primary">
            <div class="pt-2 px-2 flex justify-between space-x-2 overflow-auto">
                <x-button.header_menu :menu="''" :showSubMenu="$showSubmenu">{{__('Datos')}}</x-button.header_menu>
                <x-button.header_menu :menu="'DeprecationGroups'" :showSubMenu="$showSubmenu">{{__('Grupos de Depreciación')}}</x-button.header_menu>
                <x-button.header_menu :menu="'Ramos'" :showSubMenu="$showSubmenu">{{__('Ramos')}}</x-button.header_menu>
                <x-button.header_menu :menu="'States'" :showSubMenu="$showSubmenu">{{__('Provincias')}}</x-button.header_menu>
                <x-button.header_menu :menu="'Buildings'" :showSubMenu="$showSubmenu">{{__('Edificaciones')}}</x-button.header_menu>
            </div>
        </x-slot>

        <x-slot name="secondary">
            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$country->id . 'nav-area'">

                    <h3  wire:click="$set('showSubmenu', '')" class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400 cursor-pointer" id="expedient-headline">
                        {{ $country->name }}
                    </h3>
                    <x-administration.menu-item label="Grupos de Depreciación" icon="cash" name="DeprecationGroups" badge="{{ $country->deprecationgroups->count() }}" is-active="{{ $showSubmenu == 'DeprecationGroups' }}" />
                    <x-administration.menu-item label="Ramos" icon="office-building" name="Ramos" badge="{{ $country->ramos->count() }}" is-active="{{ $showSubmenu == 'Ramos' }}" />
                    <x-administration.menu-item label="Provincias" icon="puzzle" name="States" badge="{{ $country->states->count() }}" is-active="{{ $showSubmenu == 'States' }}" />
                    <x-administration.menu-item label="Edificaciones" icon="office-building" name="Buildings" badge="{{ $country->buildingTypes()->count() }}" is-active="{{ $showSubmenu == 'Buildings' }}" />
                </div>
            </nav>

        </x-slot>

        <div class="p-4 w-full">
            @if($showSubmenu == '')
                @include('partials.country.country_data')
            @elseif($showSubmenu == 'DeprecationGroups')
                <livewire:country.deprecation-groups :country="$country" />
            @elseif($showSubmenu == 'Ramos')
                <livewire:country.ramos :country="$country" />
            @elseif($showSubmenu == 'States')
                <livewire:country.states :country="$country" />
            @elseif($showSubmenu == 'Buildings')
                <livewire:country.buildings :country="$country" />
            @endif
        </div>

    </x-layout.two-columns>
</div>
