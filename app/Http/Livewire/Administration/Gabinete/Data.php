<?php

namespace App\Http\Livewire\Administration\Gabinete;

use App\Traits\WithFileDelete;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Data extends Component
{
    public \App\Models\Gabinete $gabinete;

    protected $listeners = ['GabineteDataUpdated' => '$refresh'];

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
    }

    public function render()
    {
        return view('livewire.administration.gabinete.data');
    }
}
