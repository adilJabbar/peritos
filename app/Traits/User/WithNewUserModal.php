<?php

namespace App\Traits\User;

use App\Events\NewUserCreated;
use App\Models\Gabinete;
use App\Models\User;
use App\Traits\WithFileDelete;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Str;

trait WithNewUserModal
{
    /*Requires
    Initialize GabineteSelected
    Add Rules to livewire file

    @include('partials.user.new_gabinete_modal')
    Add rules to main file if there is another rules function declared
    */

    use WithFileUploads,
        WithFileDelete;

    public User $user;

    public $password = '';

    public $passwordConfirmation = '';

    public $role;

    public $rolesList = [];

    public $optionsLanguage = [];

    public $photoUpload;

    public $signatureUpload;

    public $gabineteId = '';

    public $gabineteSelected;

    public $backofficeId = '';

    public $supervisorId = '';

    public $subcontractorId = 0;

    public $supervised_advances = false;

    public $supervised_reports = false;

    public $supervised_incidences = false;

    public $contact_to_company = true;

    public $showAddExistingUser = false;

    public $existingUserId;

    public $showEditModal = false;

    public function rulesTraitUser()
    {
        return [
            'user.name' => 'required|min:3',
            'user.last_name' => '',
            //        'user.email' => 'required|email|unique:users,email,{$this->user->id}',
            'user.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
            'user.is_active' => 'boolean',
            'user.birthday' => 'sometimes',
            'user.language' => 'required|in:es,en',
            'user.country_id' => 'required',
            'photoUpload' => 'nullable|image|max:1024',
            'signatureUpload' => 'nullable|image|max:1024',
            'gabineteSelected' => 'required',
            'rolesList' => 'required|array|min:1',
            'backofficeId' => 'required',
            'supervisorId' => 'required',
            'subcontractorId' => 'required',
            'supervised_advances' => 'boolean',
            'supervised_reports' => 'boolean',
            'supervised_incidences' => 'boolean',
            'contact_to_company' => 'boolean',
        ];
    }

    public function updated($field)
    {
        if ($field === 'user.email') {
            if ($this->existingUserId = User::where('email', $this->user->email)->first()->id ?? null) {
                $this->showAddExistingUser = true;
            }
        }
        $this->validateOnly($field);
        if ($field === 'gabineteId') {
            $this->gabineteSelected = Gabinete::find($this->gabineteId);
            $this->backofficeId = '';
            $this->supervisorId = '';
        }
    }

    public function loadUser()
    {
        $this->user = User::find($this->existingUserId);
    }

    public function createNewUser()
    {
        if ($this->user->getKey()) {
            $this->resetToBlankUser();
        }
        $this->showEditModal = true;
    }

    public function resetToBlankUser()
    {
        $this->user = User::make([
            'is_active' => 0,
            'language' => auth()->user()->language,
            'country_id' => auth()->user()->country_id,
        ]);
        $this->reset(['photoUpload', 'signatureUpload', 'rolesList', 'password', 'passwordConfirmation']);
    }

    public function saveNewUser()
    {
        $isANewUser = false;
        $this->validate();
        if ($subscription = getGebineteStripeSubscriptionId($this->gabineteSelected->id)) {
            if (updateUsageRecord($subscription, 'User')) {
                if (! $this->user->getKey()) {
                    $password = Str::random(8);
                    $this->user->password = Hash::make($password);
                    $isANewUser = true;
                }

                $this->photoUpload && $this->user->updateProfilePhoto($this->photoUpload);
                $this->signatureUpload
                && $this->deleteFile('signatures', $this->user->signatureUpload)
                && $this->user->update([
                    'signature' => $this->signatureUpload->store('/', 'signatures'),
                ]);
                $this->user->save();

                $this->user->roles()->sync($this->rolesList);

                $this->user->gabinetes()->attach($this->gabineteSelected, [
                    'backoffice_id' => $this->backofficeId,
                    'supervisor_id' => $this->supervisorId,
                    'supervised_advances' => $this->supervised_advances,
                    'supervised_reports' => $this->supervised_reports,
                    'supervised_incidences' => $this->supervised_incidences,
                    'contact_to_company' => $this->contact_to_company,
                    'subcontractor_id' => $this->subcontractorId,
                ]);

                $this->emitSelf('refreshUsers');
                if ($isANewUser) {
                    event(new NewUserCreated($this->user, $password));
                    $this->user->sendEmailVerificationNotification();
                }
                $this->showEditModal = false;
            }
        }
        $this->notify(__('Error'), __('gabinate don\'t have subscribe. please subscribe and try again'), 'error');
    }

    public function toggleRolesList($value)
    {
        if (! isset($this->rolesList[$value])) {
            return $this->rolesList[$value] = $value;
        } else {
            unset($this->rolesList[$value]);
        }
    }
}
