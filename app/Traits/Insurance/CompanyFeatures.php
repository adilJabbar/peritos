<?php

namespace App\Traits\Insurance;

use App\Models\Address;
use App\Models\Insurance\Company;
use Illuminate\Validation\Rule;

trait CompanyFeatures
{
    public Company $company;

    public Address $billingAddress;

    public $logo;

    public function rules()
    {
        return [
            'company.name' => 'required|min:3',
            'company.legal_name' => 'required|min:3',
            'company.legal_id' => ['required', Rule::unique('companies', 'legal_id')->ignore($this->company)],
            'company.url' => 'sometimes',
            'company.is_active' => 'boolean',
            'logo' => 'nullable|image|max:1024',
            'billingAddress.name' => '',
            'billingAddress.address' => 'required',
            'billingAddress.city' => 'required',
            'billingAddress.zip' => 'required',
            'billingAddress.state' => 'required',
            'billingAddress.country_id' => 'required',
        ];
    }

    public function saveCompany()
    {
        $this->validate();

        $this->company->save();

        if (! $this->company->billingAddress) {
            $this->company->billingAddress()->create($this->billingAddress->attributesToArray());
        } else {
            $this->company->billingAddress()->update($this->billingAddress->attributesToArray());
        }

        if ($this->logo) {
            if ($this->company->logo) {
                $this->deleteFile('logos', $this->company->logo);
            }
            $this->company->update([
                'logo' => $this->logo->store('/', 'logos'),
            ]);
        }

        $this->notify(__('Guardado'), __('Se han actualizado los datos de la compañía aseguradora'));
    }
}
