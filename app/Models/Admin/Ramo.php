<?php

namespace App\Models\Admin;

use App\Models\Expedient;
use App\Models\Insurance\Company;
use App\Models\Insurance\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ramo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function capitals()
    {
        return $this->hasMany(Capital::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function defaultProduct()
    {
        return $this->hasOne(Product::class, 'id', 'default_product_id');
    }

    public function expedients()
    {
        return $this->hasMany(Expedient::class);
    }

    public function preexistenceClass()
    {
        return $this->belongsTo(PreexistenceClass::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function typecases()
    {
        return $this->hasMany(Typecase::class);
    }

    public function getIconUrlAttribute()
    {
        return $this->icon
            ? Storage::disk('public')->url($this->icon)
            : asset('img/no_image.svg');
    }
}
