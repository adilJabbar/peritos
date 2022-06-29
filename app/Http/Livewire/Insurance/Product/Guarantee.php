<?php

namespace App\Http\Livewire\Insurance\Product;

use App\Models\Insurance\Subguarantee;
use Livewire\Component;

class Guarantee extends Component
{
    public \App\Models\Insurance\Guarantee $guarantee;

    public $activeSubguarantee;

    public Subguarantee $subguarantee;

    public $newSubguarantee;

    protected $listeners = ['guaranteeSelected'];

    protected $rules = [
        'guarantee.name' => 'required|min:3',
        'guarantee.notes' => 'min:5',
        'guarantee.exclusions' => 'min:5',
    ];

    public function getValidationAttributes()
    {
        return [
            'guarantee.name' => __('Nombre de la garantia'),
        ];
    }

    public function mount($guarantee)
    {
//        $this->resetValidation('guarantee.name');
//        $this->resetErrorBag('guarantee.name');
        $this->guarantee = $guarantee;
        $this->subguarantee = Subguarantee::make();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->guarantee->save();
    }

    public function updatedGuaranteeName()
    {
        $this->validate(['guarantee.name' => 'required|min:3']);
        $this->guarantee->save();
        $this->emitUp('guaranteeUpdated');
    }

    public function updatedActiveSubguarantee()
    {
        $this->subguarantee = Subguarantee::find($this->activeSubguarantee);
        $this->emit('subguaranteeSelected', $this->subguarantee->id);
    }

    public function addNewSubguarantee()
    {
        $new = $this->guarantee->subguarantees()->create(['name' => $this->newSubguarantee]);
        $this->newSubguarantee = '';
        $this->guarantee->load('subguarantees');
        $this->activeSubguarantee = $new->id;
        $this->updatedActiveSubguarantee();
    }

    public function guaranteeSelected(\App\Models\Insurance\Guarantee $guarantee)
    {
        $this->guarantee = $guarantee;
        $this->emit('noneSubguaranteSelected');
    }

    public function render()
    {
        return view('livewire.insurance.product.guarantee');
    }
}
