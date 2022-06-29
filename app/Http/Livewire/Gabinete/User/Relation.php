<?php

namespace App\Http\Livewire\Gabinete\User;

use App\Models\Gabinete;
use App\Models\Subcontractor;
use App\Models\User;
use Livewire\Component;

class Relation extends Component
{
    public User $user;

    public Gabinete $gabinete;

    public $gabineteRelated;

    public $backofficeId = '';

    public $supervisorId = '';

    public $supervised_advances = false;

    public $supervised_reports = false;

    public $supervised_incidences = false;

    public $contact_to_company = true;

    public $subcontractorId;

    protected $rules = [
        'backofficeId' => 'required',
        'supervisorId' => 'required',
        'supervised_advances' => 'boolean',
        'supervised_reports' => 'boolean',
        'supervised_incidences' => 'boolean',
        'contact_to_company' => 'boolean',
        'subcontractorId' => '',
    ];

    public function mount($user, $gabinete)
    {
        $this->user = $user;
        $this->gabinete = $gabinete;
        $this->gabineteRelated = $this->user->gabinetes->where('id', $gabinete->id)->first();
//        dd($this->gabineteRelated->pivot->backoffice_id);
        $this->backofficeId = $this->gabineteRelated->pivot->backoffice_id;
        $this->supervisorId = $this->gabineteRelated->pivot->supervisor_id;
        $this->supervised_advances = $this->gabineteRelated->pivot->supervised_advances;
        $this->supervised_reports = $this->gabineteRelated->pivot->supervised_reports;
        $this->supervised_incidences = $this->gabineteRelated->pivot->supervised_incidences;
        $this->contact_to_company = $this->gabineteRelated->pivot->contact_to_company;
        $this->subcontractorId = $this->gabineteRelated->pivot->subcontractor_id;
    }

    public function detach()
    {
        $this->user->gabinetes()->detach($this->gabinete);
        $this->emit('refreshUserGabinetes');
    }

    public function save()
    {
        $this->user->gabinetes()->updateExistingPivot($this->gabinete, [
            'backoffice_id' => $this->backofficeId,
            'supervisor_id' => $this->supervisorId,
            'supervised_advances' => $this->supervised_advances,
            'supervised_reports' => $this->supervised_reports,
            'supervised_incidences' => $this->supervised_incidences,
            'contact_to_company' => $this->contact_to_company,
            'subcontractor_id' => $this->subcontractorId,
        ]);
    }

    public function render()
    {
        return view('livewire.gabinete.user.relation');
    }
}
