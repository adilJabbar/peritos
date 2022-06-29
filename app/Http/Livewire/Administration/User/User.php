<?php

namespace App\Http\Livewire\Administration\User;

use App\Models\Gabinete;
use App\Traits\WithSideNavigation;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class User extends Component
{
    use WithSideNavigation;

    public \App\Models\User $user;

    protected $queryString = ['showSubmenu'];

    protected $listeners = ['userSecurityUpdated' => '$refresh'];

    public function mount($user)
    {
        $this->mountSubmenu('personalData');
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.administration.user.user');
    }
}
