<?php

namespace App\Http\Livewire\MyGabinetes;

use Livewire\Component;

class Plan extends Component
{
    public \App\Models\Gabinete $gabinete;

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.plan');
    }
}
