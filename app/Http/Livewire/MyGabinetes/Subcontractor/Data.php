<?php

namespace App\Http\Livewire\MyGabinetes\Subcontractor;

use App\Models\Gabinete;
use App\Models\Subcontractor;
use Livewire\Component;

class Data extends Component
{
    public Subcontractor $subcontractor;

    protected $listeners = ['subcontractorUpdated' => '$refresh'];

    public function mount($subcontractor)
    {
        $this->subcontractor = $subcontractor;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.subcontractor.data');
    }
}
