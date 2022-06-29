<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Admin\Country;

trait Validations
{
    public function validateExpedient()
    {
        return [
            'expedient.reference' => '',
            'expedient.agent_id' => '',
            'expedient.requested_at_for_editing' => 'required',
            'expedient.gabinete_id' => 'required',
        ];
    }
}
