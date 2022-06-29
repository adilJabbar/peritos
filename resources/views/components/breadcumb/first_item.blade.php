<li>
    <div>
        <a href="#" class="text-gray-400 hover:text-gray-500">
            <x-dynamic-component :component="'icon.'.$icon" solid :size="$size" />
            <span class="sr-only">{{ $name ?? '' }}</span>
        </a>
    </div>
</li>
