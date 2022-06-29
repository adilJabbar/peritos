<div>
    @if (count($this->availableLanguages) > 0)
        <x-jet-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                    <img class="h-6 w-6 rounded-full object-cover" src="{{ asset('img/flags/' . $language . '.jpg') }}" alt="{{ $language }}" />
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Select Language') }}
                </div>

                @foreach ($availableLanguages as $key => $value)
                    @if($key != $language)
                        <x-jet-dropdown-link wire:click="updateUserLanguage('{{ $key }}')">
                            <div class="flex justify-between">
                                <img class="h-6 object-cover" src="{{ asset('img/flags/' . $key . '.jpg') }}" alt="{{ __($value) }}" />
                                <span>{{ __($value) }}</span>

                            </div>
                        </x-jet-dropdown-link>
                    @endif
                @endforeach

            </x-slot>
        </x-jet-dropdown>
    @endif
</div>
