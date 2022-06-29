<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreexistenceClass extends Model
{
    use HasFactory;

    public function ramos()
    {
        return $this->hasMany(Ramo::class);
    }
}
