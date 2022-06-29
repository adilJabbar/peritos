<?php

namespace App\Http\Livewire\Insurance\Area;

use App\Models\Insurance\Company\Area;
use Livewire\Component;

class Row extends Component
{
    public Area $area;

    protected $rules = [
        'area.name' => 'required|string|min:3',
    ];

    public function mount($area)
    {
        $this->area = $area;
    }

    public function updated()
    {
        $this->validate();
        $this->area->save();
    }

    public function render()
    {
        return view('livewire.insurance.area.row');
    }
}
