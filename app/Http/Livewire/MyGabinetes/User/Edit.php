<?php

namespace App\Http\Livewire\MyGabinetes\User;

use App\Models\Gabinete;
use App\Models\Subcontractor;
use App\Traits\WithSideNavigation;
use Livewire\Component;

class Edit extends Component
{
    use WithSideNavigation;

    public \App\Models\User $user;

    public Gabinete $gabinete;

    public $subcontractor;

    protected $queryString = ['showSubmenu'];

    protected $listeners = ['userSecurityUpdated' => '$refresh'];

    public function mount($user, $gabinete, $subcontractor = null)
    {
        $this->mountSubmenu('personalData');
        $this->user = $user;
        $this->gabinete = $gabinete;
        $this->subcontractor = $subcontractor ? Subcontractor::find($subcontractor) : null;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.user.edit');
    }
}
