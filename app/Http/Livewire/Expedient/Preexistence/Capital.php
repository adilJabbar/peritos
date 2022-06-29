<?php

namespace App\Http\Livewire\Expedient\Preexistence;

use Livewire\Component;

class Capital extends Component
{
    public \App\Models\Admin\Capital $capital;

    protected $rules = [
        'capital.pivot.amount' => '',
        'capital.pivot.primer_riesgo' => '',
        'capital.pivot.resposicion' => '',
        'capital.pivot.deprecation' => '',
    ];

    public function mount(\App\Models\Admin\Capital $capital)
    {
        $this->capital = $capital;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->capital->policies()->updateExistingPivot($this->capital->pivot['policy_id'], $this->capital->pivot);
    }

    public function render()
    {
        return view('livewire.expedient.preexistence.capital');
    }
}
