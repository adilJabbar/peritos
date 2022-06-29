<main class="min-w-0 flex-1 border-t border-gray-200 lg:flex h-full">

    <!-- Primary column -->
    <div aria-labelledby="primary-heading" class="min-w-0 flex-1 lg:h-full flex flex-col lg:order-last lg:hidden">
        <h1 id="primary-heading" class="sr-only">{{ $title }}</h1>
        {{ $primary }}
    </div>

    <!-- Secondary column (hidden on smaller screens) -->
    <aside class="hidden lg:block lg:flex-shrink-0 lg:order-first min-h-screen">
        <div class="h-full relative flex flex-col w-72 border-r border-gray-200 bg-gray-100 overflow-y-auto">
            {{ $secondary }}
        </div>
    </aside>

    {{ $slot  }}
</main>
