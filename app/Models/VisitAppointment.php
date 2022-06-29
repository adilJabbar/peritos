<?php

namespace App\Models;

use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class VisitAppointment extends Model
{
    use HasFactory, HasLocalDates;

    protected $guarded = [];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    protected $appends = [
        'date_time_for_editing',
    ];

    public function contact()
    {
        return $this->belongsTo(ContactAttempt::class);
    }

    public function expedient()
    {
        return $this->belongsTo(Expedient::class);
    }

    public function getDateTimeForEditingAttribute()
    {
        return optional($this->localize('date_time'))->format('Y-m-d\TH:i');
    }

    public function setDateTimeForEditingAttribute($value)
    {
        if ($value) {
            $this->date_time = Carbon::createFromFormat('Y-m-d\TH:i', $value, auth()->user()->timezone)->tz('UTC');
        }
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
