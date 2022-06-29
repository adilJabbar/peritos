<?php

namespace App\Http\Livewire\Administration;

use App\Models\Admin\Destiny;
use Livewire\Component;

class Destinies extends Component
{
    protected $listeners = ['destiniesUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.administration.destinies', [
            'destinies' => Destiny::all(),
        ]);
    }
}
