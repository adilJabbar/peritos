<?php

namespace App\Http\Livewire\Gabinete;

use App\Http\Livewire\Expedient\Create\HasAddressData;
use App\Models\Gabinete;
use App\Models\Insurance\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class Companies extends Component
{
    use HasAddressData, WithFileUploads;

    public Gabinete $gabinete;

    public $showAddCompany = false;

    public $addCompany = '';

    public $showNewCompany = false;

    public Company $company;

    public $logo;

    public $defaultAssignUser = '';

    public $defaultBackoffice = '';

    public $agent;

    public $existentAgent = '';

    public function rules()
    {
        return array_merge(
            [
                'addCompany' => 'required',
                'company.name' => 'required',
                'company.legal_name' => 'required',
                'company.legal_id' => 'required|unique:companies,legal_id',
                'defaultAssignUser' => 'required',
                'defaultBackoffice' => 'required',
            ],
            $this->validateAddress()
        );
    }

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
        $this->resetCompany();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedAddCompany($value)
    {
        if ($value === 'notListed') {
            $this->company = Company::make();
            $this->initializeAddress();
            $this->showNewCompany = true;
        } else {
            $this->showNewCompany = false;
            $this->company = Company::find($value);
        }
    }

    public function updatedExistentAgent()
    {
        $this->gabinete->agents()->attach($this->existentAgent);
        $this->existentAgent = '';
        $this->gabinete->load('agents');
    }

    public function updatedCompanyPivotDefaultAssignUser()
    {
        $this->gabinete->companies()->updateExistingPivot($this->company->id, ['default_assign_user' => $this->company->pivot['default_assign_user']], false);
    }

    public function updatedCompanyPivotDefaultBackofficeUser()
    {
        $this->gabinete->companies()->updateExistingPivot($this->company->id, ['default_backoffice_user' => $this->company->pivot['default_backoffice_user']], false);
    }

    public function addAgent()
    {
        $this->validate([
            'agent.company_id' => 'required',
            'agent.name' => 'required',
            'agent.phone' => '',
            'agent.phone2' => '',
            'agent.email' => 'email',
        ]);
        $this->agent->save();
        $this->gabinete->agents()->attach($this->agent);
        $this->gabinete->load('agents');
        $this->resetAgent($this->company->id);
    }

    public function removeAgent($agentId)
    {
        $this->gabinete->agents()->detach($agentId);
        $this->gabinete->load('agents');
    }

    public function resetAgent($companyId)
    {
        $this->agent = $this->gabinete->agents()->make(['company_id' => $companyId]);
    }

    public function resetCompany()
    {
        $this->company = Company::make();
        $this->initializeAddress();
    }

    public function showCompany(Company $company)
    {
        $this->company = $company;
        $this->emit('showCompany', $this->company);
//        redirect()->route('my_gabinetes.company.show', ['gabinete' => $this->gabinete->id, 'company' => $company]);
//        $this->company = $this->gabinete->companies->where('id', $company)->first();
////        dd($this->company->pivot);
//        if($this->company->pivot){
//            !$this->company->pivot['default_assign_user'] ? $this->company->pivot['default_assign_user'] = '' :'';
//            !$this->company->pivot['default_backoffice_user'] ? $this->company->pivot['default_backoffice_user'] = '' :'';
//        }
//        $this->resetAgent($this->company->id);
    }

    public function save()
    {
        if ($this->company->getKey()) {
            $this->validate([
                'addCompany' => 'required',
                'defaultAssignUser' => 'required',
                'defaultBackoffice' => 'required',
            ]);
        } else {
            $this->validate();
            if ($this->logo) {
                $this->company->logo = $this->logo->store('/', 'logos');
            }
            $this->company->save();
            $this->company->billingAddress()->create($this->address->attributesToArray());
        }
        $this->gabinete->companies()->attach($this->company, [
            'default_assign_user' => $this->defaultAssignUser,
            'default_backoffice_user' => $this->defaultBackoffice,
        ]);

        $this->notify(__('Guardado'), __('La relacion entre :Gabinete y :Company ha sido creada', ['gabinete' => $this->gabinete->name, 'company' => $this->company->name]));
        $this->resetCompany();
        $this->reset('addCompany', 'defaultAssignUser', 'defaultBackoffice', 'showNewCompany', 'showAddCompany');
        $this->gabinete->load('companies');
    }

    public function render()
    {
        return  view('livewire.gabinete.companies', [
            'companies' => Company::all(),
        ]);
    }
}
