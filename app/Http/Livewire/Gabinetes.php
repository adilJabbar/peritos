<?php

namespace App\Http\Livewire;

use App\Models\Gabinete;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\WithFileDelete;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gabinetes extends Component
{
    use WithFileUploads,
        WithFileDelete,
        WithPerPagePagination,
        WithSorting,
        WithBulkActions;

    public $showFilters;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $sendWelcomeEmail = false;

    public $logo;

    public $logo_horiz;

    public $logo_icon;

    public Gabinete $gabinete;

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

    public function rules()
    {
        return [
            'gabinete.name' => 'required|min:3',
            'gabinete.legal_name' => 'min:3',
            'gabinete.legal_id' => '',
            'gabinete.address' => '',
            'gabinete.city' => '',
            'gabinete.zip' => '',
            'gabinete.state' => '',
            'gabinete.country_id' => 'required',
            'gabinete.phone' => 'string|min:7',
            'gabinete.email' => ['required', 'email', Rule::unique('gabinetes', 'email')->ignore($this->gabinete)],
            'gabinete.www' => 'sometimes',
            'gabinete.main_color' => 'sometimes',
            'gabinete.secondary_color' => 'sometimes',
            'gabinete.is_active' => 'boolean',
            'logo' => 'nullable|image|max:1024',
            'logo_horiz' => 'nullable|image|max:1024',
            'logo_icon' => 'nullable|image|max:512',
        ];
    }

    public function mount()
    {
        $this->resetToBlankGabinete();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function resetToBlankGabinete()
    {
        $this->gabinete = Gabinete::make(['country_id' => '', 'is_active' => 0]);
        $this->logo = null;
        $this->logo_horiz = null;
        $this->logo_icon = null;
    }

    public function create()
    {
        if ($this->gabinete->getKey()) {
            $this->resetToBlankGabinete();
        }
        $this->showEditModal = true;
    }

    public function edit(Gabinete $gabineteSelected)
    {
        if ($this->gabinete->isNot($gabineteSelected)) {
            $this->gabinete = $gabineteSelected;
        }
        $this->showEditModal = true;
    }

    public function view($gabinete)
    {
        return redirect(route('gabinete.show', $gabinete));
    }

    public function save()
    {
        $this->validate();

        $this->gabinete->save();

        $this->logo
            && $this->deleteFile('logos', $this->gabinete->logo)
            && $this->gabinete->update([
                'logo' => $this->logo->store('/', 'logos'),
            ]);

        $this->logo_horiz
            && $this->deleteFile('logos', $this->gabinete->logo_horiz)
            && $this->gabinete->update([
                'logo_horiz' => $this->logo_horiz->store('/', 'logos'),
            ]);

        $this->logo_icon
            && $this->deleteFile('logos', $this->gabinete->logo_icon)
            && $this->gabinete->update([
                'logo_icon' => $this->logo_icon->store('/', 'logos'),
            ]);

        ! $this->gabinete->getKey() && $this->gabinete->createAdministratorUserToken();

        $this->showEditModal = false;

        $this->resetToBlankGabinete();

//        $this->emitSelf('notify-saved');

        $this->notify(__('Guardado'), __('Se han actualizado los datos del gabinete'));
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

    public function createNewToken()
    {
        $this->gabinete->createAdministratorUserToken();
        $this->notify(__('Accesos temporales creados'), __('Se han enviado los correos de bienvenida a: '.$this->gabinete->email));
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
        return view('livewire.gabinetes', [
            'gabinetes' => $this->rows,
        ]);
    }
}
