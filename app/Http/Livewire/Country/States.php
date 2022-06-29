<?php

namespace App\Http\Livewire\Country;

use App\Models\Admin\Country;
use App\Models\Admin\Ramo;
use Livewire\Component;

class States extends Component
{
    public Country $country;

    public $newState;

    protected $listeners = ['statesUpdated'];

    public function mount($country)
    {
        $this->country = $country;
    }

    public function addState()
    {
        $this->validate(['newState' => 'required|min:3']);
        $this->country->states()->create(['name' => $this->newState, 'national_adjustment' => 1]);
        $this->emit('statesUpdated');
    }

    public function statesUpdated()
    {
        $this->country->load('states');
    }

    public function render()
    {
        return view('livewire.country.states');
    }
}
