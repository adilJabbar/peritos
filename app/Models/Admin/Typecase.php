<?php

namespace App\Models\Admin;

use App\Models\Expedient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typecase extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expedients()
    {
        return $this->belongsToMany(Expedient::class);
    }

    public function ramo()
    {
        return $this->belongsTo(Ramo::class);
    }
}
