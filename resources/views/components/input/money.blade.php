@props([
    'currency' => null,
    'id',
    'error' => false,
    'placeholder' => null,
    'readonly' => false,
    'leadingAddOn' => false,
    'endingAddOn' => false,
    ])

@php
    !$currency ? $currency = \App\Models\Admin\Currency::first() : '';
    $leadingAddOn = $currency->position == 'before';
    $endingAddOn = $currency->position == 'after';
@endphp
<div class="flex shadow-sm w-full">
    @if($leadingAddOn)
    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
          {{ $currency->currency }}
    </span>
    @endif
{{--    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">--}}
{{--        <span class="text-gray-500 sm:text-sm sm:leading-5">--}}
{{--            $--}}
{{--        </span>--}}
{{--    </div>--}}
    <div class="w-full relative">
        <input
            {{ $attributes }}
            id="{{ $id }}"
            type="number"
            step="{{ pow(10, ($currency->decimals) * -1)  }}"
            class="{{ $leadingAddOn  ? 'rounded-none rounded-r-md' : '' }} {{ $endingAddOn ? 'rounded-none rounded-l-md' : '' }}
            {{ $error ? 'pr-10 border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-indigo-500 focus:border-indigo-500'}}
            {{ $readonly ? 'bg-gray-200' : '' }}
                flex-1 block w-full pl-3 pr-1 py-2 sm:text-sm border-gray-300 text-right"
            @if ($placeholder)
            placeholder="{{ __($placeholder) }}"
            @endif
            @if ($readonly)
            readonly
            @endif
        />
        @if ($error)
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <!-- Heroicon name: exclamation-circle -->
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
        @endif
    </div>
    @if($endingAddOn)
        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
              {{ $currency->currency }}
        </span>
    @endif
{{--    <input {{ $attributes }} class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" placeholder="0.00" aria-describedby="price-currency">--}}

{{--    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">--}}
{{--        <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">--}}
{{--            USD--}}
{{--        </span>--}}
{{--    </div>--}}
</div>
