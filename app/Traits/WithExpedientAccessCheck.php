<?php

namespace App\Traits;

use App\Models\Admin\Country;

trait WithExpedientAccessCheck
{
    public function verifyAllowed()
    {
        ! auth()->user()->allowedToExpedient($this->expedient) && redirect(route('error.forbidden'));
    }
}
