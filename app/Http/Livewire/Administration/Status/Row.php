<?php

namespace App\Http\Livewire\Administration\Status;

use App\Models\Admin\Status;
use Livewire\Component;

class Row extends Component
{
    public Status $status;

    protected $rules = [
        'status.order' => 'required|numeric',
        'status.name' => 'required|string|min:3',
    ];

    public function mount($status)
    {
        $this->status = $status;
    }

    public function updated()
    {
        $this->validate();
        $this->status->save();
    }

    public function render()
    {
        return view('livewire.administration.status.row');
    }
}
