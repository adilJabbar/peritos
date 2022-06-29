<?php

namespace App\Models\Sales;

use App\Models\Gabinete;
use App\Models\TransactionAttempt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'gabinete_id',
        'purchase_time',
        'user_id',
        'auto_renewal',
        'renewal_time',
        'contract_length',
        'expiration_time',
        'package_id',
        'expedients',
        'users',
        'video_minutes',
        'total_users',
        'usd_renewal',
        'usd_expedient',
        'usd_user',
        'subscription_id',
    ];

    public function plan()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    public function gabinate()
    {
        return $this->belongsTo(Gabinete::class, 'id');
    }

    public function transaction()
    {
        return $this->hasOne(TransactionAttempt::class, 'contract_id', 'id');
    }

    public function getStartDateTimeAttribute()
    {
        return Carbon::parse($this->purchase_time)->format('Y-m-d H:i');
    }

    public function getExpirationDateTimeAttribute()
    {
        return Carbon::parse($this->expiration_time)->format('Y-m-d H:i');
    }

    public function getUsePlanDaysAttribute()
    {
        $time = Carbon::now();
        $endtimemonth = Carbon::parse($this->renewal_time);

        return $time->diffInDays($endtimemonth);
    }

    public function getPlanDaysAttribute()
    {
        $time = Carbon::parse($this->renewal_time);
        $endtimeyear = Carbon::parse($this->expiration_time);

        return $endtimeyear->diffInDays($time);
    }
}
