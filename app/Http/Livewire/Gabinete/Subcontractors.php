<?php

namespace App\Http\Livewire\Gabinete;

use App\Models\Gabinete;
use App\Models\Subcontractor;
use App\Models\User;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\User\WithNewUserModal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Subcontractors extends Component
{
    use WithPerPagePagination,
        WithSorting,
        WithBulkActions;

    public Gabinete $gabinete;

    public $showFilters;

    public $showNewSubcontractor = false;

    public Subcontractor $subcontractor;

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
    ];

    public function rules()
    {
        return [
            'subcontractor.gabinete_id' => 'required|exists:gabinetes,id',
            'subcontractor.name' => 'required|min:3',
            'subcontractor.legal_name' => 'min:3',
            'subcontractor.legal_id' => '',
            'subcontractor.address' => '',
            'subcontractor.city' => '',
            'subcontractor.zip' => '',
            'subcontractor.state' => '',
            'subcontractor.country_id' => 'required',
            'subcontractor.phone' => 'string|min:7',
            'subcontractor.email' => ['required', 'email', Rule::unique('subcontractors', 'email')->ignore($this->subcontractor)],
        ];
    }

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
        $this->subcontractor = $this->gabinete->subcontractors()->make(['country_id' => '']);
    }

    public function edit($subcontractorId)
    {
        redirect()->route('my_gabinetes.subcontractor.show', ['gabinete' => $this->gabinete->id, 'subcontractor' => $subcontractorId]);
    }

    public function getRowsQueryProperty()
    {
        $query = Subcontractor::query()
            ->where('gabinete_id', $this->gabinete->id)->when($this->filters['legal_name'], fn ($query, $legal_name) => $query->search('legal_name', $legal_name))
            ->when($this->filters['legal_id'], fn ($query, $cif) => $query->search('legal_id', $cif))
            ->when($this->filters['address'], fn ($query, $address) => $query->search('address', $address))
            ->when($this->filters['country_id'], fn ($query, $country_id) => $query->where('country_id', $country_id))
            ->when($this->filters['state'], fn ($query, $state) => $query->search('state', $state))
            ->when($this->filters['city'], fn ($query, $city) => $query->search('city', $city))
            ->when($this->filters['phone'], fn ($query, $phone) => $query->search('phone', $phone))
            ->when($this->filters['email'], fn ($query, $email) => $query->search('email', $email))
            ->when($this->filters['search'], fn ($query, $search) => $query->search('name', $search));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function save()
    {
        $this->validate();
        $this->subcontractor->save();
        $this->notify(__('Guardado'), __('La subcontrata ha sido creada'));
        $this->showNewSubcontractor = false;
        $this->subcontractor = $this->gabinete->subcontractors()->make(['country_id' => '']);
    }

    public function render()
    {
        return view('livewire.gabinete.subcontractors', [
            'subcontractors' => $this->rows,
        ]);
    }
}
