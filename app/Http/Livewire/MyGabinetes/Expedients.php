<?php

namespace App\Http\Livewire\MyGabinetes;

use App\Models\Gabinete;
use Livewire\Component;

class Expedients extends Component
{
    public Gabinete $gabinete;

    protected $listeners = ['refreshExpedients' => '$refresh'];

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
    }

    public function render()
    {
        return view('livewire.my-gabinetes.expedients');
    }
}
