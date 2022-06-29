<?php

namespace App\Models;

use App\Models\Admin\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function preexistenceable()
    {
        return $this->morphTo();
    }

    public function getFullAddressAttribute()
    {
        return implode(', ', [$this->address, $this->full_city]);
    }

    public function getFullCityAttribute()
    {
        return implode(', ', [$this->city, $this->zip, $this->state]).' ('.strtoupper($this->country->code).')';
    }
}
