<div x-show="open" class="fixed inset-0 z-40" style="display: none;">
    <div @click="open = false" x-show="open" x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state." x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="hidden sm:block sm:fixed sm:inset-0 md:hidden" aria-hidden="true" style="display: none;">
        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
    </div>


    <nav x-show="open" x-transition:enter="transition ease-out duration-150 sm:ease-in-out sm:duration-300" x-transition:enter-start="transform opacity-0 scale-110 sm:translate-x-full sm:scale-100 sm:opacity-100" x-transition:enter-end="transform opacity-100 scale-100  sm:translate-x-0 sm:scale-100 sm:opacity-100" x-transition:leave="transition ease-in duration-150 sm:ease-in-out sm:duration-300" x-transition:leave-start="transform opacity-100 scale-100 sm:translate-x-0 sm:scale-100 sm:opacity-100" x-transition:leave-end="transform opacity-0 scale-110  sm:translate-x-full sm:scale-100 sm:opacity-100" x-description="Mobile menu, toggle classes based on menu state." x-state:on="Menu open" x-state:off="Menu closed" class="fixed z-40 inset-0 h-full w-full bg-white sm:inset-y-0 sm:left-auto sm:right-0 sm:max-w-sm sm:w-full sm:shadow-lg md:hidden" aria-label="Global" style="display: none;">
        <div class="h-16 flex items-center justify-between px-4 sm:px-6">
            <x-branding.square-logo-dark />

            <button type="button" @click="open = !open" class="-mr-2 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-600" x-bind:aria-expanded="open">
                <span class="sr-only">{{__('Open main menu')}}</span>
                <x-icon.x />
            </button>
        </div>
        <div class="mt-2 max-w-8xl mx-auto px-4 sm:px-6">
            <div class="relative text-gray-400 focus-within:text-gray-500">
                <label for="search" class="sr-only">{{__('Search all inboxes')}} </label>
                <input id="search" type="search" placeholder="{{__('Search')}}..." class="block w-full border-gray-300 rounded-md pl-10 placeholder-gray-500 focus:border-indigo-600 focus:ring-indigo-600">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center pl-3">
                    <x-icon.search solid="true" size="5"/>
                </div>
            </div>
        </div>
        <div class="max-w-8xl mx-auto py-3 px-2 sm:px-4">

            <a href="#" class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100">{{__('Mis siniestros')}}</a>

            <a href="#" class="block rounded-md py-2 pl-5 pr-3 text-base font-medium text-gray-500 hover:bg-gray-100">{{__('Atrasados')}}</a>

            <a href="#" class="block rounded-md py-2 pl-5 pr-3 text-base font-medium text-gray-500 hover:bg-gray-100">{{__('En plazo')}}</a>


            <a href="#" class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100">{{__('Mis tareas')}}</a>


            <a href="#" class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100">{{__('Settings')}}</a>


        </div>
        <div class="border-t border-gray-200 pt-4 pb-3">
            <div class="max-w-8xl mx-auto px-4 flex items-center sm:px-6">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" />
                </div>
                <div class="ml-3 min-w-0 flex-1">
                    <div class="text-base font-medium text-gray-800 truncate">{{ auth()->user()->full_name }}</div>
                    <div class="text-sm font-medium text-gray-500 truncate">{{ auth()->user()->email }}</div>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="#" class="ml-auto flex-shrink-0 bg-white p-2 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">{{__('View notifications')}}</span>
                        <x-icon.bell />
                    </a>
                    <livewire:layout.menu.language-selector />
                </div>
            </div>
            <div class="mt-3 max-w-8xl mx-auto px-2 space-y-1 sm:px-4">

                <a href="{{ route('profile.show') }}" class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-50">{{ __('Profile') }}</a>



                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-50">{{ __('Logout') }}</a>
                </form>

            </div>
        </div>
    </nav>

</div>
