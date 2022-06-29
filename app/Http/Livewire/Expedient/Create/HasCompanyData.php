<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Insurance\Company;

trait HasCompanyData
{
    public Company $company;

    public function validateCompany()
    {
        return [
            'company.legal_id' => '',
            'company.name' => 'required|min:3',
            'company.legal_name' => '',
        ];
    }

    public function initializeCompany($companyId)
    {
        $this->company = $companyId
            ? Company::find($companyId)
            : Company::make();
    }
}
