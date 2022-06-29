<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getLinkAttribute()
    {
        return $this->type == 'phone'
            ? 'tel:'.$this->value
            : 'mailto:'.$this->value;
    }

    public function contactable()
    {
        return $this->morphTo();
    }
}
