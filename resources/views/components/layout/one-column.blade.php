<div>
    <!-- Primary column -->
    <section aria-labelledby="primary-heading" class="min-w-0 flex-1 h-full flex flex-col overflow-hidden lg:order-last">
        <h1 id="primary-heading" class="sr-only">{{ $title }}</h1>

        <div class="p-6 h-full">

            {{ $slot }}
            {{--            <div class="block border-2 border-dashed border-gray-300 rounded h-full w-full text-gray-200">--}}

            {{--                main space--}}
            {{--            </div>--}}
        </div>

    </section>

</div>
