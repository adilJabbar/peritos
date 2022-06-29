<?php

namespace App\Http\Livewire\Insurance\Product;

use Livewire\Component;

class Subguarantee extends Component
{
    public \App\Models\Insurance\Subguarantee $subguarantee;

    public $percent;

    public $hasLimit = false;

    public $hasDeductible = false;

    protected $listeners = ['subguaranteeSelected', 'noneSubguaranteSelected'];

//    protected $queryString = ['subguarantee'];

    protected $rules = [
        'subguarantee.coverage' => '',
        'subguarantee.name' => 'required',
        'subguarantee.percent_limit' => '',
        'subguarantee.limit' => '',
        'subguarantee.percent_deductible' => '',
        'subguarantee.min_deductible' => '',
        'subguarantee.max_deductible' => '',
        'subguarantee.required_capital' => '',
        'subguarantee.notes' => '',
        'subguarantee.included' => '',
        'percent' => '',
    ];

    public function mount($subguarantee)
    {
        if ($subguarantee) {
            $this->mountSubguarantee($subguarantee);
        } else {
            $this->resetSubguarantee();
        }
    }

    public function updatedHasDeductible($value)
    {
        if (! $value) {
            $this->subguarantee->percent_deductible = null;
            $this->subguarantee->min_deductible = null;
            $this->subguarantee->max_deductible = null;
            $this->subguarantee->save();
        }
    }

    public function updatedHasLimit($value)
    {
        if (! $value) {
            $this->subguarantee->percent_limit = null;
            $this->subguarantee->limit = null;
            $this->subguarantee->save();
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->subguarantee->save();
    }

    public function updatedPercent()
    {
        $this->subguarantee->percent_covered = $this->percent;
//        $this->subguarantee->save();
    }

    public function updatedSubguaranteeCoverage()
    {
        if ($this->subguarantee->coverage === 'total' || $this->subguarantee->coverage === 'primer riesgo') {
            $this->subguarantee->percent_covered = 100;
        }
//        $this->subguarantee->save();
    }

    public function noneSubguaranteSelected()
    {
        $this->resetSubguarantee();
    }

    public function subguaranteeSelected(\App\Models\Insurance\Subguarantee $subguarantee)
    {
        $this->mountSubguarantee($subguarantee);
    }

    public function mountSubguarantee($subguarantee)
    {
        $this->subguarantee = $subguarantee;
        $this->percent = $this->subguarantee->percent_covered;
        $this->hasLimit = $this->subguarantee->limit !== null;
        $this->hasDeductible = $this->subguarantee->has_deductible;
//        $this->subguarantee->required_capital === null && $this->subguarantee->required_capital = '';
    }

    public function resetSubguarantee()
    {
        $this->subguarantee = \App\Models\Insurance\Subguarantee::make(['coverage' => '', 'required_capital' => '']);
    }

    public function render()
    {
        return view('livewire.insurance.product.subguarantee');
    }
}
