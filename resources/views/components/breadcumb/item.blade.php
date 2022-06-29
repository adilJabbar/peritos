<li>
    <div class="flex items-center" {{ $attributes }}>
        @unless ($noParent ?? false)
            <x-icon.chevron-right class="text-gray-400" size="5" solid />
        @endunless
        <a href="{{ $link ?? '#' }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $slot }}</a>
    </div>
</li>
