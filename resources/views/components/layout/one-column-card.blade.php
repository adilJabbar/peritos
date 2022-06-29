@props(['title' => '', 'info' => ''])

<div>
    <div class="mb-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900">{{__($title)}}</h3>
        <p class="mt-1 text-sm text-gray-500">{{__($info)}}</p>
    </div>

    {{ $slot }}

</div>
