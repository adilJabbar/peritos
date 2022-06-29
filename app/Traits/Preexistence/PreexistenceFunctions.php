<?php

namespace App\Traits\Preexistence;

use App\Models\Address;
use App\Models\Admin\Country;

trait PreexistenceFunctions
{
    public function address()
    {
        return $this->morphOne(Address::class, 'preexistenceable');
    }
}
