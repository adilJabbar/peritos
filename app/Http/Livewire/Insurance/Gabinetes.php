<?php

namespace App\Http\Livewire\Insurance;

use App\Models\Gabinete;
use Livewire\Component;

class Gabinetes extends Component
{
    public \App\Models\Insurance\Company $company;

    public $addGabinete;

    protected $rules = [
        'addGabinete' => 'required',
    ];

    public function mount($company)
    {
        $this->company = $company;
        $this->addGabinete = '';
    }

    public function updatedAddGabinete()
    {
        $this->company->gabinetes()->attach($this->addGabinete);
        $this->company->load('gabinetes');
        $this->addGabinete = '';
    }

    public function removeGabinete($value)
    {
        $this->company->gabinetes()->detach($value);
        $this->company->load('gabinetes');
    }

    public function render()
    {
        return view('livewire.insurance.gabinetes', [
            'gabinetes' => Gabinete::all(),
        ]);
    }
}
