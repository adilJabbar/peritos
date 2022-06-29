<?php

namespace App\Http\Livewire\Administration;

use App\Models\Admin\Currency;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithFilters;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Currencies extends Component
{
    use WithPerPagePagination,
        WithSorting,
        WithBulkActions,
        WithFilters;

    public Currency $currency;

    public $showFilters;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $isNew = true;

    public $filters = [
        'position' => '',
        'decimals' => '',
        'search' => '',
    ];

    public function rules()
    {
        return [
            'currency.name' => 'required',
            'currency.currency' => 'required',
            'currency.iso' => ['required', 'max:3', 'min:3', Rule::unique('currencies', 'iso')->ignore($this->currency)],
            'currency.decimal' => '',
            'currency.separator' => '',
            'currency.decimals' => 'required|numeric',
            'currency.usd_rate' => 'required|numeric',
            'currency.position' => 'required|in:after,before',
        ];
    }

    public function mount()
    {
        $this->resetToBlank();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function resetToBlank()
    {
        $this->currency = Currency::make(['position' => '', 'decimal' => '', 'separator' => '']);
        $this->isNew = true;
        $this->flag = null;
    }

    public function create()
    {
        if ($this->currency->getKey()) {
            $this->resetToBlank();
        }
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function edit(Currency $currency)
    {
        if ($this->currency->isNot($currency)) {
            $this->resetErrorBag();
            $this->currency = $currency;
        }
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->currency->save();
        $this->resetToBlank();
        $this->showEditModal = false;
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->selected = [];
        $this->showDeleteModal = false;
    }

    public function getRowsQueryProperty()
    {
        return Currency::query()
            ->when($this->filters['position'], fn ($query, $position) => $query->search('position', $position))
            ->when($this->filters['decimals'], fn ($query, $decimals) => $query->decimals('decimals', $decimals))
            ->when($this->filters['search'], fn ($query, $search) => $query->search('name', $search));
    }

    public function getRowsProperty()
    {
        $rowsQuery = $this->applySorting($this->rowsQuery);

        return $this->applyPagination($rowsQuery);
    }

    public function render()
    {
        return view('livewire.administration.currencies', [
            'currencies' => $this->rows,
        ]);
    }
}
