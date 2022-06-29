<?php

namespace App\Models\Insurance;

use App\Models\Address;
use App\Models\Admin\Country;
use App\Models\Admin\Ramo;
use App\Models\Expedient;
use App\Models\Gabinete;
use App\Models\Insurance\Company\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

//    protected $fillable = ['name','legal_name','legal_id','url','logo','country_id', 'is_active'];
    protected $guarded = [];

    public function activeAgents()
    {
        return $this->agents->where('is_active', true);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function billingAddress()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function checkPolicyExists($reference)
    {
        return $this->policies->where('reference', $reference)->first();
//        return $this->policies->where('reference', $reference)->first();
    }

    public function checkLegalIdExists($legal_id)
    {
        $people = Person::where('legal_id', $legal_id)->get();
        $gabinete = $this;

        return $people->filter(function ($person) use ($gabinete) {
            return ($person->expedients->where('gabinete_id', $gabinete->id)->count() > 0) || $gabinete->expedients->where('person_id', $person->id)->count() > 0;
        })->first();
    }

    public function expedients()
    {
        return $this->morphMany(Expedient::class, 'billable');
    }

    public function gabinetes()
    {
        return $this->belongsToMany(Gabinete::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ramos()
    {
        return $this->belongsToMany(Ramo::class);
    }

    public function getCountryAttribute()
    {
        return $this->billingAddress?->country;
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? Storage::disk('logos')->url($this->logo)
            : asset('img/no-logo-available.png');
//            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
    }
}
