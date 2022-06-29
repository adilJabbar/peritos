<?php

namespace App\Http\Livewire\Expedient\Preexistence;

use App\Models\Admin\Currency;
use Livewire\Component;

class CapitalRow extends Component
{
    public Currency $currency;

    public $capital;

    public $policy;

    public $insured;

    public $selected = false;

    protected $listeners = ['continentUpdated', 'contentUpdated'];

    protected $rules = [
        'selected' => '',
        'insured.pivot.amount' => '',
        'insured.pivot.primer_riesgo' => '',
        'insured.pivot.perc_cia' => '',
        'insured.pivot.reposicion' => '',
        'insured.pivot.deprecation' => '',
    ];

    public function mount($currency, $capital, $policy)
    {
        $this->currency = $currency;
        $this->capital = $capital;
        $this->policy = $policy;
        $this->insured = $this->policy->capitals->where('id', $this->capital->id)->first();
        if ($this->insured) {
            $this->selected = true;
        }
    }

    public function updatedSelected($value)
    {
        if ($value) {
            $this->policy->capitals()->attach($this->capital);
            $this->policy->load('capitals');
            $this->insured = $this->policy->capitals->where('id', $this->capital->id)->first();
        } else {
            $this->policy->capitals()->detach($this->capital);
        }
    }

    public function updated($field)
    {
        if ($this->selected && $field != 'selected') {
            $this->policy->capitals()->updateExistingPivot($this->capital->id, [
                'amount' => $this->insured->pivot['amount'],
                'primer_riesgo' => $this->insured->pivot['primer_riesgo'],
                'perc_cia' => $this->insured->pivot['perc_cia'],
                'reposicion' => $this->insured->pivot['reposicion'],
                'deprecation' => $this->insured->pivot['deprecation'],
            ]);
        }
    }

    public function continentUpdated()
    {
        if ($this->capital->predefined == 'continente') {
            $this->insured = $this->policy->capitals->where('id', $this->capital->id)->first();
        }
    }

    public function contentUpdated()
    {
        if ($this->capital->predefined == 'contenido') {
            $this->insured = $this->policy->capitals->where('id', $this->capital->id)->first();
        }
    }

    public function render()
    {
        return view('livewire.expedient.preexistence.capital-row');
    }
}
