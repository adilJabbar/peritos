<?php

namespace App\Models\Admin;

use App\Models\CapitalPolicy;
use App\Models\Expedient\Assessment;
use App\Models\Insurance\Policy;
use App\Models\Insurance\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function capitalPolicies()
    {
        return $this->hasMany(CapitalPolicy::class);
    }

    public function moveDown()
    {
        self::where(['ramo_id' => $this->ramo_id, 'position' => ($this->position + 1)])->update(['position' => $this->position]);
        $this->update(['position' => $this->position + 1]);
    }

    public function moveUp()
    {
        self::where(['ramo_id' => $this->ramo_id, 'position' => ($this->position - 1)])->update(['position' => $this->position]);
        $this->update(['position' => $this->position - 1]);
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class)->withPivot(['amount', 'primer_riesgo', 'perc_cia', 'reposicion', 'deprecation']);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function realValue()
    {
        return $this->pivot
            ? $this->pivot['reposicion'] - ($this->pivot['reposicion'] * $this->pivot['deprecation'] / 100)
            : null;
    }

    public function asegurableValue()
    {
        if ($this->pivot) {
            $deprecCubiertaCia = $this->pivot['reposicion'] * $this->pivot['perc_cia'] / 100;
//            dd($deprecCubiertaCia);
            if ($this->realValue() + $deprecCubiertaCia > $this->pivot['reposicion']) {
                return $this->pivot['reposicion'];
            } else {
                return $this->realValue() + $deprecCubiertaCia;
            }
        } else {
            return null;
        }
    }

    public function limitValue()
    {
        return $this->pivot['amount'] < $this->asegurableValue()
            ? $this->pivot['amount']
            : $this->asegurableValue();
    }

    public function infraseguroValue()
    {
        if ($this->pivot) {
            if ($this->pivot['primer_riesgo']) {
                return null;
            } elseif ($this->pivot['amount'] < $this->asegurableValue()) {
                return $this->pivot['amount'] - $this->asegurableValue();
            }
        }
    }

    public function infraseguroPercent()
    {
        if ($this->pivot) {
            if ($this->pivot['primer_riesgo']) {
                return 0;
            } elseif ($this->pivot['amount'] < $this->asegurableValue()) {
                return (1 - ($this->pivot['amount'] / $this->asegurableValue())) * 100;
            }
//            elseif($this->pivot['amount'] < $this->asegurableValue()) return (100 - ($this->pivot['amount'] / $this->asegurableValue()));
        }
    }

    public function franquicia($subguarantee, $totalLiquid)
    {
        if ($subguarantee->percent_deductible || $subguarantee->min_deductible || $subguarantee->max_deductible) {
            $franquicia = $totalLiquid * $subguarantee->percent_deductible;
            if ($franquicia < $subguarantee->min_deductible) {
                return $subguarantee->min_deductible;
            }
            if ($franquicia > $subguarantee->max_deductible) {
                return $subguarantee->max_deductible;
            }

            return $franquicia;
        }
    }
}
