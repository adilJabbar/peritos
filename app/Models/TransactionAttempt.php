<?php

namespace App\Models;

use App\Models\Sales\Contract;
use App\Models\Sales\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'gabinete_id',
        'purchase_time',
        'user_id',
        'session_id',
        'stripe_checkout_session_id',
        'package_id',
        'renewal_time',
        'usd_renewal',
        'stripe_price_id',
        'updated',
        'contract_id',
        'is_plan_updated',
        'current_contract_id',
        'package_amount',
    ];

    public function plan()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    public function getPurchaseDateTimeAttribute()
    {
        return Carbon::parse($this->purchase_time)->format('Y-m-d H:i');
    }

    public function currentPlan()
    {
        return $this->hasOne(Contract::class, 'id', 'current_contract_id');
    }
}
