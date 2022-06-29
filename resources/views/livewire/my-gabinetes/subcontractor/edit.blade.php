<div>
    <x-layout.two-columns>
        <!-- title -->
        <x-slot name="title">
            {{ $subcontractor->name }}
        </x-slot>

        <!-- mobile menu -->
        <x-slot name="primary">
            <div class="pt-2 px-4 flex justify-between space-x-2">
                <x-button.header_menu :menu="'Data'" :showSubMenu="$showSubmenu">{{__('Datos')}}</x-button.header_menu>
                <x-button.header_menu :menu="'Users'" :showSubMenu="$showSubmenu">{{__('Users')}}</x-button.header_menu>
            </div>
        </x-slot>

        <!-- left side menu -->
        <x-slot name="secondary">
            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$gabinete->id . 'nav-area'">
                    <h3 class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400" id="expedient-headline">
                        {{ $subcontractor->name }}
                    </h3>
                    <x-administration.menu-item label="Datos" icon="document-text" name="Data" is-active="{{ $showSubmenu == 'Data' }}" />
                    <x-administration.menu-item label="Users" icon="users" name="Users" :badge="$subcontractor->users->count()" is-active="{{ $showSubmenu == 'Users' }}" />
                </div>
            </nav>
        </x-slot>


        <!-- main content -->
        <div class="p-4 w-full">
            @if($showSubmenu == 'Data')
                <livewire:my-gabinetes.subcontractor.data :subcontractor="$subcontractor" />
            @elseif($showSubmenu == 'Users')
                <livewire:my-gabinetes.subcontractor.users :subcontractor="$subcontractor" />
            @endif

        </div>
    </x-layout.two-columns>
</div>
