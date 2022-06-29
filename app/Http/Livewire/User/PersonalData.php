<?php

namespace App\Http\Livewire\User;

use App\Models\Gabinete;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class PersonalData extends Component
{
    use WithFileUploads;

    public \App\Models\User $user;

    public $photoUpload;

    public $signatureUpload;
//    public $rolesList = [];

    public function rules()
    {
        return [
            'user.name' => 'required|min:3',
            'user.last_name' => '',
            'user.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
            'user.is_active' => 'boolean',
            'user.birthday' => 'sometimes',
            'user.language' => 'required|in:es,en',
            'user.country_id' => 'required',
            'photoUpload' => 'nullable|image|max:1024',
            'signatureUpload' => 'nullable|image|max:1024',
            //            'gabinetesUser' => 'required'
        ];
    }

    public function mount($user)
    {
        $this->user = $user;
//        $this->rolesList =  $this->user->roles->pluck('name', 'name')->toArray();
    }

    public function toggleRolesList($value)
    {
        if (! isset($this->rolesList[$value])) {
            return $this->rolesList[$value] = $value;
        } else {
            unset($this->rolesList[$value]);
        }
    }

    public function save()
    {
        $this->validate();

        $this->photoUpload && $this->user->updateProfilePhoto($this->photoUpload);

        $this->signatureUpload
        && $this->deleteFile('signatures', $this->user->signatureUpload)
        && $this->user->update([
            'signature' => $this->signatureUpload->store('/', 'signatures'),
        ]);

        $this->user->save();

        if ($this->user->id === auth()->user()->id) {
            $this->emit('userUpdated', $this->user->id);
        } else {
            $this->emit('userUpdated');
        }
        $this->notify(__('Guardado'), __('Se han actualizado los datos del usuario'));
    }

    public function render()
    {
        return view('livewire.user.personal-data', [
            'gabinetes' => Gabinete::all(),
            'roles' => Role::where('level', '<=', auth()->user()->max_role)->get(),
        ]);
    }
}
