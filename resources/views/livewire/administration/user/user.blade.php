<div>
    @can('administration')
        <x-layout.two-columns>
            <!-- title -->
            <x-slot name="title">
                {{ $user->full_name }}
            </x-slot>

            <!-- mobile menu -->
            <x-slot name="primary">
                <div class="pt-2 px-4 flex justify-between space-x-2">
                    <x-button.header_menu :menu="'personalData'" :showSubMenu="$showSubmenu">{{__('Datos personales')}}</x-button.header_menu>
                    <x-button.header_menu :menu="'Gabinetes'" :showSubMenu="$showSubmenu">{{__('Gabinetes')}}</x-button.header_menu>
                    <x-button.header_menu :menu="'Security'" :showSubMenu="$showSubmenu">{{__('Seguridad')}}</x-button.header_menu>
                    @if($user->hasRole('Technician'))
                        <x-button.header_menu :menu="'zipCoverage'" :showSubMenu="$showSubmenu">{{__('Zonas')}}</x-button.header_menu>
                    @endif
                </div>
            </x-slot>

            <!-- left side menu -->
            <x-slot name="secondary">
                <nav aria-label="Sidebar">
                    <div class="space-y-1" :key="$gabinete->id . 'nav-area'">
                        <h3 class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400" id="expedient-headline">
                            {{ $user->full_name }}
                        </h3>
                        <x-administration.menu-item label="Datos personales" icon="user" name="personalData" is-active="{{ $showSubmenu == 'personalData' }}" />
                        <x-administration.menu-item label="Gabinetes" icon="office-building" name="Gabinetes" badge="{{ $user->gabinetes->count() }}" is-active="{{ $showSubmenu == 'Gabinetes' }}" />
                        <x-administration.menu-item label="Seguridad" icon="shield-check" name="Security" is-active="{{ $showSubmenu == 'Security' }}" />
                        @if($user->hasRole('Technician'))
                            <x-administration.menu-item label="Zonas" icon="map" name="zipCoverage" is-active="{{ $showSubmenu == 'zipCoverage' }}" />
                        @endif
                    </div>
                </nav>
            </x-slot>


            <!-- main content -->
            <div class="p-4 w-full">
                @if($showSubmenu == 'personalData')
                    <livewire:administration.user.personal-data :user="$user" />
                @elseif($showSubmenu == 'Gabinetes')
                    <livewire:administration.user.gabinetes :user="$user" />
                @elseif($showSubmenu == 'Security')
                    <livewire:administration.user.security :user="$user" />
                @elseif($showSubmenu == 'zipCoverage')
                    <livewire:administration.user.zip-coverage :user="$user" />
                @endif

            </div>
        </x-layout.two-columns>

    @else
        <p>{{__('Este contenido está restringido')}}</p>
    @endcan
</div>




