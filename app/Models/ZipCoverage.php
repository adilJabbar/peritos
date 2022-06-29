<?php

namespace App\Models;

use App\Models\Admin\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCoverage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function gabinete()
    {
        return $this->belongsTo(Gabinete::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
