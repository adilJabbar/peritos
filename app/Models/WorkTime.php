<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start' => 'datetime',
        'last_update' => 'datetime',
        'end' => 'datetime',
    ];

    public function overFifteenMinutes()
    {
        $from = $this->last_update ?: $this->start;
        if ($from->diffInSeconds(Carbon::now()) > 900) {
//            $this->update(['last_update' => Carbon::now()]);
            return true;
        }

        return false;
    }

    public function timeable()
    {
        return $this->morphTo();
    }
}
