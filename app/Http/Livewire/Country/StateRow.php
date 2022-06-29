<?php

namespace App\Http\Livewire\Country;

use App\Models\Admin\State;
use Livewire\Component;

class StateRow extends Component
{
    public State $state;

    protected $rules = [
        'state.name' => 'required',
        'state.national_adjustment' => 'required',
    ];

    public function mount($state)
    {
        $this->state = $state;
    }

    public function delete()
    {
        $this->state->delete();
        $this->emit('statesUpdated');
    }

    public function updated()
    {
        $this->validate();
        $this->state->save();
    }

    public function render()
    {
        return view('livewire.country.state-row');
    }
}
