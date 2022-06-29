<?php

namespace App\Http\Livewire\Insurance\Product;

use App\Models\Insurance\Company;
use App\Models\Insurance\Product;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductData extends Component
{
    use WithFileUploads, WithFileDelete;

    public Product $product;

    public Company $company;

    public $condGeneral;

    protected $rules = [
        'product.name' => 'required',
        'product.code' => '',
        'product.current_version' => '',
        'product.notes' => '',
        'product.ramo_id' => 'required',
        'product.company_id' => 'required',
        'product.guarantee_order' => '',
        'product.cond_general' => '',
        'product.active' => 'boolean|required',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->company = $this->product->company ?? Company::make();
    }

    public function save()
    {
        $this->validate();
        $this->product->save();
        $this->condGeneral
        && $this->deleteFile('products', $this->product->cond_general)
        && $this->product->update([
            'cond_general' => $this->condGeneral->store('/', 'products'),
        ]);
        $this->notify(__('Guardado'), __('Los datos del producto se han actualizado'));
    }

    public function removeCondGeneral()
    {
        $this->deleteFile('products', $this->product->cond_general);
        $this->product->update(['cond_general' => null]);
    }

    public function render()
    {
        return view('livewire.insurance.product.product-data');
    }
}
