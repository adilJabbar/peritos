<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riskgroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function risksubgroups()
    {
        return $this->hasMany(Risksubgroup::class);
    }

    public function safeDelete()
    {
        return count($this->risksubgroups) == 0
            ? $this->delete()
            : false;
    }
}
