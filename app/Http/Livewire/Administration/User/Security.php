<?php

namespace App\Http\Livewire\Administration\User;

use App\Events\UserReseted;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Str;

class Security extends Component
{
    public \App\Models\User $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function resetPasswordAccount()
    {
        $password = Str::random(8);
        $this->user->password = Hash::make($password);
        $this->user->email_verified_at = null;
        $this->user->save();
        event(new UserReseted($this->user, $password));
        $this->notify(__('Reseteado'), __('El usuario ha sido reseteado y se le ha enviado por correo la nueva contaseña'));
    }

    public function render()
    {
        return view('livewire.administration.user.security');
    }
}
