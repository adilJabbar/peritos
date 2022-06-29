<span {{$attributes}}>
    {{ number_format(floatval($value), $currency->decimals, $currency->decimal, $currency->separator) }}
</span>
