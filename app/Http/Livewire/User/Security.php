<?php

namespace App\Http\Livewire\User;

use App\Events\UserReseted;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Security extends Component
{
    public \App\Models\User $user;

    public $roleList;

    public function mount($user)
    {
        $this->user = $user;
        $this->roleList = $this->user->roles->pluck('id')->map(fn ($id) => (string) $id);
    }

    public function updatedRoleList($value)
    {
        if (auth()->user()->can('roles.update')) {
            $this->user->roles()->sync($this->roleList);
            $this->emit('userSecurityUpdated');
        }
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
        return view('livewire.user.security', [
            'allowable_roles' => Role::where('level', '<=', auth()->user()->max_role)->get(),
            'roles' => Role::all(),
        ]);
    }
}
