<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Expedient;
use App\Models\Person;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\Expedient\ExpedientTable;
use Livewire\Component;

class Expedients extends Component
{
    use WithSorting, WithBulkActions, WithPerPagePagination;

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
    ];

    public $assignedExpedients;

    public $collaboratorExpedients;

    public $gabinetesExpedients;

    public $showSubmenu;

    protected $queryString = ['showSubmenu'];

    public function mount()
    {
        ! $this->showSubmenu ? $this->showSubmenu = 'Assigned expedients' : '';
        $this->assignedExpedients = auth()->user()->expedients;
        $this->collaboratorExpedients = auth()->user()->collaborationExpedients;
        $this->gabinetesExpedients = auth()->user()->gabinetesExpedients();
    }

    public function updatedShowSubmenu()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

//    public function createCompany()
//    {
//        return redirect(route('expedient.createCompany'));
//    }
//
//    public function createParticular()
//    {
//        return redirect(route('expedient.createParticular'));
//    }

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

//
    public function getRowsQueryProperty()
    {
        if ($this->showSubmenu === 'Assigned expedients') {
            $expedientsQuery = Expedient::query();
            $expedientsQuery = auth()->user()->expedients();
        } elseif ($this->showSubmenu === 'Collaborator expedients') {
            $expedientsQuery = auth()->user()->collaborationExpedients();
        } elseif ($this->showSubmenu === 'Gabinetes expedients') {
            $expedientsQuery = auth()->user()->gabinetesExpedientsQuery();
        } else {
            $expedientsQuery = Expedient::query();
        }

        return $expedientsQuery
            ->when($this->filters['legal_name'], fn ($query, $legalName) => $query->whereIn('person_id', Person::search('legal_name', $legalName)->pluck('id')))
//            ->when($this->filters['legal_name'], fn($query, $legal_name) => $query->search('legal_name', $legal_name))
            ->when($this->filters['legal_id'], fn ($query, $legalId) => $query->whereIn('person_id', Person::search('legal_id', $legalId)->pluck('id')))
            ->when($this->filters['address'], fn ($query, $address) => $query->whereIn('address_id', Address::search('address', $address)->pluck('id')))
            ->when($this->filters['country_id'], fn ($query, $country_id) => $query->whereIn('address_id', Address::search('country_id', $country_id)->pluck('id')))
            ->when($this->filters['state'], fn ($query, $state) => $query->whereIn('address_id', Address::search('state', $state)->pluck('id')))
            ->when($this->filters['city'], fn ($query, $city) => $query->whereIn('address_id', Address::search('city', $city)->pluck('id')))
            ->when($this->filters['phone'], fn ($query, $phone) => $query->whereIn('person_id', Contact::search('value', $phone)->pluck('contactable_id')))
            ->when($this->filters['email'], fn ($query, $email) => $query->whereIn('person_id', Contact::search('value', $email)->pluck('contactable_id')))
            ->when($this->filters['search'], fn ($query, $search) => $query->whereIn('person_id', Person::search('name', $search)->pluck('id')))
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
        return view('livewire.expedients', ['expedients' => $this->rows]);
    }
}
