<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risksubgroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function riskdetails()
    {
        return $this->hasMany(Riskdetail::class);
    }

    public function riskgroup()
    {
        return $this->belongsTo(Riskgroup::class);
    }

    public function safeDelete()
    {
        return count($this->riskdetails) == 0
            ? $this->delete()
            : false;
    }
}
