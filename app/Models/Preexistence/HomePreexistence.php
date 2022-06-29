<?php

namespace App\Models\Preexistence;

use App\Models\Admin\BuildingDeprecation;
use App\Models\Admin\Riskdetail;
use App\Models\Expedient\Image;
use App\Traits\Preexistence\PreexistenceFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomePreexistence extends Model
{
    use HasFactory, PreexistenceFunctions;

    protected $guarded = [];

    public function beneficioIndustrial($value)
    {
        return $value * ($this->address->country->benef_ind_perc / 100);
    }

    public function contentBase()
    {
        return $this->address->country->furniture * $this->furniture_perc * $this->amount_perc;
    }

    public function contentPeople()
    {
        return ($this->people * $this->address->country->person) * $this->furniture_perc * $this->amount_perc;
    }

    public function contentRooms()
    {
        return ($this->rooms * $this->address->country->room) * $this->furniture_perc * $this->amount_perc;
    }

    public function contentSubtotal()
    {
        return $this->contentBase() + $this->contentPeople() + $this->contentRooms();
    }

    public function contentSubtotalTaxes()
    {
        return $this->contentSubtotal() * $this->address->country->taxes / 100;
    }

    public function contentValueProposal()
    {
        return $this->contentSubtotal() + $this->contentSubtotalTaxes();
    }

    public function continentValueProposal($value)
    {
        $architect = $value * $this->address->country->arquitecto_perc / 100;
        $architect_taxes = $architect * $this->address->country->reduced_taxes / 100;
        $license = $value * $this->address->country->license_perc / 100;

        return $this->total($value) + $architect + $architect_taxes + $license;
    }

    public function gastosGenerales($value)
    {
        return $value * ($this->address->country->gastos_generales_perc / 100);
    }

    public function getBuildingDeprecationAttribute()
    {
        return $this->building_value * $this->building_deprecation_percent / 100;
    }

    public function getBuildingDeprecationCoeficientAttribute()
    {
        return 1 - ($this->building_deprecation_percent / 100);
    }

    public function getBuildingDeprecationPercentAttribute()
    {
        $years = $this->years_old === null
            ? 1
            : ($this->years_old > 100 ? 100 : $this->years_old);
        $deprecation = BuildingDeprecation::where('years', $years)->first();
//        dd($deprecation);
//        dd($years);
        return $deprecation->{$this->maintenance};
//        return $deprecation->{$this->maintenanceStatus()};
    }

    public function getBuildingValueAttribute()
    {
        return $this->riskdetail->national_modificator
            * ($this->quality && $this->quality != 'media'
                ? $this->riskdetail->{$this->quality.'_modificator'}
                : 1)
            * ($this->dimension
                ? $this->dimension * $this->valuem2()
                : 0);
    }

    public function getBuildingRealValueAttribute()
    {
        return $this->building_value - $this->building_deprecation;
    }

    public function getInsidePictureAttribute()
    {
        return $this->images->where('group', 'InsidePhoto')->first();
    }

    public function getInsidePictureUrlAttribute()
    {
        return $this->images->where('group', 'InsidePhoto')->first()
            ? Storage::disk('images')->url($this->images->where('group', 'InsidePhoto')->first()->path)
            : asset('img/no_image.svg');
    }

    public function getOutsidePictureAttribute()
    {
        return $this->images->where('group', 'OutsidePhoto')->first();
    }

    public function getOutsidePictureUrlAttribute()
    {
        return $this->images->where('group', 'OutsidePhoto')->first()
            ? Storage::disk('images')->url($this->images->where('group', 'OutsidePhoto')->first()->path)
            : asset('img/no_image.svg');
    }

    public function getYearsOldAttribute()
    {
        return date('Y') - $this->year;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

//    public function maintenanceStatus()
//    {
//        switch($this->maintenance){
//            case '1.2':
//                $maintenance = 'Excelente';
//                break;
//            case '0.8':
//                $maintenance = 'Regular';
//                break;
//            case '0.6':
//                $maintenance = 'Malo';
//                break;
//            case '0.3':
//                $maintenance = 'Lamentable';
//                break;
//            case '0':
//                $maintenance = 'Ruina';
//                break;
//            default:
//                $maintenance = 'Bueno';
//                break;
//        }
//        return $maintenance;
//    }

    public function riskdetail()
    {
        return $this->belongsTo(Riskdetail::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value;
        if ($value) {
            switch ($value) {
                case 'high':
                    $this->attributes['amount_perc'] = 1.25;
                    break;
                case 'low':
                    $this->attributes['amount_perc'] = 0.80;
                    break;
                case 'empty':
                    $this->attributes['amount_perc'] = 0.35;
                    break;
                case 'normal':
                default:
                    $this->attributes['amount_perc'] = 1;
            }
        }
    }

    public function setFurnitureAttribute($value)
    {
        $this->attributes['furniture'] = $value;
        if ($value) {
            switch ($value) {
                case 'luxe':
                    $this->attributes['furniture_perc'] = 1.8;
                    break;
                case 'high':
                    $this->attributes['furniture_perc'] = 1.25;
                    break;
                case 'low':
                    $this->attributes['furniture_perc'] = 0.85;
                    break;
                case 'vpo':
                    $this->attributes['furniture_perc'] = 0.75;
                    break;
                case 'media':
                default:
                    $this->attributes['furniture_perc'] = 1;
            }
        }
    }

//    public function setMaintenanceAttribute($value)
//    {
//        $this->attributes['maintenance'] = $value;
//        if($value){
//            switch ($this->attributes['maintenance']) {
//                case 'Excelente':
//                    $this->attributes['maintenance_perc'] = 1.2;
//                    break;
//                case 'Regular':
//                    $this->attributes['maintenance_perc'] = 0.8;
//                    break;
//                case 'Malo':
//                    $this->attributes['maintenance_perc'] = 0.6;
//                    break;
//                case 'Lamentable':
//                    $this->attributes['maintenance_perc'] = 0.3;
//                    break;
//                case 'Ruina':
//                    $this->attributes['maintenance_perc'] = 0;
//                    break;
//                case 'Bueno':
//                default:
//                    $this->attributes['maintenance_perc'] = 1;
//            }
//        }
//    }

    public function setQualityAttribute($value)
    {
        $this->attributes['quality'] = $value;
        if ($value) {
            switch ($value) {
                case 'luxe':
                    $this->attributes['quality_perc'] = 1.8;
                    break;
                case 'high':
                    $this->attributes['quality_perc'] = 1.25;
                    break;
                case 'low':
                    $this->attributes['quality_perc'] = 0.85;
                    break;
                case 'vpo':
                    $this->attributes['quality_perc'] = 0.75;
                    break;
                case 'media':
                default:
                    $this->attributes['quality_perc'] = 1;
            }
        }
    }

    public function subtotal($value)
    {
        return $value + $this->address->country->seg_salud + $this->gastosGenerales($value) + $this->beneficioIndustrial($value);
    }

    public function total($value)
    {
        $subtotal = $this->subtotal($value);
        $taxes = $subtotal * $this->address->country->reduced_taxes / 100;

        return $subtotal + $taxes;
    }

    public function valuem2()
    {
        $stateCoef = $this->address && $this->address->country->states->where('name', $this->address->state)
            ? $this->address->country->states->where('name', $this->address->state)->first()->national_adjustment
            : 1;

        return $this->address->country->precio_m * $stateCoef;
    }
}
