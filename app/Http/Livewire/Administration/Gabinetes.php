<?php

namespace App\Http\Livewire\Administration;

use App\Models\Gabinete;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\Gabinete\WithNewGabineteModal;
use App\Traits\WithFileDelete;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gabinetes extends Component
{
    use WithPerPagePagination,
        WithSorting,
        WithBulkActions,
        WithNewGabineteModal;

    public $showFilters;

//    public Gabinete $gabinete;
    public $filters = [
        'search' => '',
        'legal_name' => '',
        'legal_id' => '',
        'address' => '',
        'city' => '',
        'state' => null,
        'country_id' => '',
        'phone' => '',
        'email' => '',
        'active' => '',
    ];

    public function mount()
    {
        $this->resetToBlankNewGabinete();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

//    public function edit(Gabinete $gabineteSelected)
//    {
//        if($this->gabinete->isNot($gabineteSelected)){
//            $this->gabinete = $gabineteSelected;
//        }
//        $this->showEditModal = true;
//    }

    public function showGabinete($gabinete)
    {
        return redirect(route('administration.gabinete.show', $gabinete));
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->selected = [];
        $this->showDeleteModal = false;
        $this->emit('GabinetesUpdated');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery
                ->select(['name', 'legal_name', 'legal_id', 'address', 'city', 'zip', 'state', 'country_id', 'phone', 'email', 'created_at', 'is_active'])
                ->toCsv();
        }, now()->format('Y-m-d').'-Gabinetes.csv');
    }

    public function getRowsQueryProperty()
    {
        return Gabinete::query()
            ->when($this->filters['legal_name'], fn ($query, $legal_name) => $query->search('legal_name', $legal_name))
            ->when($this->filters['legal_id'], fn ($query, $cif) => $query->search('legal_id', $cif))
            ->when($this->filters['address'], fn ($query, $address) => $query->search('address', $address))
            ->when($this->filters['country_id'], fn ($query, $country_id) => $query->where('country_id', $country_id))
            ->when($this->filters['state'], fn ($query, $state) => $query->search('state', $state))
            ->when($this->filters['city'], fn ($query, $city) => $query->search('city', $city))
            ->when($this->filters['phone'], fn ($query, $phone) => $query->search('phone', $phone))
            ->when($this->filters['email'], fn ($query, $email) => $query->search('email', $email))
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
        return view('livewire.administration.gabinetes', [
            'gabinetes' => $this->rows,
        ]);
    }
}
