<?php

namespace App\Http\Livewire\Insurance;

use App\Models\Address;
use App\Models\Gabinete;
use App\Models\Insurance\Company;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithFilters;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\Insurance\CompanyFeatures;
use App\Traits\WithFileDelete;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Companies extends Component
{
    use WithFileUploads,
        WithFileDelete,
        WithPerPagePagination,
        WithSorting,
        WithBulkActions,
        WithFilters,
        CompanyFeatures;

    public $showFilters;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $isNew = true;

    public $filters = [
        'search' => '',
        'legal_name' => '',
        'legal_id' => '',
        'country_id' => '',
        'active' => '',
    ];

    public function mount()
    {
        $this->resetToBlankCompany();
    }

    public function resetToBlankCompany()
    {
        $this->company = Company::make(['is_active' => 1]);
        $this->billingAddress = Address::make(['country_id' => '']);
        $this->isNew = true;
        $this->logo = null;
    }

    public function create()
    {
        if ($this->company->getKey()) {
            $this->resetToBlankCompany();
        }
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function edit(Company $companySelected)
    {
        if ($this->company->isNot($companySelected)) {
            $this->resetErrorBag();
            $this->company = $companySelected;
//            dd($this->billingAddress);
            $this->company->billingAddress && $this->billingAddress = $this->company->billingAddress;
        }
        $this->showEditModal = true;
    }

    public function view($company)
    {
        return redirect(route('company.show', $company));
    }

    public function save()
    {
        $this->saveCompany();

        $this->showEditModal = false;

        $this->resetToBlankCompany();

        ! $this->company->getKey() && $this->emit('CompaniesUpdated');
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->selected = [];
        $this->showDeleteModal = false;
        $this->emit('CompaniesUpdated');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery
                ->select(['name', 'legal_name', 'legal_id', 'url', 'logo', 'created_at', 'is_active'])
                ->toCsv();
        }, now()->format('Y-m-d').'-Companies.csv');
    }

    public function getRowsQueryProperty()
    {
        return Company::query()
            ->when($this->filters['legal_name'], fn ($query, $legal_name) => $query->search('legal_name', $legal_name))
            ->when($this->filters['legal_id'], fn ($query, $legal_id) => $query->search('legal_id', $legal_id))
            ->when($this->filters['country_id'], fn ($query, $country_id) => $query->where('country_id', $country_id))
            ->when($this->filters['search'], fn ($query, $search) => $query->search('name', $search))
            ->when($this->filters['active'] != '', function ($query) {
                $query->where('is_active', $this->filters['active']);
            });
    }

    public function getRowsProperty()
    {
        $rowsQuery = $this->applySorting($this->rowsQuery);

        return $this->applyPagination($rowsQuery);
    }

    public function render()
    {
        return view('livewire.insurance.companies', [
            'companies' => $this->rows,
        ]);
    }
}
