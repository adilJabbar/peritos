<?php

namespace App\Http\Livewire\Administration\User;

use App\Models\Gabinete;
use Livewire\Component;

class Gabinetes extends Component
{
    public \App\Models\User $user;

    public $gabineteId;

    public $gabineteSelected;

    public $backofficeId = '';

    public $supervisorId = '';

    public $supervised_advances = false;

    public $supervised_reports = false;

    public $supervised_incidences = false;

    public $contact_to_company = true;

    protected $listeners = ['refreshUserGabinetes' => '$refresh'];

    protected $rules = [
        'gabineteId' => '',
        'backofficeId' => 'required',
        'supervisorId' => 'required',
        'supervised_advances' => 'boolean',
        'supervised_reports' => 'boolean',
        'supervised_incidences' => 'boolean',
        'contact_to_company' => 'boolean',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function mount($user)
    {
        $this->user = $user;
        $this->resetGabineteSelected();
    }

    public function updatedGabineteId()
    {
        $this->gabineteSelected = Gabinete::find($this->gabineteId);
    }

    public function resetGabineteSelected()
    {
        $this->gabineteId = '';
        $this->gabineteSelected = null;
    }

    public function save()
    {
        $this->validate();
        $this->user->gabinetes()->attach($this->gabineteSelected, [
            'backoffice_id' => $this->backofficeId,
            'supervisor_id' => $this->supervisorId,
            'supervised_advances' => $this->supervised_advances,
            'supervised_reports' => $this->supervised_reports,
            'supervised_incidences' => $this->supervised_incidences,
            'contact_to_company' => $this->contact_to_company,
        ]);
        $this->resetGabineteSelected();
        $this->emitSelf('refreshUserGabinetes');
//        $this->user
    }

    public function render()
    {
        return view('livewire.administration.user.gabinetes', [
            'gabinetes' => Gabinete::all(),
        ]);
    }
}
