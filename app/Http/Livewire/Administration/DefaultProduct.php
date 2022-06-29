<?php

namespace App\Http\Livewire\Administration;

use Livewire\Component;

class DefaultProduct extends Component
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
        return view('livewire.administration.default-product');
    }
}
