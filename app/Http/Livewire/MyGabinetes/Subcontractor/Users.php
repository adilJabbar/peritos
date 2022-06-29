<?php

namespace App\Http\Livewire\MyGabinetes\Subcontractor;

use App\Models\Subcontractor;
use Livewire\Component;

class Users extends Component
{
    public Subcontractor $subcontractor;

    protected $listeners = ['subcontractorUsersUpdated' => '$refresh'];

    public function mount($subcontractor)
    {
        $this->subcontractor = $subcontractor;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.subcontractor.users');
    }
}
