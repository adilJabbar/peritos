<?php

namespace App\Models\Insurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subguarantee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getHasDeductibleAttribute()
    {
        return $this->percent_deductible !== null
            || $this->min_deductible !== null
            || $this->max_deductible !== null;
    }

    public function getPercentAttribute()
    {
        return $this->percentCovered * 100;
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }
}
