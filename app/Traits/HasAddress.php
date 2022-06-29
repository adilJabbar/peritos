<?php

namespace App\Traits;

use App\Models\Admin\Country;

trait HasAddress
{
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getFullAddress()
    {
        return $this->address.', '.$this->city.' '.$this->zip.'. '.$this->country->name;
    }
}
