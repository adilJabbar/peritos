@props(['title' => '', 'info' => ''])

<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-gray-900">{{__($title)}}</h3>
        <p class="mt-1 text-sm text-gray-500">
            {{__($info)}}.
        </p>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
            {{ $slot }}
    </div>
</div>
