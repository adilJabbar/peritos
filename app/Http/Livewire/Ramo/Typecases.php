<?php

namespace App\Http\Livewire\Ramo;

use App\Models\Admin\Ramo;
use Livewire\Component;

class Typecases extends Component
{
    public Ramo $ramo;

    protected $listeners = ['typeCasesUpdated' => '$refresh'];

    public function mount($ramo)
    {
        $this->ramo = $ramo;
    }

    public function render()
    {
        return view('livewire.ramo.typecases');
    }
}
