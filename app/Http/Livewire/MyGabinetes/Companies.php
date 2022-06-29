<?php

namespace App\Http\Livewire\MyGabinetes;

use App\Models\Gabinete;
use App\Models\Insurance\Company;
use Livewire\Component;

class Companies extends Component
{
    public Gabinete $gabinete;

    public $company;

    protected $listeners = ['refreshCompanies' => '$refresh', 'showCompany'];

    public function mount($gabinete, $company = null)
    {
        $this->gabinete = $gabinete;
        $this->company = Company::find($company);
    }

    public function showCompany(Company $company)
    {
        $this->company = $company;
    }

    public function unselectCompany()
    {
        dd('estoy aqui');
    }

    public function render()
    {
        return $this->company
            ? view('livewire.my-gabinetes.company')
            : view('livewire.my-gabinetes.companies');
    }
}
