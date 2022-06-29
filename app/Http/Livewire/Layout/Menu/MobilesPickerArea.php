<?php

namespace App\Http\Livewire\Layout\Menu;

use Livewire\Component;

class MobilesPickerArea extends Component
{
    public $option;

    public function mount()
    {
        $this->option = explode('.', request()->route()->getName())[0];
    }

    public function render()
    {
        return view('livewire.layout.menu.mobiles-picker-area');
    }
}
