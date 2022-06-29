@props([
    'for',
    'label' => null,
    'helpText' => false,
    'helpLabel' => false,
    'error' => false,
    'inline' => false,
    'paddingless' => false,
    'borderless' => false,
    'noShadow' => false,
    'req' => false,
    ])

@if($inline)
    <div {{ $attributes }}>
        @if ($label)
            <label for="{{ $for }}" class="block text-sm font-medium text-gray-700">
                {{ __( $label ) }} @if($req) <x-errors.required/> @endif
                @if($helpLabel)
                    <span class="mt-2 text-xs text-gray-400">{{ $helpLabel }}</span>
                @endif
            </label>
        @endif

        <div class="mt-1 relative rounded-md {{$noShadow ? '' : 'shadow-sm'}}">
            {{ $slot }}

            @if ($error)
                <div class="mt-1 text-red-500 text-xs italic">{{ $error }}</div>
            @endif

            @if ($helpText)
                <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
            @endif
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start ' . ($borderless ? '' : ' sm:border-t ') . ' sm:border-gray-200 ' . ($paddingless ? '' : ' sm:py-2 ')]) }}>
        @if ($label)
            <label for="{{ $for }}" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                {{ __( $label ) }} @if($req) <x-errors.required/> @endif
                @if($helpLabel)
                    <span class="mt-2 text-xs text-gray-400">{{ $helpLabel }}</span>
                @endif
            </label>
        @endif

        <div class="mt-1 sm:mt-0 sm:col-span-{{$label ? '2' : '3'}}">
            {{ $slot }}

            @if ($error)
                <div class="mt-1 text-red-500 text-xs italic">{{ $error }}</div>
            @endif

            @if ($helpText)
                <p class="mt-2 text-xs text-gray-400">{{ $helpText }}</p>
            @endif
        </div>
    </div>
@endif




