<?php

namespace App\Http\Livewire\Administration;

use App\Models\Admin\Status;
use Livewire\Component;

class Statuses extends Component
{
    public Status $newStatus;

    protected $listeners = ['statusesUpdated' => '$refresh'];

    public function mount()
    {
        $this->newStatus = Status::make();
    }

    public function render()
    {
        return view('livewire.administration.statuses', [
            'statuses' => Status::all(),
        ]);
    }
}
