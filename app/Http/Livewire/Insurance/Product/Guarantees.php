<?php

namespace App\Http\Livewire\Insurance\Product;

use App\Models\Insurance\Product;
use Livewire\Component;

class Guarantees extends Component
{
    public Product $product;

    public $guaranteeSelectedId;

    public \App\Models\Insurance\Guarantee $guaranteeSelected;

    public $newGuarantee = null;

    protected $listeners = ['guaranteeUpdated'];

    protected $rules = [
        'guaranteeSelectedId' => '',
        'newGuarantee' => 'required|min:3',
    ];

    public function getValidationAttributes()
    {
        return [
            'newGuarantee' => __('Nueva Garantia'),
        ];
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->guaranteeSelectedId = null;
        $this->guaranteeSelected = \App\Models\Insurance\Guarantee::make();
    }

    public function updatedGuaranteeSelectedId()
    {
        $this->guaranteeSelected = \App\Models\Insurance\Guarantee::find($this->guaranteeSelectedId);
        $this->emit('guaranteeSelected', ['guarantee' => $this->guaranteeSelected->id]);
    }

    public function addNewGuarantee()
    {
        $this->validate(['newGuarantee'=>'required|min:5']);
        $this->product->guarantees()->create(['name' => $this->newGuarantee]);
        $this->newGuarantee = '';
        $this->product->load('guarantees');
    }

    public function guaranteeUpdated()
    {
        $this->product->load('guarantees');
    }

    public function render()
    {
        return view('livewire.insurance.product.guarantees');
    }
}
