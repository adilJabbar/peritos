<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoSession extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function videoable()
    {
        return $this->morphTo();
    }
}
