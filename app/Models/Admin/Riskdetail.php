<?php

namespace App\Models\Admin;

use App\Models\Expedient\Preexistence;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riskdetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expedients()
    {
        return $this->hasMany(Preexistence::class);
    }

    public function risksubgroup()
    {
        return $this->belongsTo(Risksubgroup::class);
    }

    public function safeDelete()
    {
        return count($this->expedients) == 0
            ? $this->delete()
            : false;
    }
}
