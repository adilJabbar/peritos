<?php

namespace App\Http\Livewire\Policy;

use App\Models\Admin\Capital;
use App\Models\Insurance\Policy;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Integer;

class CapitalRow extends Component
{
    public Capital $capital;

    public Policy $policy;

    public int $assesments;

    public $showCapital = false;

    protected $listeners = ['CapitalLoadPolicy'];

    protected $rules = [
        'capital.pivot.use' => 'boolean',
        'capital.pivot.amount' => 'numeric',
        'capital.pivot.primer_riesgo' => 'boolean',
    ];

    public function mount($capital, $policy, $assesments)
    {
        $this->policy = $policy;
        $this->assesments = $assesments;
        if ($this->policy->capitals->find($capital)) {
            $this->capital = $this->policy->capitals->find($capital);
            $this->showCapital = true;
        } else {
            $this->capital = $capital;
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        if ($field === 'showCapital') {
            if ($this->showCapital) {
                $this->policy->capitals()->attach($this->capital->id);
                $this->policy->load('capitals');
                $this->capital = $this->policy->capitals->find($this->capital->id);
            } else {
                if ($this->assesments) {
                    $this->notify(__('Error'), __('No se puede eliminar el capital porque tiene valoraciones asignadas'), 'error');
                    $this->showCapital = true;
                } else {
                    $this->policy->capitals()->detach($this->capital->id);
                }
            }
        }
        $this->policy->capitals()->updateExistingPivot($this->capital->id, [
            'amount' => $this->capital->pivot['amount'],
            'primer_riesgo' => $this->capital->pivot['primer_riesgo'],
        ]);
    }

    public function CapitalLoadPolicy(Policy $policy)
    {
        $this->policy = $policy;
    }

    public function render()
    {
        return view('livewire.policy.capital-row');
    }
}
