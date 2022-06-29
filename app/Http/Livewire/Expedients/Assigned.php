<?php

namespace App\Http\Livewire\Expedients;

use App\Models\Expedient;
use App\Models\Gabinete;
use App\Models\User;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use Livewire\Component;

class Assigned extends Component
{
    use WithSorting, WithBulkActions, WithPerPagePagination;

    public User $adjuster;

    public $showFilters;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $sorts = [];

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
        'adjuster_id' => '',
    ];

    public $gabinete;

    public $showSubmenu;

    public function mount($user = null)
    {
        $this->adjuster = $user ?: auth()->user();
        ! $this->showSubmenu ? $this->showSubmenu = 'Active' : '';
    }

    public function createCompany()
    {
        return redirect(route('expedient.createCompany'));
    }

    public function createParticular()
    {
        return redirect(route('expedient.createParticular'));
    }

    public function open(Expedient $expedient)
    {
        if ($expedient->status->name === 'Finalizar Alta') {
            return redirect()->route('expedient.new_expedient', ['expedient' => $expedient->id]);
        } else {
            return redirect(route('expedient.edit', $expedient));
        }
    }

    public function view($expedient)
    {
        return redirect(route('expedient.show', $expedient));
    }

    public function getRowsQueryProperty()
    {
        return Expedient::query()
            ->where('adjuster_id', $this->adjuster->id)
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

//            ->when(auth()->user()->can('gabinete.expedients.view'), function($query){
//                $query->where('gabinete_id', '1');
//            });
    }

    public function getRowsProperty()
    {
        $rowsQuery = $this->applySorting($this->rowsQuery);

        return $this->applyPagination($rowsQuery);
    }

    public function render()
    {
        return view('livewire.expedients.assigned', [
            'expedients' => $this->rows,
            'adjuster' => $this->adjuster,
        ]);
    }
}
