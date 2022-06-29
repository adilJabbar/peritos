<?php

namespace App\Http\Livewire\Administration\Company;

use App\Models\Address;
use App\Traits\Insurance\CompanyFeatures;
use App\Traits\WithFileDelete;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, WithFileDelete, CompanyFeatures;

    public \App\Models\Insurance\Company $company;

    public $showSubmenu;

    public $logo;

    public Address $billingAddress;

    protected $queryString = ['showSubmenu'];

    protected $listeners = ['reloadAgents' => '$refresh', 'UpdateAreas' => '$refresh'];

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

    public function mount(\App\Models\Insurance\Company $company)
    {
        $this->company = $company;
        $this->billingAddress = $this->company->billingAddress;
    }

    public function render()
    {
        return view('livewire.administration.company.edit');
    }
}
