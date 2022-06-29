<?php

namespace App\Http\Livewire\Administration;

use App\Models\Insurance\Product;
use Livewire\Component;

class DefaultProducts extends Component
{
    public $newProduct;

    protected $rules = [
        'newProduct' => '',
    ];

    public function create()
    {
        $this->validate(['newProduct' => 'required|min:5']);
        Product::create([
            'company_id' => 0,
            'ramo_id' => 0,
            'name' => $this->newProduct,
        ]);
        $this->products = Product::where('company_id', 0)->get();
        $this->newProduct = '';
    }

    public function render()
    {
        return view('livewire.administration.default-products', [
            'products' => Product::where('company_id', 0)->get(),
        ]);
    }
}
