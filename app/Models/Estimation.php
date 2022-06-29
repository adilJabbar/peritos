<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expedient()
    {
        return $this->belongsTo(Expedient::class);
    }

    public function getCurrencyAmountAttribute()
    {
        $currency = $this->expedient->address->country->currency;
        $value = '';
        if ($currency->position == 'before') {
            $value .= $currency->currency.' ';
        }
        $value .= number_format($this->total_amount, $currency->decimals, $currency->decimal, $currency->separator);
        if ($currency->position == 'after') {
            $value .= ' '.$currency->currency;
        }

        return $value;
    }

    public function getTotalCoveredAttribute()
    {
        return $this->reparation + $this->indemnization;
    }

    public function getTotalUncoveredAttribute()
    {
        return $this->estimation + $this->not_covered;
    }

    public function getTotalAmountAttribute()
    {
        return $this->total_covered + $this->total_uncovered;
    }
}
