{{--@props([--}}
{{--    'leadingAddOn' => false,--}}
{{--    'type' => 'text',--}}
{{--    'id',--}}
{{--    'error' => false,--}}
{{--    'placeholder' => null,--}}
{{--    'options' => [],--}}
{{--    'selected' => []--}}
{{--    ])--}}

<div>
    <div x-data="{ open: false }"
         @keydown.escape="open = false"
         @click.away="open = false"
         class="relative inline-block text-left w-full">
        <div>
            @json($user)
            <div
                class="inline-flex w-full justify-between rounded-md shadow-sm px-4 pt-2 bg-white text-sm font-medium border {{ $error ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' : ' border-gray-300 text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500' }}  "
                id="options-menu"
                aria-haspopup="true"
                x-bind:aria-expanded="open"
                aria-expanded="true">

                <div>
                    @if(count($selectedOptions) > 0)
                        <div class="space-x-2">
                            @foreach($selectedOptions as $badge)
                                <span class="inline-flex rounded-full items-center py-0.5 pl-2.5  pr-1  mb-2 text-sm font-medium bg-indigo-100 text-indigo-700">
                                  {{ $badge['name'] }}
                                    <button wire:click="clearSelected({{ $badge['id'] }})" type="button" class="flex-shrink-0 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white">
                                    <span class="sr-only">{{ $badge['name'] }}</span>
                                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                      <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                    </svg>
                                  </button>
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="pb-2">
                            <span class="text-gray-500 sm:text-sm font-normal pb-2">{{ $placeholder ? $placeholder : __('Selecciona las opciones...') }}</span>
                        </div>
                    @endif
                </div>

                <div x-on:click="open = !open; setTimeout(function(){$refs.input.focus()}, 100)" class="w-10 -mr-4 -mt-2 pt-2 rounded-r-md hover:bg-gray-700 hover:text-white cursor-pointer">
                    <svg class="h-5 w-5 mx-auto" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

        </div>

        <div x-show="open"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="origin-top-right absolute flex-col right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-30"
             role="menu"
             aria-orientation="vertical"
                         aria-labelledby="options-menu"
        >
            <input
{{--                {{ $attributes }}--}}
                wire:model="search"
                x-ref="input"
                id="{{ $selectId }}"
                type="{{$type}}"
                class="-mt-2 {{ $leadingAddOn ? 'rounded-none rounded-r-md' : 'rounded-md' }} border-gray-300 focus:ring-gray-500 focus:border-gray-500 flex-1 block w-full px-3 py-2 sm:text-sm border-gray-300"
                placeholder="{{ __($placeholder ?? 'Selecciona las opciones...') }}"

            />
            <div class="mt-1 overflow-auto max-h-72">
                @foreach($filteredOptions as $option)
                    <button
                        wire:click="addSelected({{ $option }})"
                        type="button"
                        class="w-full block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem">{{ $option->name }}</button>
                @endforeach
            </div>
{{--            --}}{{--                <div class="py-1">--}}
{{--            --}}{{--                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Edit</a>--}}
{{--            --}}{{--                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Duplicate</a>--}}
{{--                            </div>--}}
        </div>
    </div>
</div>
