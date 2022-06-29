@props(['label' => 'Cambiar', 'buttonBelow' => null])

<div class="mt-2 items-center {{ $buttonBelow ? 'space-y-2' : 'space-x-5 flex ' }}">
    {{ $slot }}
    <div
        x-data="{ focused: false }"
    >
        <input
            @focus="focused = true"
            @blur="focused = false"
            class="sr-only"
            type="file"
            {{ $attributes }}
             >
        <label
            x-bind:class="{ 'outline-none ring-2 ring-offset-2 ring-indigo-500': focused}"
            for="{{ $attributes['id'] }}"
            class="cursor-pointer bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 uppercase hover:bg-gray-50 {{ $buttonBelow ? ' block text-center ' : '' }}">
            {{__($label)}}
        </label>
    </div>
</div>


{{--<div class="mt-2 items-center space-y-2">--}}
{{--    <span class="h-full w-full bg-white text-gray-300">--}}
{{--        @if($logo)--}}
{{--            <img src="{{ $logo->temporaryUrl() }}" alt="{{ __('Company Logo') }}">--}}
{{--        @else--}}
{{--            <img src="{{ $gabinete->logo }}" alt="{{ __('Company Logo') }}">--}}
{{--        @endif--}}
{{--    </span>--}}
{{--    <div--}}
{{--        x-data="{ focused: false }"--}}
{{--    >--}}
{{--        <input--}}
{{--            @focus="focused = true"--}}
{{--            @blur="focused = false"--}}
{{--            class="sr-only"--}}
{{--            type="file"--}}
{{--            wire:model="logo" id="logo"--}}
{{--        >--}}
{{--        <label--}}
{{--            x-bind:class="{ 'outline-none ring-2 ring-offset-2 ring-indigo-500': focused}"--}}
{{--            for="logo"--}}
{{--            class="cursor-pointer bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 uppercase hover:bg-gray-50 block text-center">--}}
{{--            {{__('Cambiar')}}--}}
{{--        </label>--}}
{{--    </div>--}}
{{--</div>--}}
