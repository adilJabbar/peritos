<?php

namespace App\Models;

use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ContactAttempt extends Model
{
    use HasFactory, HasLocalDates;

    protected $guarded = [];

    protected $casts = [
        'time' => 'datetime',
    ];

    protected $appends = [
        'time_for_editing',
    ];

    public function expedient()
    {
        return $this->belongsTo(Expedient::class);
    }

    public function getIconAttribute()
    {
        if ($this->attempt_type === 'phone') {
            return 'phone';
        } elseif ($this->attempt_type === 'email') {
            return 'mail';
        } elseif ($this->attempt_type === 'person') {
            return 'user';
        } else {
            return 'clock';
        }
    }

    public function getTimeForEditingAttribute()
    {
        return optional($this->localize('time'))->format('Y-m-d\TH:i');
    }

    public function setTimeForEditingAttribute($value)
    {
        if ($value) {
            $this->time = Carbon::createFromFormat('Y-m-d\TH:i', $value, auth()->user()->timezone)->tz('UTC');
        }
    }

    public function visit()
    {
        return $this->hasOne(VisitAppointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
