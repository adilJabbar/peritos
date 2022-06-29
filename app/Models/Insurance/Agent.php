<?php

namespace App\Models\Insurance;

use App\Models\Gabinete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function gabinetes()
    {
        return $this->belongsToMany(Gabinete::class);
    }
}
