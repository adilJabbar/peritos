<x-layout.two-columns>
    <x-slot name="title">
        {{__('Calendar')}}
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
                        {{ __('Calendar')  }}
                    </h3>

                    <x-administration.menu-item label="My Calendar" icon="document-text" name="My Calendar" onclick="window.location.href='{{ route('calendar.index',['showSubmenu'=>'My Calendar']) }}'" is-active="{{ $showSubmenu == 'My Calendar' }}" badge=""/>
                    @if($showSubmenu == 'My Calendar')
                        <ul role="list" class="p-3 grid grid-cols-1 gap-1">
                            <li class="col-span-1 flex shadow-sm rounded-md">
                                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-pink-600 text-white text-sm font-medium rounded-l-md"><x-icon.truck size="5" solid /></div>
                                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                                    <div class="flex-1 px-4 py-2 text-sm truncate">
                                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">{{__('Visita')}}</a>
                                    </div>
                                </div>
                            </li>

                            <li class="col-span-1 flex shadow-sm rounded-md">
                                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-purple-600 text-white text-sm font-medium rounded-l-md"><x-icon.phone size="5" solid /></div>
                                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                                    <div class="flex-1 px-4 py-2 text-sm truncate">
                                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">{{__('Llamada')}}</a>
                                    </div>
                                </div>
                            </li>

                            <li class="col-span-1 flex shadow-sm rounded-md">
                                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-yellow-500 text-white text-sm font-medium rounded-l-md"><x-icon.document-text size="5" solid /></div>
                                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                                    <div class="flex-1 px-4 py-2 text-sm truncate">
                                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">{{__('Vencimiento informe')}}</a>
                                    </div>
                                </div>
                            </li>

                            <li class="col-span-1 flex shadow-sm rounded-md">
                                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-green-500 text-white text-sm font-medium rounded-l-md"><x-icon.badge-check size="5" solid /></div>
                                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                                    <div class="flex-1 px-4 py-2 text-sm truncate">
                                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">{{__('Vencimiento tarea')}}</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endif
{{--                    <x-administration.menu-item label="My Visits" icon="truck" name="My Visits" onclick="window.location.href='{{ route('calendar.index',['showSubmenu'=>'My Visits']) }}'" is-active="{{ $showSubmenu == 'My Visits' }}" badge=""/>--}}
{{--                    <x-administration.menu-item label="All" icon="arrows-expand" name="All" onclick="window.location.href='{{ route('calendar.index',['showSubmenu'=>'All']) }}'" is-active="{{ $showSubmenu == 'All' }}" badge=""/>--}}

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

        @include('livewire.calendar.fullcalendar')

    </div>
</x-layout.two-columns>
