<?php

namespace App\Http\Livewire\Insurance\Agent;

use App\Models\Insurance\Agent;
use Livewire\Component;

class Row extends Component
{
    public Agent $agent;

    protected $rules = [
        'agent.name' => 'required',
        'agent.phone' => '',
        'agent.phone2' => '',
        'agent.email' => 'email',
    ];

    public function mount($agent)
    {
        $this->agent = $agent;
    }

    public function activate()
    {
        $this->agent->update(['is_active' => true]);
        $this->emit('reloadAgents');
    }

    public function delete()
    {
        $this->agent->update(['is_active' => false]);
        $this->emit('reloadAgents');
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->agent->save();
    }

    public function render()
    {
        return view('livewire.insurance.agent.row');
    }
}
