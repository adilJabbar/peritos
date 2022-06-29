<?php

namespace App\Models\Expedient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return $this->path
            ? Storage::disk('images')->url($this->path)
            : asset('img/no_image.svg');
    }
}
