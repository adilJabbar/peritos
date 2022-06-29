<?php

namespace App\Models\Sales;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'expedients',
        'users',
        'video_minutes',
        'usd_month',
        'usd_year',
        'usd_expedient',
        'usd_user',
        'stripe_id',
    ];

    public function getPlanDaysAttribute()
    {
        $time = Carbon::now();
        $endtimeyear = new Carbon();
        $endtimeyear->addYear();
        $endtimemonth = new Carbon();
        $endtimemonth->addMonth();

        return ['month' => $endtimemonth->diffInDays($time), 'year' => $endtimeyear->diffInDays($time)];
    }
}
