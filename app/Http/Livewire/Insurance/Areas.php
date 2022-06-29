<?php

namespace App\Http\Livewire\Insurance;

use App\Models\Insurance\Company\Area;
use Livewire\Component;

class Areas extends Component
{
    public \App\Models\Insurance\Company $company;

    public bool $showNewArea = false;

    public Area $area;

    protected $rules = [
        'area.company_id' => 'required',
        'area.name' => 'required',
    ];

    public function mount($company)
    {
        $this->company = $company;
        $this->area = $this->company->areas()->make();
    }

    public function save()
    {
        $this->validate();
        $this->area->save();
        $this->area = $this->company->areas()->make();
        $this->emit('UpdateAreas');
        $this->notify(__('Guardado'), __('El núevo área de :Company ha sido creado', ['company' => $this->company->name]));
        $this->showNewArea = false;
        $this->company->load('areas');
    }

    public function render()
    {
        return view('livewire.insurance.areas');
    }
}
