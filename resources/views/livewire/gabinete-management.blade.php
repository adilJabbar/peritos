<x-layout.two-columns>
    <x-slot name="title">
        {{__('Gabinete')}}
    </x-slot>

    <x-slot name="primary">
        <div class="pt-2 px-4 flex justify-between space-x-2">
            <x-button.header_menu :menu="'personalData'" :showSubMenu="$showSubmenu">{{__('Datos personales')}}</x-button.header_menu>
            <x-button.header_menu :menu="'Gabinetes'" :showSubMenu="$showSubmenu">{{__('Gabinetes')}}</x-button.header_menu>
{{--            <x-button.header_menu :menu="'Security'" :showSubMenu="$showSubmenu">{{__('Security')}}</x-button.header_menu>--}}
            <x-button.header_menu :menu="'Security'" :showSubMenu="$showSubmenu">{{__('Seguridad')}}</x-button.header_menu>
        </div>
    </x-slot>

    <x-slot name="secondary">

        <div>
            <nav aria-label="Sidebar">
                <div class="space-y-4">
                    @forelse($gabinetes as $gabinete)
                        <div class="space-y-1" :key="$gabinete->id . 'nav-area'">

                            <h3 class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400" id="expedient-headline">
                                {{ $gabinete->name }}
                            </h3>

                            <x-administration.menu-item label="Datos del gabinete" name="{{ $name = $gabinete->id . 'Gabinete' }}" icon="office-building" is-active="{{ $showSubmenu == $name }}" />

                            <x-administration.menu-item label="Users" icon="users" name="{{ $name = $gabinete->id . 'Users' }}" badge="{{ $gabinete->users->count() }}" is-active="{{ $showSubmenu == $name }}" />

                            <x-administration.menu-item label="Siniestros" icon="clipboard-list"  name="{{ $name = $gabinete->id . 'Expedients' }}" badge="{{ $gabinete->expedients->count() }}" is-active="{{ $showSubmenu == $name }}" />

                            <x-administration.menu-item label="Reports Setup" icon="document-text" name="{{ $name = $gabinete->id . 'ReportsSetup' }}" is-active="{{ $showSubmenu == $name }}" />

                            <x-administration.menu-item label="Compañías" icon="collection" name="{{ $name = $gabinete->id . 'Companies' }}" is-active="{{ $showSubmenu == $name }}" badge="{{ $gabinete->companies->count() }}" />

                        </div>

                    @empty
                    @endforelse
                </div>


            </nav>
        </div>



    </x-slot>

    <div class="p-4">
        @forelse($gabinetes as $gabinete)

            @if($showSubmenu == $gabinete->id . 'Gabinete')
                <div class="space-y-4">
                    <x-card.card class="divide-y divide-gray-200">
                        <x-card.header>
                            <x-breadcumb.simple>
                                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                                <x-breadcumb.item link="{{ route('gabinete.show', ['gabinete' => 0]) }}">{{__('Gabinete')}}</x-breadcumb.item>
                                <x-breadcumb.item link="{{ route('gabinete.show', ['gabinete' => 0]) }}?showSubmenu={{$gabinete->id}}Gabinete" >{{ $gabinete->name }}</x-breadcumb.item>
                                <x-breadcumb.item>{{ __('Datos de la empresa') }}</x-breadcumb.item>
                            </x-breadcumb.simple>
                        </x-card.header>
                    </x-card.card>
                    <x-card.card class="divide-y divide-gray-200">
                        <x-card.header>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <strong>{{$gabinete->name}}</strong> · {{__('Datos de la empresa')}}
                            </h3>
                        </x-card.header>
                        <livewire:gabinete.data-inputs :gabinete="$gabinete" :key="$gabinete->id . '-data-input'"/>
                    </x-card.card>
                </div>
            @elseif ($showSubmenu == $gabinete->id . 'Users')
                <livewire:gabinete.users :gabinete="$gabinete" :key="$gabinete->id . '-table-users'" />
            @elseif($showSubmenu == $gabinete->id . 'Expedients')
                    <livewire:gabinete.expedients :gabinete="$gabinete" :key="$gabinete->id . '-table-expedients'" />
            @elseif($showSubmenu == $gabinete->id . 'ReportsSetup')
                    <livewire:gabinete.reports-setup :gabinete="$gabinete" :key="$gabinete->id . '-reports-setup'" />
            @elseif($showSubmenu == $gabinete->id . 'Companies')
                    <livewire:gabinete.companies :gabinete="$gabinete" :key="$gabinete->id . '-companies'" />
            @endif

        @empty
        @endforelse




    </div>
</x-layout.two-columns>
