<?php

namespace App\Models\Insurance\Company;

use App\Models\Expedient;
use App\Models\Insurance\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function expedients()
    {
        return $this->hasMany(Expedient::class);
    }
}
