@props(['selected' => false])

<li>
    <a href="#" class="block hover:bg-gray-50" {{ $attributes }}>
        <div class="px-4 py-4 flex items-center sm:px-6 {{ $selected ? 'bg-gray-100' : '' }}">
            <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                {{ $slot}}
            </div>
            <div class="ml-5 flex-shrink-0">
                <x-icon.chevron-right class="text-gray-400" solid size="5" />
            </div>
        </div>
    </a>
</li>
