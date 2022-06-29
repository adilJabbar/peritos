<?php

namespace App\Http\Livewire\Insurance;

use App\Models\Admin\Ramo;
use Livewire\Component;

class Ramos extends Component
{
    public \App\Models\Insurance\Company $company;

    public $addRamo;

    protected $rules = [
        'addRamo' => 'required',
    ];

    public function mount(\App\Models\Insurance\Company $company)
    {
        $this->company = $company;
        $this->addRamo = '';
    }

    public function updatedAddRamo()
    {
        $this->company->ramos()->attach($this->addRamo);
        $this->addRamo = '';
        $this->company->load('ramos');
    }

    public function removeRamo($ramoId)
    {
        $this->company->ramos()->detach($ramoId);
        $this->company->load('ramos');
    }

    public function render()
    {
        return view('livewire.insurance.ramos');
    }
}
