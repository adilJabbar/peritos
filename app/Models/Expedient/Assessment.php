<?php

namespace App\Models\Expedient;

use App\Models\Admin\Capital;
use App\Models\Admin\Currency;
use App\Models\Admin\Deprecationgroup;
use App\Models\Admin\Destiny;
use App\Models\Expedient;
use App\Models\Insurance\Subguarantee;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'currency',
        'total',
        'total_real',
        'total_covered',
        'total_proposed',
        'total_deprecated',
        'total_infraseguro',
    ];

    public function capital()
    {
        return $this->belongsTo(Capital::class);
    }

//    public function currency()
//    {
//        return $this->belongsTo(Currency::class);
//    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class);
    }

    public function deprecationgroup()
    {
        return $this->belongsTo(Deprecationgroup::class);
    }

    public function expedient()
    {
        return $this->belongsTo(Expedient::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function subguarantee()
    {
        return $this->belongsTo(Subguarantee::class);
    }

//    public function subguaranteeparticular()
//    {
//        return $this->belongsTo(Subguaranteeparticular::class);
//    }

    public function getCurrencyAttribute()
    {
        return $this->expedient->currency();
    }

    public function getIsCoveredAttribute()
    {
        return $this->destiny->covered;
    }

    public function getSubtotalAttribute()
    {
        if ($this->unit && $this->unit_price) {
            return $this->unit * $this->unit_price;
        }
    }

    public function getSubtotalTaxesAttribute()
    {
        if ($this->unit && $this->unit_price && $this->taxes) {
            return $this->unit * $this->unit_price * $this->taxes / 100;
        }
    }

    public function getTotalAttribute()
    {
        if ($this->unit && $this->unit_price) {
            return $this->unit * ($this->unit_price * (100 + $this->taxes) / 100);
        }
    }

    public function getTotalCoveredAttribute()
    {
        return $this->total;
    }

    public function getTotalDeprecatedAttribute()
    {
        $group = Deprecationgroup::find($this->deprecationgroup_id);
        if ($this->deprecation) {
            if (! $group) {
                return $this->total * $this->deprecation / 100;
            } else {
                $yearsExpected = $group->estimated_years;
                $residual = $group->residual_percent;
                $reductionIndex = ($yearsExpected * ($yearsExpected + 1) / 2) / ((100 - $residual) / 100);
                $consumed = 0;

                for ($i = 0; $i < $this->deprecation && $i < $yearsExpected; $i++) {
                    $consumed += $yearsExpected - $i;
                }

                return ($consumed / $reductionIndex) * $this->total;
            }
        }
    }

    public function getTotalInfraseguroAttribute()
    {
        if ($this->subguarantee) {
            if ($this->subguarantee->primer_riesgo || ($this->capital_id && $this->capital_id && ! $this->expedient->policy->capitals->where('id', $this->capital_id)->first()->infraseguroPercent()) || ! $this->capital_id) {
//            if ($this->subguarantee->primer_riesgo || $this->expedient->policy->capitals->where('id', $this->capital_id)->first()->pivot->primer_riesgo || !$this->expedient->policy->capitals->where('id', $this->capital_id)->first()->infraseguroPercent()) {
                return 0;
            } else {
                return 0 - ($this->total_proposed * $this->expedient->policy->capitals->where('id', $this->capital_id)->first()->infraseguroPercent() / 100);
            }
        }
    }

    public function getTotalProposedAttribute()
    {
        if ($this->destiny->covered ?? false) {
            if ($this->capital_id) {
                $percAssumedByCia = $this->expedient->policy->capitals->find($this->capital_id)->pivot['perc_cia'] ?? 0;
            } else {
                $percAssumedByCia = 100;
            }
            if ($this->deprecation <= ($percAssumedByCia * 100)) {
                return $this->total;
            } else {
                return $this->total_real + ($this->total * $percAssumedByCia);
            }
        } else {
            return 0;
        }
    }

    public function getTotalExcludedAttribute()
    {
        if (! $this->destiny->covered ?? false) {
            return $this->total;
        } else {
            return 0;
        }
    }

    public function getTotalRealAttribute()
    {
        return $this->total - $this->total_deprecated;
    }

    public function getTotalLiquidAttribute()
    {
        return $this->total_proposed + $this->total_infraseguro;
    }
}
