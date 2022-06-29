<a href="{{ $url }}" class="{{ $classes }}">
    <span class="sr-only">{{ __($attributes['placeholder']) ?? '' }}</span>
    {{ $slot  }}
</a>
