<?php

namespace App\Http\Livewire\MyGabinetes\Subcontractor;

use App\Models\Gabinete;
use App\Models\Subcontractor;
use App\Traits\WithSideNavigation;
use Livewire\Component;

class Edit extends Component
{
    use WithSideNavigation;

    public Subcontractor $subcontractor;

    public Gabinete $gabinete;

    protected $queryString = ['showSubmenu'];

    protected $listeners = ['subcontractorUpdated' => '$refresh'];

    public function mount($gabinete, $subcontractor)
    {
        $this->gabinete = $gabinete;
        $this->subcontractor = $subcontractor;
        $this->mountSubmenu('Data');
    }

    public function render()
    {
        return view('livewire.my-gabinetes.subcontractor.edit');
    }
}
