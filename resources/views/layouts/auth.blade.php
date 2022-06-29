<x-layouts.base>
    <div class="min-h-screen bg-white flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <x-layout.login-card>
                    <div>
                        <x-branding.horizontal-logo />
                        <h2 class="mt-6 text-2xl font-extrabold text-gray-900 text-center">
                            {{ $title }}
                        </h2>
                        @if($subtitle ?? false)
                            <p class="text-gray-500 text-sm text-center">{{ $subtitle}}</p>


                        @endif
                    </div>

                    <div class="mt-8">

                        <x-jet-validation-errors class="mb-4" />

                        <div class="mt-6">
                            {{ $slot }}

                        </div>
                    </div>
                </x-layout.login-card>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ $background }}" alt="{{ config('app.name') }}">
        </div>
    </div>


</x-layouts.base>
