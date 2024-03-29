<nav aria-label="Sidebar" class="hidden md:block md:flex-shrink-0 md:bg-gray-800 md:overflow-y-auto">
    <div class="relative w-20 flex flex-col p-3 space-y-3">


        <x-button.side-bar-button :active="request()->routeIs('dashboard.*')" placeholder="Dashboard"
                                  :url="route('dashboard.index')">
            <x-icon.template/>
        </x-button.side-bar-button>

        <x-button.side-bar-button :active="request()->routeIs('expedient.*')" placeholder="Siniestro"
                                  :url="route('expedient.index')">
            <x-icon.clipboard-list/>
        </x-button.side-bar-button>

        <x-button.side-bar-button :active="request()->routeIs('calendar.*')" placeholder="Calendario"
                                  :url="route('calendar.index')">
            <x-icon.calendar/>
        </x-button.side-bar-button>

        <x-button.side-bar-button :active="request()->routeIs('my_gabinetes.*')" placeholder="Gabinete"
                                  :url="route('my_gabinetes.show')">
            <x-icon.office-building/>
        </x-button.side-bar-button>

        <x-button.side-bar-button :active="request()->routeIs('gabinete.contact.*')" placeholder="Gabinete"
                                  :url="route('gabinete.contact.index')">
            <x-icon.shopping-cart/>
        </x-button.side-bar-button>
        {{--        <a href="#" class="bg-gray-900 text-white flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">--}}
        {{--            <span class="sr-only">Open</span>--}}
        {{--            <svg class="h-6 w-6" x-description="Heroicon name: outline/inbox" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>--}}
        {{--            </svg>--}}
        {{--        </a>--}}

        {{--        <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">--}}
        {{--            <span class="sr-only">Archive</span>--}}
        {{--            <svg class="h-6 w-6" x-description="Heroicon name: outline/archive" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>--}}
        {{--            </svg>--}}
        {{--        </a>--}}

        {{--        <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">--}}
        {{--            <span class="sr-only">Customers</span>--}}
        {{--            <svg class="h-6 w-6" x-description="Heroicon name: outline/user-circle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>--}}
        {{--            </svg>--}}
        {{--        </a>--}}

        {{--        <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">--}}
        {{--            <span class="sr-only">Flagged</span>--}}
        {{--            <svg class="h-6 w-6" x-description="Heroicon name: outline/flag" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>--}}
        {{--            </svg>--}}
        {{--        </a>--}}

        {{--        <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">--}}
        {{--            <span class="sr-only">Spam</span>--}}
        {{--            <svg class="h-6 w-6" x-description="Heroicon name: outline/ban" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>--}}
        {{--            </svg>--}}
        {{--        </a>--}}

        {{--        <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">--}}
        {{--            <span class="sr-only">Drafts</span>--}}
        {{--            <svg class="h-6 w-6" x-description="Heroicon name: outline/pencil-alt" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>--}}
        {{--            </svg>--}}
        {{--        </a>--}}
        @can('administration')
            <x-button.side-bar-button :active="request()->routeIs('administration.*')" placeholder="Administración"
                                      :url="route('administration.index')">
                <x-icon.cog/>
            </x-button.side-bar-button>
        @endcan

    </div>
</nav>
