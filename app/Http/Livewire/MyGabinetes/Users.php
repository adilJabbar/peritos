<?php

namespace App\Http\Livewire\MyGabinetes;

use App\Models\Gabinete;
use App\Traits\User\WithNewUserModal;
use Livewire\Component;

class Users extends Component
{
    public Gabinete $gabinete;

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.users');
    }
}
