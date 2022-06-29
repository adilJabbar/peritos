@props(['legend' => null, 'notes' => null])

<fieldset class="mb-5">
    @if($legend)
        <legend class="text-base font-medium text-gray-900">{{__($legend)}}</legend>
    @endif
    @if($notes)
            <p class="text-sm text-gray-500">{{__($notes)}}</p>
    @endif
    <div class="mt-4 space-y-4">

        {{ $slot }}

    </div>
</fieldset>
