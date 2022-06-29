<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Insurance\Policy;

trait HasPolicyData
{
    public Policy $policy;

    public function validatePolicy()
    {
        return [
            'policy.company_id' => '',
            'policy.product_id' => '',
            'policy.name_cia' => '',
            'policy.reference' => '',
            'policy.cond_particular' => '',
        ];
    }

    public function initializePolicy($policy)
    {
        $this->policy = $policy
            ? $policy
            : Policy::make(['company_id' => '', 'product_id' => '']);
    }

    public function checkPolicy($value)
    {
        $referenceTransformed = preg_replace('/[^a-zA-Z0-9]/', '', strtoupper($value));

        return $this->company->checkPolicyExists($referenceTransformed);
    }
}
