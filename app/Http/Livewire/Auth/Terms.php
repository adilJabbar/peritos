<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Terms extends Component
{
    public function render()
    {
        return view('livewire.auth.terms')
            ->layout('layouts.public');
    }
}
