<?php

namespace App\Http\Livewire\Insurance\Product;

use App\Models\Insurance\Product;
use Livewire\Component;

class Capitals extends Component
{
    public Product $product;

    public $capitals;

    public $newCapital;
//    public $selected = [];

    protected $listeners = ['updateCapitals' => '$refresh'];

    protected $rules = [
        'newCapital' => 'required',
    ];

    public function mount($product)
    {
        $this->product = $product;
        $this->capitals = $this->product->ramo->capitals;
        $this->newCapital = '';
//        $this->selected = $this->product->capitals->pluck('id')->map(fn($id) => (string) $id);
    }

//    public function updatedSelected()
//    {
//        $this->product->capitals()->sync($this->selected);
//    }

    public function addNewCapital()
    {
        $this->validate();
        $capital = $this->product->ramo->capitals()->create([
            'name' => $this->newCapital,
            'position' => ($this->product->ramo->capitals->max('position') + 1),
        ]);
        $this->product->capitals()->attach($capital);
        $this->product->load('capitals');
        $this->capitals = $this->product->ramo->load('capitals')->capitals;
        $this->newCapital = '';
    }

    public function render()
    {
        return view('livewire.insurance.product.capitals');
    }
}
