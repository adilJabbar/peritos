<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'date',
        'payment_id',
        'taxes',
        'paid_amount',
        'currency',
    ];
}
