@props(['value' => null, 'currency' => null ])

@php
    !$currency ? $currency = \App\Models\Admin\Currency::first() : ''
@endphp

<span {{ $attributes }}>
    @if ($currency->position == 'before'){{ $currency->currency }}@endif {{ number_format(floatval($value), $currency->decimals, $currency->decimal, $currency->separator) }} @if($currency->position == 'after'){{ $currency->currency }}@endif
</span>
