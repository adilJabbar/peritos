<?php

namespace App\Http\Livewire\Administration\User;

use App\Events\NewUserCreated;
use App\Models\Gabinete;
use App\Traits\WithSideNavigation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class PersonalData extends Component
{
    public \App\Models\User $user;

    protected $listeners = ['userUpdated' => '$refresh'];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.administration.user.personal-data');
    }
}
