<?php

namespace App\Http\Livewire\Error;

use Livewire\Component;

class Forbidden extends Component
{
    public function render()
    {
        return view('livewire.error.forbidden')
            ->layout('layouts.auth');
    }
}
