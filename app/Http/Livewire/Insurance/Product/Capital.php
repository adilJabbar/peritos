<?php

namespace App\Http\Livewire\Insurance\Product;

use App\Models\Insurance\Product;
use Livewire\Component;

class Capital extends Component
{
    public Product $product;

    public \App\Models\Admin\Capital $capital;

//    public $selectedCapital;
    public bool $selected = false;

    public $conditions = [];

    protected $rules = [
        'selected' => '',
        'conditions.derog_reg_prop' => '',
        'conditions.derog_amount' => '',
    ];

    public function mount($product, $capital)
    {
        $this->product = $product;
        $this->capital = $capital;

        $this->selected = $this->product->hasCapital($this->capital->id);
        $this->product->capitals()->find($capital)
            ? $this->conditions = $this->product->capitals()->find($capital)->pivot->toArray()
            : $this->resetConditions();
    }

    public function updatedSelected()
    {
        if ($this->selected) {
            $this->product->addCapital($this->capital->id);
        } else {
            $this->resetConditions();
            $this->product->removeCapital($this->capital->id);
        }
    }

    public function updated($field)
    {
        if ($field === 'conditions.derog_amount' || $field === 'conditions.derog_percent') {
            if (! $this->selected) {
                $this->selected = true;
                $this->product->addCapital($this->capital->id);
            }
            $this->conditions['derog_reg_prop'] = true;
            $this->storeConditions();
        }
    }

    public function updatedConditionsDerogRegProp()
    {
        if ($this->conditions['derog_reg_prop'] === false) {
            $this->resetConditions();
        } else {
            $this->selected = true;
            $this->product->addCapital($this->capital->id);
        }
        $this->storeConditions();
    }

    public function resetConditions()
    {
        $this->conditions = ['derog_reg_prop' => false, 'derog_amount' => null, 'derog_percent' => null];
    }

    public function storeConditions()
    {
        $this->product->capitals()->updateExistingPivot($this->capital, $this->conditions);
    }

    public function render()
    {
        return view('livewire.insurance.product.capital');
    }
}
