<?php

namespace App\Http\Livewire\Insurance;

use Livewire\Component;

class Agents extends Component
{
    public \App\Models\Insurance\Company $company;

    protected $listeners = ['reloadAgents'];

    public function mount(\App\Models\Insurance\Company $company)
    {
        $this->company = $company;
    }

    public function reloadAgents()
    {
        $this->company->load('agents');
    }

    public function render()
    {
        return view('livewire.insurance.agents');
    }
}
