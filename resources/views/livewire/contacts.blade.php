<x-layout.two-columns>
    <x-slot name="title">
        {{__('Contacts')}}
    </x-slot>

    <!-- mobile menu -->
    <x-slot name="primary">
    </x-slot>

    <x-slot name="secondary">
        <div>
            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$gabinete->id . 'nav-area'">

                    <h3 class="p-3 text-xs font-semibold text-white uppercase tracking-wider bg-gray-400"
                        id="projects-headline">
                        {{ __('Contacts')  }}
                    </h3>

                    <x-administration.menu-item label="Contact calls" icon="user" name="Contact calls" onclick="window.location.href='{{ route('contacts.index',['showSubmenu'=>'Contact calls']) }}'"
                                                is-active="{{ $showSubmenu == 'Contact calls' }}" badge=""/>
                    <x-administration.menu-item label="Contact visitors" icon="users" name="Contact visitors" onclick="window.location.href='{{ route('contacts.index',['showSubmenu'=>'Contact visitors']) }}'"
                                                is-active="{{ $showSubmenu == 'Contact visitors' }}" badge=""/>

                </div>
            </nav>
        </div>

    </x-slot>

    <div class="p-4 space-y-4 w-full">
        <x-card.card class="divide-y divide-gray-200">
            <x-card.header>
                <x-breadcumb.simple>
                    <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}">
                        <x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid/>
                    </x-breadcumb.item>
                    <x-breadcumb.item>{{ auth()->user()->full_name }}</x-breadcumb.item>
                    <x-breadcumb.item>{{ __($showSubmenu) }}</x-breadcumb.item>
                </x-breadcumb.simple>
            </x-card.header>
        </x-card.card>

        @include('livewire.contacts.table', ['showGabinete' => ($showSubmenu === 'Contact calls')])

    </div>
</x-layout.two-columns>
