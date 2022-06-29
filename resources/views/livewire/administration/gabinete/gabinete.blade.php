<div>
    <x-layout.two-columns>
        <!-- title -->
        <x-slot name="title">
            {{ $gabinete->name }}
        </x-slot>

        <!-- mobile menu -->
        <x-slot name="primary">
            <div class="pt-2 px-4 flex justify-between space-x-2">
                <x-button.header_menu :menu="'data'" :showSubMenu="$showSubmenu">{{__('Datos del gabinete')}}</x-button.header_menu>
                <x-button.header_menu :menu="'users'" :showSubMenu="$showSubmenu">{{__('Usuarios')}}</x-button.header_menu>
                <x-button.header_menu :menu="'companies'" :showSubMenu="$showSubmenu">{{__('Compañías')}}</x-button.header_menu>
{{--                <x-button.header_menu :menu="'Security'" :showSubMenu="$showSubmenu">{{__('Seguridad')}}</x-button.header_menu>--}}
            </div>
        </x-slot>

        <!-- left side menu -->
        <x-slot name="secondary">
            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$gabinete->id . 'nav-area'">
                    <h3 class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400" id="expedient-headline">
                        {{ $gabinete->name }}
                    </h3>
                    <x-administration.menu-item label="Datos del gabinete" icon="office-building" name="data" is-active="{{ $showSubmenu == 'data' }}" />
                    <x-administration.menu-item label="users" icon="users" name="users" badge="{{ $gabinete->users->count() }}" is-active="{{ $showSubmenu == 'users' }}" />
                    <x-administration.menu-item label="companies" icon="collection" name="users" badge="{{ $gabinete->companies->count() }}" is-active="{{ $showSubmenu == 'companies' }}" />
                </div>
            </nav>
        </x-slot>

        <!-- main content -->
        <div class="p-4 w-full">
            @if($showSubmenu == 'data')
                <livewire:administration.gabinete.data :gabinete="$gabinete" />
            @elseif($showSubmenu == 'users')
                <livewire:administration.gabinete.users :gabinete="$gabinete" />
            @endif

        </div>
    </x-layout.two-columns>

</div>
