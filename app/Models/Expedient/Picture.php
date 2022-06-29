<?php

namespace App\Models\Expedient;

use App\Models\Expedient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expedient()
    {
        return $this->belongsTo(Expedient::class);
    }

    public function getPdfUrlAttribute()
    {
        return 'files/expedients/images/'.$this->path;
    }

    public function getPublicUrlAttribute()
    {
        return Storage::disk('images')->url($this->path);
    }
}
