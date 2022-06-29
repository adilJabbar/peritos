<?php

namespace App\Models;

use App\Traits\HasAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    use HasFactory, HasAddress;

    protected $guarded = [];

    public function gabinete()
    {
        return $this->belongsTo(Gabinete::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'gabinete_user', 'subcontractor_id', 'user_id');
    }
}
