<?php

namespace App\Http\Livewire\MyGabinetes\User;

use App\Models\Gabinete;
use App\Models\Subcontractor;
use Livewire\Component;

class PersonalData extends Component
{
    public \App\Models\User $user;

    public Gabinete $gabinete;

    public $subcontractor;

    protected $listeners = ['userUpdated' => '$refresh'];

    public function mount($user, $gabinete, $subcontractor = null)
    {
        $this->user = $user;
        $this->gabinete = $gabinete;
        $this->subcontractor = $subcontractor;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.user.personal-data');
    }
}
