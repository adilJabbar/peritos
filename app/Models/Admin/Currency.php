<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->hasMany(Country::class);
    }

    public function setIsoAttribute($value)
    {
        $this->attributes['iso'] = strtoupper($value);
    }
}
