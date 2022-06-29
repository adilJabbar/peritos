<div>
    <x-layout.two-columns>
        <!-- title -->
        <x-slot name="title">
            {{ $user->full_name }}
        </x-slot>

        <!-- mobile menu -->
        <x-slot name="primary">
            <div class="pt-2 px-4 flex justify-between space-x-2">
                <x-button.header_menu :menu="'personalData'" :showSubMenu="$showSubmenu">{{__('Datos personales')}}</x-button.header_menu>
                @if(auth()->user()->can('roles.update'))
                    <x-button.header_menu :menu="'Security'" :showSubMenu="$showSubmenu">{{__('Seguridad')}}</x-button.header_menu>
                @endif
                @if(auth()->user()->can('employee.update'))
                    <x-button.header_menu :menu="'Setup'" :showSubMenu="$showSubmenu">{{__('Configuración')}}</x-button.header_menu>
                @endif
                @if($user->hasRole('Technician'))
                    <x-button.header_menu :menu="'zipCoverage'" :showSubMenu="$showSubmenu">{{__('Zonas')}}</x-button.header_menu>
                @endif
            </div>
        </x-slot>

        <!-- left side menu -->
        <x-slot name="secondary">
            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$gabinete->id . 'nav-area'">
                    <div class="p-3 font-semibold text-white bg-gray-400">
                        <h3 class="uppercase tracking-wider" id="expedient-headline">
                            <div>{{ $user->full_name }}</div>
                        </h3>
                        <span class="text-sm" id="expedient-headline-2">
                            @if($subcontractor)
                                ({{$subcontractor->name}})
                            @endif
                        </span>

                    </div>
                    <x-administration.menu-item label="Datos personales" icon="user" name="personalData" is-active="{{ $showSubmenu == 'personalData' }}" />
                    @if(auth()->user()->can('roles.update'))
                    <x-administration.menu-item label="Seguridad" icon="shield-check" name="Security" is-active="{{ $showSubmenu == 'Security' }}" />
                    @endif

                    @if(auth()->user()->can('employee.update'))
                        <x-administration.menu-item label="Configuración" icon="adjustments" name="Setup" is-active="{{ $showSubmenu == 'Setup' }}" />
                    @endif
                    @if($user->hasRole('Technician'))
                        <x-administration.menu-item label="Zonas" icon="map" name="zipCoverage" :badge="$user->zipCoverages->count()" is-active="{{ $showSubmenu == 'zipCoverage' }}" />
                    @endif
                </div>
            </nav>
        </x-slot>


        <!-- main content -->
        <div class="p-4 w-full">
            @if($showSubmenu == 'personalData')
                <livewire:my-gabinetes.user.personal-data :user="$user" :gabinete="$gabinete" :subcontractor="$subcontractor" />
            @elseif($showSubmenu == 'Security' && auth()->user()->can('roles.update'))
                <livewire:my-gabinetes.user.security :user="$user" :gabinete="$gabinete" :subcontractor="$subcontractor" />
            @elseif($showSubmenu == 'Setup' && auth()->user()->can('employee.update'))
                <livewire:my-gabinetes.user.setup :user="$user" :gabinete="$gabinete" :subcontractor="$subcontractor" />
            @elseif($showSubmenu == 'zipCoverage')
                <livewire:my-gabinetes.user.zip-coverage :user="$user" :gabinete="$gabinete" :subcontractor="$subcontractor" />
            @endif

        </div>
    </x-layout.two-columns>
</div>
