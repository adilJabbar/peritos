<?php

namespace App\Http\Livewire\Administration;

use App\Models\Admin\Country;
use App\Models\Admin\Ramo;
use App\Models\Admin\Typecase;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithFilters;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Countries extends Component
{
    use WithFileUploads,
        WithFileDelete,
        WithPerPagePagination,
        WithSorting,
        WithBulkActions,
        WithFilters;

    public $showFilters;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $isNew = true;

    public Country $country;

    public $filters = [
        'code' => '',
        'search' => '',
    ];

    public Ramo $ramoSelected;

    public $ramoSelectedNewIcon;

    public $newRamo;

    public $newTypecase;

    public $newCapital;

    protected $listeners = ['typeCasesUpdated', 'capitalsUpdated'];

    public function rules()
    {
        return [
            'country.name' => 'required',
            'country.code' => 'required',
            'country.taxes' => 'required',
            'country.precio_m' => '',
            'country.furniture' => '',
            'country.room' => '',
            'country.person' => '',
            'country.anexo' => '',
            'country.currency_id' => 'required|exists:App\Models\Admin\Currency,id',
            'flag' => '',
            'newRamo' => '',
            'ramoSelected.name' => '',
            'ramoSelected.preexistence_class_id' => '',
        ];
    }

    public function mount()
    {
        $this->resetToBlankCountry();
        $this->ramoSelected = Ramo::make();
    }

    public function updatedRamoSelected()
    {
        $this->reset('ramoSelectedNewIcon');
    }

    public function resetToBlankCountry()
    {
        $this->country = Country::make(['currency_id' => '']);
        $this->isNew = true;
        $this->flag = null;
        $this->ramoSelected = Ramo::make(['preexistence_class_id' => 0]);
        $this->ramoSelectedNewIcon = null;
    }

    public function create()
    {
        if ($this->country->getKey()) {
            $this->resetToBlankCountry();
        }
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function edit(Country $country)
    {
        if ($this->country->isNot($country)) {
            $this->resetErrorBag();
            $this->country = $country;
            $this->reset('flag');
        }
    }

    public function view($country)
    {
        return redirect(route('administration.country.show', $country));
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->selected = [];
        $this->showDeleteModal = false;
    }

    public function addRamo()
    {
        $this->validate(['newRamo' => 'required|min:3']);
        $this->country->ramos()->create(['name' => $this->newRamo]);
        $this->reset('newRamo');
        $this->country->load('ramos');
    }

    public function selectRamo(Ramo $ramoSelected)
    {
        $this->ramoSelected = $ramoSelected;
        $this->reset('ramoSelectedNewIcon');
    }

    public function saveRamoSelected()
    {
        $this->validate([
            'ramoSelected.name' => 'required|min:3',
        ]);
        $this->ramoSelected->save();
        $this->ramoSelectedNewIcon
            && $this->deleteFile('public', $this->ramoSelected->icon)
            && $this->ramoSelected->update(['icon' => $this->ramoSelectedNewIcon->store('img/icons', 'public')])
            && $this->reset('ramoSelectedNewIcon');
        $this->country->load('ramos');
        $this->notify(__('Guardado'), __('Se han actualizado los datos del ramo'));
    }

    public function deleteRamo(Ramo $ramo)
    {
        $ramo->delete();
        $this->country->load('ramos');
        $this->ramoSelected = Ramo::make(['preexistence_class_id' => '']);
    }

    public function addTypecase()
    {
        $this->validate(['newTypecase' => 'required|min:3']);
        $this->ramoSelected->typecases()->create([
            'name' => $this->newTypecase,
        ]);
        $this->reset('newTypecase');
        $this->ramoSelected->load('typecases');
    }

    public function typeCasesUpdated()
    {
        $this->ramoSelected->load('typecases');
    }

    public function capitalsUpdated()
    {
        $this->ramoSelected->capitals->fresh();
    }

    public function deleteTypecase(Typecase $typecase)
    {
        $typecase->delete();
        $this->ramoSelected->load('typecases');
    }

    public function getRowsQueryProperty()
    {
        return Country::query()
            ->when($this->filters['code'], fn ($query, $code) => $query->search('code', $code))
            ->when($this->filters['search'], fn ($query, $search) => $query->search('name', $search));
    }

    public function getRowsProperty()
    {
        $rowsQuery = $this->applySorting($this->rowsQuery);

        return $this->applyPagination($rowsQuery);
    }

    public function render()
    {
        return view('livewire.administration.countries', [
            'countries' => $this->rows,
        ]);
    }
}
