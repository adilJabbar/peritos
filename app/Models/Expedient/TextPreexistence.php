<?php

namespace App\Models\Expedient;

use App\Models\Expedient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextPreexistence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expedient()
    {
        return $this->belongsTo(Expedient::class);
    }
}
