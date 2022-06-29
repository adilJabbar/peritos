@props(['decimals' => 2, 'value', 'currency'])
<span {{$attributes}}>
    {{ number_format(floatval($value), $decimals, $currency->decimal, $currency->separator) }}%
</span>
