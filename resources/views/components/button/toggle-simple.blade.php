@props([
    'sr' => false,
    ])

<button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary bg-gray-200"
        x-data="{ on: @entangle($attributes->wire('model')) }"
        aria-pressed="false"
        :aria-pressed="on.toString()"
        @click="on = !on"
        x-state:on="Enabled"
        x-state:off="Not Enabled"
        :class="{ 'bg-primary': on, 'bg-gray-200': !(on) }">
    @if($sr)<span class="sr-only">{{ __($sr) }}</span>@endif
    <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 translate-x-0"
          x-state:on="Enabled"
          x-state:off="Not Enabled"
          :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }"></span>
</button>
