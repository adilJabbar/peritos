<?php

namespace App\Http\Livewire\Layout\Menu;

use Livewire\Component;

class TopLinks extends Component
{
    protected $listeners = ['loggedUserUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.layout.menu.top-links');
    }
}
