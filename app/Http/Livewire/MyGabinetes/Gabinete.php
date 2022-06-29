<?php

namespace App\Http\Livewire\MyGabinetes;

use Livewire\Component;

class Gabinete extends Component
{
    public \App\Models\Gabinete $gabinete;

    protected $listeners = ['GabineteDataUpdated' => '$refresh'];

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.gabinete');
    }
}
