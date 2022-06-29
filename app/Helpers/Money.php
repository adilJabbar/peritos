<?php

function plan_amount_calculate($plan_amount, $plan_days, $current_plan_amount = 0, $current_plan_use_days = 0, $current_plan_total_days = null)
{
    if ($current_plan_amount == 0) {
        return $plan_amount;
    } else {
        $use_amounts = $current_plan_amount * $current_plan_use_days / $current_plan_total_days;

        $remaining_amount = $current_plan_amount - $use_amounts;

        $new_paid_amounts = $plan_amount * $current_plan_use_days / $plan_days;
        $total_without_current_amount = $plan_amount - $new_paid_amounts;

        return $total_without_current_amount - $remaining_amount;
    }
}

function uses_amount_calculate($current, $type, $new_plan_price, $new_plan_free)
{
    if (! (isset($current) && isset($current[$type]))) {
        return 0;
    }
    $amount = 0;
    $current_use = $current[$type]['use'];
    $current_plan_price = $current[$type]['price'];
    $current_plan_free = $current[$type]['free'];
    if ($current_use == 0) {
        return 0;
    }
    if ($current_use > $current_plan_free) {
        $amount = $current_plan_price * ($current_use - $current_plan_free);
    }
    $newAmount = 0;
    if ($current_use > $new_plan_free) {
        $newAmount = $new_plan_price * ($current_use - $new_plan_free);
    }

    return $newAmount;
}

function money_format_360($amount, $format, $decimals = null, $transform = false)
{
    if ($decimals === null) {
        $decimals = $format['decimals'];
    }
    if ($transform) {
        $amount = $amount * $format['usd_rate'];
    }

    $value = number_format($amount, $decimals, $format['decimal'], $format['thousand']);
    if ($format['position'] === 'before') {
        return $format['currency'].$value;
    } else {
        return $value.$format['currency'];
    }
}

function money_format_360_break($amount, $format, $decimals = null, $transform = false)
{
//    dd($decimals);
    if ($decimals === null) {
        $decimals = $format['decimals'];
    }
    if ($transform) {
        $amount = $amount * $format['usd_rate'];
    }

    $value = number_format($amount, $decimals, $format['decimal'], $format['thousand']);
    if ($format['position'] === 'before') {
        return $format['currency'].$value;
    } else {
        return $value.'<br>'.$format['currency'];
    }
}

function money_format_country(App\Models\Admin\Currency $country)
{
    return [
        'id' => $country->id,
        'decimals' => $country->decimals,
        'decimal' => $country->decimal,
        'thousand' => $country->separator,
        'currency' => $country->currency,
        'position' => $country->position,
        'usd_rate' => $country->usd_rate,
        'iso' => $country->iso,
    ];
}
