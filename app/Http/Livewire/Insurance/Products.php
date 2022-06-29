<?php

namespace App\Http\Livewire\Insurance;

use App\Models\Admin\Ramo;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithFileUploads, WithPerPagePagination, WithSorting;

    public \App\Models\Insurance\Company $company;

    public $selectedRamo;

    public Ramo $ramo;

    public $condGeneral;

    public $showNewProductModal = false;

    public \App\Models\Insurance\Product $product;

    public function rules()
    {
        return [
            'selectedRamo' => '',
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
    }

    public function mount(\App\Models\Insurance\Company $company)
    {
        $this->company = $company;
        $this->selectedRamo = '';
        $this->resetNewProduct();
    }

    public function updatedSelectedRamo()
    {
        if ($this->selectedRamo && $this->selectedRamo !== 'all') {
            $this->ramo = Ramo::find($this->selectedRamo);
        }
    }

    public function addNewProduct()
    {
        $this->resetNewProduct();
        $this->showNewProductModal = true;
    }

    public function getRowsQueryProperty()
    {
        return \App\Models\Insurance\Product::query()
            ->where('company_id', $this->company->id)
            ->when($this->selectedRamo, fn ($query, $selectedRamo) => $query->where('ramo_id', $selectedRamo));
    }

    public function getRowsProperty()
    {
        $rowsQuery = $this->applySorting($this->rowsQuery);

        return $this->applyPagination($rowsQuery);
    }

    public function openProduct($productId)
    {
        return redirect()->route('product.show', ['product' => $productId]);
    }

    public function resetNewProduct()
    {
        $this->product = $this->company->products()->make(['ramo_id' => '', 'active' => true]);
    }

    public function save()
    {
        $this->validate();
        $this->product->save();
        if ($this->condGeneral) {
            $this->product->update([
                'cond_general' => $this->condGeneral->store('/', 'products'),
            ]);
        }
        $this->company->load('products');
        $this->showNewProductModal = false;
        $this->resetNewProduct();
    }

    public function render()
    {
//        dd($this->rowsQuery->get());
        return view('livewire.insurance.products', [
            'products' => $this->rows,
        ]);
    }
}
