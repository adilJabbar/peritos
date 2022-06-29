<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use Livewire\Component;

class PhoneCall extends Component
{
    public Expedient $expedient;

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
    }

    public function render()
    {
        return view('livewire.expedient.phone-call');
    }
}
