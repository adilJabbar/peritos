<?php

namespace App\Http\Livewire\Administration\User;

use Livewire\Component;

class ZipCoverage extends Component
{
    public \App\Models\User $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.administration.user.zip-coverage');
    }
}
