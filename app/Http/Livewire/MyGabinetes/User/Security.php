<?php

namespace App\Http\Livewire\MyGabinetes\User;

use App\Models\Gabinete;
use Livewire\Component;

class Security extends Component
{
    public \App\Models\User $user;

    public Gabinete $gabinete;

    public $subcontractor;

    public function mount($user, $gabinete, $subcontractor = null)
    {
        $this->user = $user;
        $this->gabinete = $gabinete;
        $this->subcontractor = $subcontractor;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.user.security');
    }
}
