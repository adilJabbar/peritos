<?php

namespace App\Http\Livewire\Insurance;

use Livewire\Component;

class Product extends Component
{
    public \App\Models\Insurance\Product $product;

    public $showSubmenu;

    protected $queryString = ['showSubmenu'];

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.insurance.product');
    }
}
