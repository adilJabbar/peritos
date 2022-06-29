<div class="flex-column space-y-4">
    <div class="antialiased sans-serif bg-gray-100">
        <x-card.card>
            <div x-data="{view: 'Month'}">
                <div
                    x-data="app('{{ $showSubmenu }}','{{ json_encode($rows->items()) }}')"
    {{--                x-data="{app('{{ $showSubmenu }}','{{ json_encode($rows->items()) }}')}"--}}
                    x-init="[initDate(), getNoOfDays()]"
                    x-cloak class="lg:flex lg:h-full lg:flex-col">
                    <header class="relative z-20 flex items-center justify-between border-b border-gray-200 py-4 px-6 lg:flex-none">
                        <h1 class="text-lg font-semibold">
                            <time>
                                <span x-text="MONTH_NAMES[month]" class="text-gray-900"></span>
                                <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                            </time>
                        </h1>
                        <div class="flex items-center">
                            <div class="flex items-center rounded-md shadow-sm md:items-stretch">
                                <button type="button" class="flex items-center justify-center rounded-l-md border border-r-0 border-gray-300 bg-white py-2 pl-3 pr-4 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:px-2 md:hover:bg-gray-50">
                                    <span class="sr-only">{{__('Previous month')}}</span>
                                    <!-- Heroicon name: solid/chevron-left -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button type="button" class="hidden border-t border-b border-gray-300 bg-white px-3.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:relative md:block">
                                    {{__('Today')}}</button>
                                <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"></span>
                                <button type="button" class="flex items-center justify-center rounded-r-md border border-l-0 border-gray-300 bg-white py-2 pl-4 pr-3 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:px-2 md:hover:bg-gray-50">
                                    <span class="sr-only">{{__('Next month')}}</span>
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="hidden md:ml-4 md:flex md:items-center">
                                <div x-data="{
                                            open: false,
                                            toggle() {
                                                if (this.open) {
                                                    return this.close()
                                                }

                                                this.$refs.button.focus()

                                                this.open = true
                                            },
                                            close(focusAfter) {
                                                if (! this.open) return

                                                this.open = false

                                                focusAfter && focusAfter.focus()
                                            }
                                        }"
                                     x-on:keydown.escape.prevent.stop="close($refs.button)"
                                     x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                     x-id="['dropdown-button']"
                                     class="relative">
                                    <button x-ref="button"
                                            x-on:click="toggle()"
                                            :aria-expanded="open"
                                            :aria-controls="$id('dropdown-button')"
                                            type="button" class="flex items-center rounded-md border border-gray-300 bg-white py-2 pl-3 pr-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50" id="menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span x-text="view"></span>&nbsp{{__('view')}}
                                        <!-- Heroicon name: solid/chevron-down -->
                                        <svg class="ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <!--
                                      Dropdown menu, show/hide based on menu state.

                                      Entering: "transition ease-out duration-100"
                                        From: "transform opacity-0 scale-95"
                                        To: "transform opacity-100 scale-100"
                                      Leaving: "transition ease-in duration-75"
                                        From: "transform opacity-100 scale-100"
                                        To: "transform opacity-0 scale-95"
                                    -->
                                    <div x-ref="panel"
                                         x-show="open"
                                         x-transition.origin.top.left
                                         x-on:click.outside="close($refs.button)"
                                         :id="$id('dropdown-button')"
                                        class="focus:outline-none absolute right-0 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                                         role="menu"
                                         aria-orientation="vertical"
                                         aria-labelledby="menu-button"
                                         tabindex="-1">
                                        <div class="py-1" role="none">
                                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
{{--                                            <a @click="view = 'Day'; open = false" href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{__('Day--}}
{{--                                                view')}}</a>--}}
                                            <a @click="view = 'Week'; open = false" href="#" class=" block px-4 py-2 text-sm hover:bg-primary hover:text-white" :class="view == 'Week' ? 'bg-gray-100 text-gray-900' : 'text-gray-700' " role="menuitem" tabindex="-1" id="menu-item-1">{{__('Week view')}}</a>
                                            <a @click="view = 'Month'; open = false" href="#" class="block px-4 py-2 text-sm hover:bg-primary hover:text-white" :class="view == 'Month' ? 'bg-gray-100 text-gray-900' : 'text-gray-700'" role="menuitem" tabindex="-1" id="menu-item-2">{{__('Month view')}}</a>
{{--                                            <a @click="view = 'Year'; open = false" href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-3">{{__('Year--}}
{{--                                                view')}}</a>--}}
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="ml-6 h-6 w-px bg-gray-300"></div>--}}
{{--                                <button type="button" class="focus:outline-none ml-6 rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add event</button>--}}
                            </div>
                            <div class="relative ml-6 md:hidden">
                                <button type="button" class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500" id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">{{__('Open menu')}}</span>
                                    <!-- Heroicon name: solid/dots-horizontal -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>

                                <!--
                                  Dropdown menu, show/hide based on menu state.

                                  Entering: "transition ease-out duration-100"
                                    From: "transform opacity-0 scale-95"
                                    To: "transform opacity-100 scale-100"
                                  Leaving: "transition ease-in duration-75"
                                    From: "transform opacity-100 scale-100"
                                    To: "transform opacity-0 scale-95"
                                -->
                                <div class="focus:outline-none absolute right-0 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button" tabindex="-1">
{{--                                    <div class="py-1" role="none">--}}
{{--                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->--}}
{{--                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-0">Create event</a>--}}
{{--                                    </div>--}}
                                    <div class="py-1" role="none">
                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-1">{{__('Go to today')}}</a>
                                    </div>
                                    <div class="py-1" role="none">
{{--                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-2">Day view</a>--}}
                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-3">{{__('Week
                                            view')}}</a>
                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-4">{{__('Month
                                            view')}}</a>
{{--                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-5">Year view</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div x-show="view == 'Month'" class="z-0">
                        {{--                month view--}}
                        <div class="shadow ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
                            <div class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700 lg:flex-none">
                                <template x-for="(day, index) in DAYS" :key="index">
                                    <div class="bg-white py-2">
                                        <span x-text="day.charAt(0)"></span>
                                        <span x-text="day.substring(1,3)" class="sr-only sm:not-sr-only"></span>
                                    </div>
                                </template>
                            </div>


                            <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">


{{--                                <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">--}}
{{--                                    <!----}}
{{--                                      Always include: "relative py-2 px-3"--}}
{{--                                      Is current month, include: "bg-white"--}}
{{--                                      Is not current month, include: "bg-gray-50 text-gray-500"--}}
{{--                                    -->--}}
{{--                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">--}}
{{--                                        <!----}}
{{--                                          Is today, include: "flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white"--}}
{{--                                        -->--}}
{{--                                        <time datetime="2021-12-27">27</time>--}}
{{--                                    </div>--}}

                                <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">
                                    <template x-for="blankday in previousBlankDays" :key="index" >
                                        <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                            <time datetime="2021-12-27">27</time>
                                        </div>
                                    </template>

                                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                        <div class="relative bg-white py-2 px-3">
                                            <time datetime="2022-01-03">3</time>
{{--                                            <time datetime="2021-12-27" x-text="date"></time>--}}
                                        </div>
                                    </template>

                                    <template x-for="blankday in blankdays" :key="index">
                                        <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                            <time datetime="2021-12-27" x-text="blankday" ></time>
{{--                                            <time datetime="2021-12-27" x-text="blankday" ></time>--}}
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
                                <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">
                                    <!--
                                      Always include: "relative py-2 px-3"
                                      Is current month, include: "bg-white"
                                      Is not current month, include: "bg-gray-50 text-gray-500"
                                    -->

                                    <template x-for="blankday in previousBlankDays" :key="index" >
                                        <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                            <time datetime="2021-12-27"><span  x-text="blankday" ></span></time>
                                        </div>
                                    </template>




                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <!--
                                          Is today, include: "flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white"
                                        -->
                                        <time datetime="2021-12-27">27</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2021-12-28">28</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2021-12-29">29</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2021-12-30">30</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2021-12-31">31</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-01">1</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-01">2</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-03">3</time>
                                        <ol class="mt-2">
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">Design review</p>
                                                    <time datetime="2022-01-03T10:00" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">10AM</time>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">Sales meeting</p>
                                                    <time datetime="2022-01-03T14:00" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">2PM</time>
                                                </a>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-04">4</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-05">5</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-06">6</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-07">7</time>
                                        <ol class="mt-2">
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">Date night</p>
                                                    <time datetime="2022-01-08T18:00" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">6PM</time>
                                                </a>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-08">8</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-09">9</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-10">10</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-11">11</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-12" class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">12</time>
                                        <ol class="mt-2">
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">Sam's birthday party</p>
                                                    <time datetime="2022-01-25T14:00" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">2PM</time>
                                                </a>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-13">13</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-14">14</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-15">15</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-16">16</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-17">17</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-18">18</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-19">19</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-20">20</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-21">21</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-22">22</time>
                                        <ol class="mt-2">
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">Maple syrup museum</p>
                                                    <time datetime="2022-01-22T15:00" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">3PM</time>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">Hockey game</p>
                                                    <time datetime="2022-01-22T19:00" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">7PM</time>
                                                </a>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-23">23</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-24">24</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-25">25</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-26">26</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-27">27</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-28">28</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-29">29</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-30">30</time>
                                    </div>
                                    <div class="relative bg-white py-2 px-3">
                                        <time datetime="2022-01-31">31</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2022-02-01">1</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2022-02-02">2</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2022-02-03">3</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2022-02-04">4</time>
                                        <ol class="mt-2">
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">Cinema with friends</p>
                                                    <time datetime="2022-02-04T21:00" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">9PM</time>
                                                </a>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2022-02-05">5</time>
                                    </div>
                                    <div class="relative bg-gray-50 py-2 px-3 text-gray-500">
                                        <time datetime="2022-02-06">6</time>
                                    </div>
                                </div>
                                <div class="isolate grid w-full grid-cols-7 grid-rows-6 gap-px lg:hidden">
                                    <!--
                                      Always include: "flex h-14 flex-col py-2 px-3 hover:bg-gray-100 focus:z-10"
                                      Is current month, include: "bg-white"
                                      Is not current month, include: "bg-gray-50"
                                      Is selected or is today, include: "font-semibold"
                                      Is selected, include: "text-white"
                                      Is not selected and is today, include: "text-indigo-600"
                                      Is not selected and is current month, and is not today, include: "text-gray-900"
                                      Is not selected, is not current month, and is not today: "text-gray-500"
                                    -->
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <!--
                                          Always include: "ml-auto"
                                          Is selected, include: "flex h-6 w-6 items-center justify-center rounded-full"
                                          Is selected and is today, include: "bg-indigo-600"
                                          Is selected and is not today, include: "bg-gray-900"
                                        -->
                                        <time datetime="2021-12-27" class="ml-auto">27</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2021-12-28" class="ml-auto">28</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2021-12-29" class="ml-auto">29</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2021-12-30" class="ml-auto">30</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2021-12-31" class="ml-auto">31</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-01" class="ml-auto">1</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-02" class="ml-auto">2</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-03" class="ml-auto">3</time>
                                        <span class="sr-only">2 events</span>
                                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                    <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                    <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                  </span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-04" class="ml-auto">4</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-05" class="ml-auto">5</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-06" class="ml-auto">6</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-07" class="ml-auto">7</time>
                                        <span class="sr-only">1 event</span>
                                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                    <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                  </span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-08" class="ml-auto">8</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-09" class="ml-auto">9</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-10" class="ml-auto">10</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-11" class="ml-auto">11</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 font-semibold text-indigo-600 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-12" class="ml-auto">12</time>
                                        <span class="sr-only">1 event</span>
                                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                    <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                  </span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-13" class="ml-auto">13</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-14" class="ml-auto">14</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-15" class="ml-auto">15</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-16" class="ml-auto">16</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-17" class="ml-auto">17</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-18" class="ml-auto">18</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-19" class="ml-auto">19</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-20" class="ml-auto">20</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-21" class="ml-auto">21</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 font-semibold text-white hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-22" class="ml-auto flex h-6 w-6 items-center justify-center rounded-full bg-gray-900">22</time>
                                        <span class="sr-only">2 events</span>
                                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                    <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                    <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                  </span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-23" class="ml-auto">23</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-24" class="ml-auto">24</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-25" class="ml-auto">25</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-26" class="ml-auto">26</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-27" class="ml-auto">27</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-28" class="ml-auto">28</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-29" class="ml-auto">29</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-30" class="ml-auto">30</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-white py-2 px-3 text-gray-900 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-01-31" class="ml-auto">31</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-02-01" class="ml-auto">1</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-02-02" class="ml-auto">2</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-02-03" class="ml-auto">3</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-02-04" class="ml-auto">4</time>
                                        <span class="sr-only">1 event</span>
                                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                    <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                  </span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-02-05" class="ml-auto">5</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                    <button type="button" class="flex h-14 flex-col bg-gray-50 py-2 px-3 text-gray-500 hover:bg-gray-100 focus:z-10">
                                        <time datetime="2022-02-06" class="ml-auto">6</time>
                                        <span class="sr-only">0 events</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{--                month view detail--}}
                        <div class="py-10 px-4 sm:px-6 lg:hidden">
                            <ol class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">
                                <li class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
                                    <div class="flex-auto">
                                        <p class="font-semibold text-gray-900">Maple syrup museum</p>
                                        <time datetime="2022-01-15T09:00" class="mt-2 flex items-center text-gray-700">
                                            <!-- Heroicon name: solid/clock -->
                                            <svg class="mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                            3PM
                                        </time>
                                    </div>
                                    <a href="#" class="ml-6 flex-none self-center rounded-md border border-gray-300 bg-white py-2 px-3 font-semibold text-gray-700 opacity-0 shadow-sm hover:bg-gray-50 focus:opacity-100 group-hover:opacity-100">Edit<span class="sr-only">, Maple syrup museum</span></a>
                                </li>

                                <li class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
                                    <div class="flex-auto">
                                        <p class="font-semibold text-gray-900">Hockey game</p>
                                        <time datetime="2022-01-22T19:00" class="mt-2 flex items-center text-gray-700">
                                            <!-- Heroicon name: solid/clock -->
                                            <svg class="mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                            7PM
                                        </time>
                                    </div>
                                    <a href="#" class="ml-6 flex-none self-center rounded-md border border-gray-300 bg-white py-2 px-3 font-semibold text-gray-700 opacity-0 shadow-sm hover:bg-gray-50 focus:opacity-100 group-hover:opacity-100">Edit<span class="sr-only">, Hockey game</span></a>
                                </li>
                            </ol>
                        </div>
                    </div>

{{--                    week view--}}
                    <div x-show="view == 'Week'" class="z-0">
                        <div class="flex flex-auto flex-col overflow-auto bg-white">
                        <div style="width: 165%" class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full">
                            <div class="sticky top-0 z-30 flex-none bg-white shadow ring-1 ring-black ring-opacity-5 sm:pr-8">
                                <div class="grid grid-cols-7 text-sm leading-6 text-gray-500 sm:hidden">
                                    <button type="button" class="flex flex-col items-center pt-2 pb-3">M <span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">10</span></button>
                                    <button type="button" class="flex flex-col items-center pt-2 pb-3">T <span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">11</span></button>
                                    <button type="button" class="flex flex-col items-center pt-2 pb-3">W <span class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">12</span></button>
                                    <button type="button" class="flex flex-col items-center pt-2 pb-3">T <span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">13</span></button>
                                    <button type="button" class="flex flex-col items-center pt-2 pb-3">F <span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">14</span></button>
                                    <button type="button" class="flex flex-col items-center pt-2 pb-3">S <span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">15</span></button>
                                    <button type="button" class="flex flex-col items-center pt-2 pb-3">S <span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">16</span></button>
                                </div>

                                <div class="-mr-px hidden grid-cols-7 divide-x divide-gray-100 border-r border-gray-100 text-sm leading-6 text-gray-500 sm:grid">
                                    <div class="col-end-1 w-14"></div>
                                    <div class="flex items-center justify-center py-3">
                                        <span>Mon <span class="items-center justify-center font-semibold text-gray-900">10</span></span>
                                    </div>
                                    <div class="flex items-center justify-center py-3">
                                        <span>Tue <span class="items-center justify-center font-semibold text-gray-900">11</span></span>
                                    </div>
                                    <div class="flex items-center justify-center py-3">
                                        <span class="flex items-baseline">Wed <span class="ml-1.5 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">12</span></span>
                                    </div>
                                    <div class="flex items-center justify-center py-3">
                                        <span>Thu <span class="items-center justify-center font-semibold text-gray-900">13</span></span>
                                    </div>
                                    <div class="flex items-center justify-center py-3">
                                        <span>Fri <span class="items-center justify-center font-semibold text-gray-900">14</span></span>
                                    </div>
                                    <div class="flex items-center justify-center py-3">
                                        <span>Sat <span class="items-center justify-center font-semibold text-gray-900">15</span></span>
                                    </div>
                                    <div class="flex items-center justify-center py-3">
                                        <span>Sun <span class="items-center justify-center font-semibold text-gray-900">16</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-auto">
                                <div class="sticky left-0 z-10 w-14 flex-none bg-white ring-1 ring-gray-100"></div>
                                <div class="grid flex-auto grid-cols-1 grid-rows-1">
                                    <!-- Horizontal lines -->
                                    <div class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100" style="grid-template-rows: repeat(48, minmax(3.5rem, 1fr))">
                                        <div class="row-end-1 h-7"></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">12AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">1AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">2AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">3AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">4AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">5AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">6AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">7AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">8AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">9AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">10AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">11AM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">12PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">1PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">2PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">3PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">4PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">5PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">6PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">7PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">8PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">9PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">10PM</div>
                                        </div>
                                        <div></div>
                                        <div>
                                            <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 pr-2 text-right text-xs leading-5 text-gray-400">11PM</div>
                                        </div>
                                        <div></div>
                                    </div>

                                    <!-- Vertical lines -->
                                    <div class="col-start-1 col-end-2 row-start-1 hidden grid-cols-7 grid-rows-1 divide-x divide-gray-100 sm:grid sm:grid-cols-7">
                                        <div class="col-start-1 row-span-full"></div>
                                        <div class="col-start-2 row-span-full"></div>
                                        <div class="col-start-3 row-span-full"></div>
                                        <div class="col-start-4 row-span-full"></div>
                                        <div class="col-start-5 row-span-full"></div>
                                        <div class="col-start-6 row-span-full"></div>
                                        <div class="col-start-7 row-span-full"></div>
                                        <div class="col-start-8 row-span-full w-8"></div>
                                    </div>

                                    <!-- Events -->
                                    <ol class="col-start-1 col-end-2 row-start-1 grid grid-cols-1 sm:grid-cols-7 sm:pr-8" style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto">
                                        <li class="relative mt-px flex sm:col-start-3" style="grid-row: 74 / span 12">
                                            <a href="#" class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-blue-50 p-2 text-xs leading-5 hover:bg-blue-100">
                                                <p class="order-1 font-semibold text-blue-700">Breakfast</p>
                                                <p class="text-blue-500 group-hover:text-blue-700"><time datetime="2022-01-12T06:00">6:00 AM</time></p>
                                            </a>
                                        </li>
                                        <li class="relative mt-px flex sm:col-start-3" style="grid-row: 92 / span 30">
                                            <a href="#" class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-pink-50 p-2 text-xs leading-5 hover:bg-pink-100">
                                                <p class="order-1 font-semibold text-pink-700">Flight to Paris</p>
                                                <p class="text-pink-500 group-hover:text-pink-700"><time datetime="2022-01-12T07:30">7:30 AM</time></p>
                                            </a>
                                        </li>
                                        <li class="relative mt-px hidden sm:col-start-6 sm:flex" style="grid-row: 122 / span 24">
                                            <a href="#" class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-gray-100 p-2 text-xs leading-5 hover:bg-gray-200">
                                                <p class="order-1 font-semibold text-gray-700">Meeting with design team at Disney</p>
                                                <p class="text-gray-500 group-hover:text-gray-700"><time datetime="2022-01-15T10:00">10:00 AM</time></p>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </x-card.card>

        <div x-data="app('{{ $showSubmenu }}','{{ json_encode($rows->items()) }}')"
             x-init="[initDate(), getNoOfDays()]" x-cloak>
            <div class=" mx-auto my-2">
                <!-- <div class="font-bold text-gray-800 text-xl mb-4">
                    Schedule Tasks
                </div> -->

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <div class="flex items-center justify-between py-2 px-6">
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div class="border rounded-lg px-1" style="padding-top: 2px;">
                            <button
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                                :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                :disabled="month == 0 ? true : false"
                                @click="month--; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <div class="border-r inline-flex h-6"></div>
                            <button
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                                :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                :disabled="month == 11 ? true : false"
                                @click="month++; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="-mx-1 -mb-1">
                        <div class="flex flex-wrap" style="margin-bottom: -40px;">
                            <template x-for="(day, index) in DAYS" :key="index">
                                <div style="width: 14.26%" class="px-2 py-2">
                                    <div
                                        x-text="day"
                                        class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
                                </div>
                            </template>
                        </div>

                        <div class="flex flex-wrap border-t border-l">
                            <template x-for="blankday in previousBlankDays">
                                <div
                                    style="width: 14.28%; height: 120px"
                                    class="text-center border-r border-b px-4 pt-2"
                                ></div>
                            </template>
                            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                                    <div
                                        @click="showEventModal(date)"
                                        x-text="date"
                                        class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"
                                    ></div>
                                    <div style="height: 80px;" class="overflow-y-auto mt-1">
                                        <!-- <div
                                            class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                                            x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
                                            x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div> -->

                                        <template
                                            x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">
                                            <div
                                                class="px-2 py-1 rounded-lg mt-1 overflow-hidden border hover:bg-primary hover:text-white cursor-pointer"
                                                :class="{
												'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
												'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
												'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
												'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
												'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'
											}"
                                            >
                                                <p x-text="event.event_title"
                                                   class="text-sm truncate leading-tight"></p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div style=" background-color: rgba(0, 0, 0, 0.8)"
                 class="fixed  z-40 hidden top-0 right-0 left-0 bottom-0 h-full w-full">
                <div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
                    <div
                        class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer">
                        <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
        </div>
    </div>

</div>

<script>
    let eventsData = [];
    let contactData
    function eventResult(showSubmenu, rows) {
        console.log(showSubmenu);
        let results = JSON.parse(rows);
        {{--let results = JSON.parse('{!! json_encode($rows->items()) !!}');--}}
        if (showSubmenu == "Expedients") {
            results.forEach(function (val) {
                contactData = {
                    event_date: new Date(val.time),
                    event_title: val.time,
                    event_theme: 'blue'
                }
                eventsData.push(contactData)
            })

        } else if (showSubmenu == "My Visits") {
            results.forEach(function (val) {
                console.log(val);
                let fullcode = "-";
                // if(val.technician){
                //     fullcode = val.technician.full_name;
                // }
                if(val.expedient){
                    fullcode = val.expedient.full_code;
                }
                contactData = {
                    event_date: new Date(val.date_time),
                    event_title: fullcode,
                    event_theme: 'blue'
                }
                eventsData.push(contactData)
            });
        }

    }

    const MONTH_NAMES = [
        '{{__('January')}}',
        '{{__('February')}}',
        '{{__('March')}}',
        '{{__('April')}}',
        '{{__('May')}}',
        '{{__('June')}}',
        '{{__('July')}}',
        '{{__('August')}}',
        '{{__('September')}}',
        '{{__('October')}}',
        '{{__('November')}}',
        '{{__('December')}}'
    ];
    const DAYS = [
        '{{__('Sun')}}',
        '{{__('Mon')}}',
        '{{__('Tue')}}',
        '{{__('Wed')}}',
        '{{__('Thu')}}',
        '{{__('Fri')}}',
        '{{__('Sat')}}'
    ];

    function app(showSubmenu, rows) {
        eventResult(showSubmenu, rows);
        console.log(showSubmenu);
        let res = {
            month: '',
            year: '',
            no_of_days: [],
            blankDays: [],
            previousBlankDays: [],
            totalDays: 0,

            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            events: eventsData,
            event_title: '',
            event_date: '',
            event_theme: 'red',
            initDate() {
                let today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
            },

            isToday(date) {
                const today = new Date();
                const d = new Date(this.year, this.month, date);

                return today.toDateString() === d.toDateString() ? true : false;
            },

            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();


                // find where to start calendar day of week
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let daysInPreviousMonth = new Date(this.year, this.month, 0).getDate();
                let previousBlankdaysArray = [];
                for (var i = daysInPreviousMonth - dayOfWeek + 1; i <= daysInPreviousMonth; i++) {
                    previousBlankdaysArray.push(i);
                    this.totalDays++;
                }

                let daysArray = [];
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                    this.totalDays++;
                }

                // let dayOfWeekNextMonth = new Date(this.year, this.month + 1).getDay();
                let blankdaysArray = [];
                for (var i = 1; i <= 42 - this.totalDays; i++) {
                    blankdaysArray.push(i);
                }

                this.previousBlankDays = previousBlankdaysArray;
                this.blankdays = blankdaysArray;
                this.no_of_days = daysArray;
            }
        }
        return res;
    }

</script>
