<div class="ml-10 pr-4 flex-shrink-0 flex items-center space-x-10">
    <nav aria-label="Global" class="flex space-x-10">
        <a href="#" class="text-sm font-medium text-gray-900">{{__('Mis siniestros')}}</a>
        <a href="#" class="text-sm font-medium text-gray-900">{{__('Mis tareas')}}</a>
    </nav>
    <div class="flex items-center space-x-8">
        <div class="flex items-center space-x-3">
            <span class="inline-flex">
                <a href="#" class="-mx-1 bg-white p-1 rounded-full text-gray-400 hover:text-gray-500">
                    <span class="sr-only">{{__('View notifications')}}</span>
                    <x-icon.bell />
                </a>
            </span>

            <livewire:layout.menu.language-selector />
        </div>

        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative inline-block text-left">
            <button type="button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600" id="menu-1" @click="open = !open" aria-haspopup="true" x-bind:aria-expanded="open">
                <span class="sr-only">{{__('Open user menu')}}</span>
                <img class="h-8 w-8 rounded-full object-cover" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" />
            </button>

            <div x-show="open" x-description="Dropdown menu, show/hide based on menu state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute z-30 right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-1" style="display: none;">
                <div class="py-1">
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100" role="menuitem">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100" role="menuitem">
                            {{ __('Logout') }}
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
