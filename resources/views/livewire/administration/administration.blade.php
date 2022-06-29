<div>
    @can('administration')
        <x-layout.two-columns>
        <x-slot name="title">
            {{__('Administración')}}
        </x-slot>

            <x-slot name="primary">
                <div class="pt-2 px-2 flex justify-between space-x-2 overflow-auto">
                    <x-button.header_menu :menu="'Gabinetes'" :showSubMenu="$showSubmenu">{{__('Gabinetes')}}</x-button.header_menu>
                    <x-button.header_menu :menu="'Users'" :showSubMenu="$showSubmenu">{{__('Users')}}</x-button.header_menu>
                    <x-button.header_menu :menu="'Siniestros'" :showSubMenu="$showSubmenu">{{__('Siniestros')}}</x-button.header_menu>
                    <x-button.header_menu :menu="'DataManagement'" :showSubMenu="$showSubmenu">{{__('DataManagement')}}</x-button.header_menu>
                </div>
                @if($showSubmenu === 'DataManagement')
                    <div class="pt-2 px-2 flex justify-between space-x-2 overflow-auto">
                        <x-button.header_menu :menu="'Companies'" :showSubMenu="$showSubmenu">{{__('Compañías Aseguradoras')}}</x-button.header_menu>
                        <x-button.header_menu :menu="'Products'" :showSubMenu="$showSubmenu">{{__('Condicionados por Defecto')}}</x-button.header_menu>
                        <x-button.header_menu :menu="'Countries'" :showSubMenu="$showSubmenu">{{__('Countries')}}</x-button.header_menu>
                        <x-button.header_menu :menu="'Currency'" :showSubMenu="$showSubmenu">{{__('Currencies')}}</x-button.header_menu>
                        <x-button.header_menu :menu="'destiny'" :showSubMenu="$showSubmenu">{{__('Tipos de propuesta')}}</x-button.header_menu>
                        <x-button.header_menu :menu="'statuses'" :showSubMenu="$showSubmenu">{{__('Estados')}}</x-button.header_menu>
                        <x-button.header_menu :menu="'reports'" :showSubMenu="$showSubmenu">{{__('Plantillas')}}</x-button.header_menu>
                    </div>
                @endif
            </x-slot>

        <x-slot name="secondary">

            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$gabinete->id . 'nav-area'">

                    <h3 class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400" id="expedient-headline">
                        {{ __('Administración') }}
                    </h3>
                    <x-administration.menu-item label="Gabinetes" icon="office-building" name="Gabinetes" badge="{{ $gabinetes }}" is-active="{{ $showSubmenu == 'Gabinetes' }}" />
                    <x-administration.menu-item label="Users" icon="users" name="Users" badge="{{ $users }}" is-active="{{ $showSubmenu == 'Users' }}" />
                    <x-administration.menu-item label="Siniestros" name="Siniestros" icon="clipboard-list"  is-active="{{ $showSubmenu == 'Expedients' }}" />

                    <h3 class="p-3 text-xs font-semibold text-white uppercase tracking-wider bg-gray-400"
                        id="texhnical-zone-headline">
                        {{ __('Gestión de datos') }}
                    </h3>
                    <x-administration.menu-item label="Compañías Aseguradoras" name="Companies" icon="collection"  is-active="{{ $showSubmenu == 'Companies' }}" />
                    <x-administration.menu-item label="Condicionados por Defecto" name="Products" icon="document-text"  is-active="{{ $showSubmenu == 'Products' }}" />
                    <x-administration.menu-item label="Countries" icon="map" name="Countries" is-active="{{ $showSubmenu == 'Countries' }}" />
                    <x-administration.menu-item label="Currencies" icon="currency-dollar" name="Currency" is-active="{{ $showSubmenu == 'Currency' }}" />
                    <x-administration.menu-item label="Tipos de propuesta" icon="cash" name="destiny" is-active="{{ $showSubmenu == 'destiny' }}" />
                    <x-administration.menu-item label="Estados" icon="color-swatch" name="statuses" is-active="{{ $showSubmenu == 'statuses' }}" />
                    <x-administration.menu-item label="Plantillas" icon="document-duplicate" name="reports" is-active="{{ $showSubmenu == 'reports' }}" />

                </div>
            </nav>
        </x-slot>

        <div class="p-4 w-full">
            @if($showSubmenu == 'Gabinetes')
                <livewire:administration.gabinetes />
            @elseif($showSubmenu == 'Users')
                <livewire:administration.users />
            @elseif($showSubmenu == 'User.show')
                <livewire:administration.user.user :user="$selector" />
            @elseif($showSubmenu == 'Expedients')
                <span>Siniestros</span>
            @elseif($showSubmenu == 'Companies')
                <livewire:administration.companies />
            @elseif($showSubmenu == 'Products')
                <livewire:administration.default-products />
            @elseif($showSubmenu == 'Countries')
                <livewire:administration.countries />
            @elseif($showSubmenu == 'Currency')
                <livewire:administration.currencies />
            @elseif($showSubmenu == 'destiny')
                <livewire:administration.destinies />
            @elseif($showSubmenu == 'statuses')
                <livewire:administration.statuses />
            @elseif($showSubmenu == 'reports')
                <livewire:administration.reports />
            @endif


        </div>
    </x-layout.two-columns>

    @else
        <p>{{__('Este contenido está restringido')}}</p>
    @endcan
</div>
