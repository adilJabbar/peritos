<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Privacy extends Component
{
    public function render()
    {
        return view('livewire.auth.privacy')
            ->layout('layouts.public');
    }
}
