<?php

namespace App\Models\Admin;

use App\Models\Insurance\Company;
use App\Models\ZipCoverage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function buildingTypes()
    {
        return Riskdetail::whereIn('risksubgroup_id', Risksubgroup::whereIn('riskgroup_id', $this->riskgroups->pluck('id'))->pluck('id'))->get();
    }

    public function companies()
    {
        return Company::whereHas('billingAddress', function ($query) {
            return $query->where('country_id', '=', $this->id);
        })->get();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function deprecationgroups()
    {
        return $this->hasMany(Deprecationgroup::class);
    }

    public function ramos()
    {
        return $this->hasMany(Ramo::class);
    }

    public function riskgroups()
    {
        return $this->hasMany(Riskgroup::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function getFlagUrlAttribute()
    {
        return $this->flag
            ? Storage::disk('public')->url($this->flag)
            : asset('img/no_image.svg');
    }

    public function zipCoverages()
    {
        return $this->hasMany(ZipCoverage::class);
    }
}
