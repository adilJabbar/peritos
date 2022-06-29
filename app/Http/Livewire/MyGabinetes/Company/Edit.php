<?php

namespace App\Http\Livewire\MyGabinetes\Company;

use App\Models\Gabinete;
use App\Models\Insurance\Agent;
use App\Models\Insurance\Company;
use App\Traits\WithSideNavigation;
use Livewire\Component;

class Edit extends Component
{
    public Company $company;

    public Gabinete $gabinete;

    public $defaultAssignUser = '';

    public $defaultBackoffice = '';

    public $addAgent = '';

    public $showAddAgent = false;

    public $showNewAgent = false;

    public Agent $newAgent;

    protected $rules = [
        'defaultAssignUser' => 'required|exists:users,id',
        'defaultBackoffice' => 'required|exists:users,id',
        'newAgent.company_id' => 'required',
        'newAgent.name' => 'required',
        'newAgent.phone' => '',
        'newAgent.phone2' => '',
        'newAgent.email' => 'required',
    ];

    public function mount($company, $gabinete)
    {
//        $this->mountSubmenu('Agents');
        $this->company = $company;
        $this->gabinete = $gabinete;
        $this->defaultAssignUser = $this->gabinete->defaultUser($this->company)->id;
        $this->defaultBackoffice = $this->gabinete->backoffice($this->company)->id;
        $this->newAgent = $this->company->agents()->make();
    }

    public function updated($field)
    {
        if ($field === 'defaultAssignUser' || $field === 'defaultBackoffice') {
            $this->validate([
                'defaultAssignUser' => 'required|exists:users,id',
                'defaultBackoffice' => 'required|exists:users,id',
            ]);
            $this->gabinete->companies()->updateExistingPivot($this->company->id, [
                'default_assign_user' => $this->defaultAssignUser,
                'default_backoffice_user' => $this->defaultBackoffice,
            ]);
        }
    }

    public function updatedAddAgent($value)
    {
        if ($value === 'notListed') {
            $this->showNewAgent = true;
        }
    }

    public function delete($agentId)
    {
        $this->gabinete->agents()->detach($agentId);
        $this->gabinete->load('agents');
    }

    public function resetNewAgent()
    {
        $this->newAgent = $this->company->agents()->make();
        $this->addAgent = '';
        $this->showAddAgent = false;
        $this->showNewAgent = false;
    }

    public function save()
    {
        if ($this->addAgent === 'notListed') {
            $this->validate([
                'newAgent.name' => 'required',
                'newAgent.phone' => '',
                'newAgent.phone2' => '',
                'newAgent.email' => 'required',
            ]);
            $this->newAgent->save();
            $this->gabinete->agents()->attach($this->newAgent);
        } else {
            $this->gabinete->agents()->attach($this->addAgent);
        }
        $this->gabinete->load('agents');
        $this->resetNewAgent();
        $this->notify(__('Guardado'), __('El nuevo tramitador ha sido añadido para :company', ['company' => $this->company->name]));
    }

    public function render()
    {
        return view('livewire.my-gabinetes.company.edit');
    }
}
