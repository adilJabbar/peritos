<?php

namespace App\Http\Livewire\Gabinete;

use App\Events\NewUserCreated;
use App\Models\Gabinete;
use App\Models\User;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\User\WithNewUserModal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Str;

class UsersOld extends Component
{
    use WithBulkActions,
        WithSorting,
        WithPerPagePagination,
        WithFileUploads,
        WithNewUserModal;

    public Gabinete $gabinete;

    public User $user;

    public $password = '';

    public $passwordConfirmation = '';

    public $role;

    public $rolesList = [];

    public $optionsLanguage = [];

    public $upload;

    public $signature;

    public $gabinetesUser;

    public $isANewUser = true;

    public $showFilters;

    public $showDeleteModal = false;

    public $filters = [
        'search' => '',
        'lastname' => '',
        'email' => '',
        'active' => '',
        'role' => '',
    ];

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
            'user.backoffice_id' => 'required',
            'user.supervisor_id' => 'required',
            'user.supervised_advances' => 'boolean|required',
            'user.supervised_reports' => 'boolean|required',
            'user.supervised_incidences' => 'boolean|required',
            'user.contact_to_company' => 'boolean|required',
            'upload' => 'nullable|image|max:1024',
            'signature' => 'nullable|image|max:1024',
        ];
    }

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
        $this->resetToBlankUser();
    }

    public function updatedSignature()
    {
        $this->validateOnly('signature');
    }

    public function create()
    {
        if ($this->user->getKey()) {
            $this->isANewUser = true;
            $this->resetToBlankUser();
        }
        $this->showEditModal = true;
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->selected = [];
        $this->showDeleteModal = false;
    }

    public function edit(User $userSelected)
    {
        if ($this->user->isNot($userSelected)) {
            $this->isANewUser = false;
            $this->user = $userSelected;
//            $this->upload = null;
            $this->gabinetesUser = $this->user->gabinetes->pluck('id');
            $this->rolesList = $userSelected->roles->pluck('name', 'name')->toArray();
        }
        $this->user->backoffice_id = $this->user->backoffice_id ?: '';
        $this->user->supervisor_id = $this->user->supervisor_id ?: '';
        $this->showEditModal = true;
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery
                ->select(['name', 'last_name', 'email', 'created_at', 'language', 'is_active', 'birthday'])
                ->toCsv();
        }, now()->format('Y-m-d').'-Users.csv');
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function getRowsQueryProperty()
    {
//        (User::whereHas('gabinetes', function (Builder $query) {
//            $query->where('gabinete_id', 1);
//        })->get());
        $gabineteId = $this->gabinete->id;

        $query = User::query()
            ->whereHas('gabinetes', function (Builder $query) use ($gabineteId) {
                $query->where('gabinete_id', $gabineteId);
            })
            ->when($this->filters['role'], fn ($query, $role) => $query->with('roles')
                ->whereHas('roles', function ($query) use ($role) {
                    $query->where('name', $role);
                }))
            ->when($this->filters['active'] != '', function ($query) {
                $query->where('is_active', $this->filters['active']);
            })
            ->when($this->filters['search'], fn ($query, $search) => $query->search('name', $search));

        return $this->applySorting($query);
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function resetToBlankUser()
    {
        $this->user = User::make([
            'is_active' => 0,
            'country_id' => $this->gabinete->country_id,
            'language' => '',
            'backoffice_id' => '',
            'supervisor_id' => '',
            'supervised_advances' => 1,
            'supervised_reports' => 1,
            'supervised_incidences' => 1,
            'contact_to_company' => 0,
        ]);
        $this->reset(['upload', 'gabinetesUser', 'rolesList', 'password', 'passwordConfirmation']);
    }

    public function save()
    {
        $this->validate();

        if ($this->password != null || ! $this->user->getKey()) {
            $this->password == null ? $this->password = Str::random(8) : '';
            $this->user->password = Hash::make($this->password);
            $this->user->is_active == null ? $this->user->is_active = false : '';
            $isANewUser = true;
        }

        $this->upload && $this->user->updateProfilePhoto($this->upload);

        $this->signature
        && $this->deleteFile('signatures', $this->user->signature)
        && $this->user->update([
            'signature' => $this->signature->store('/', 'signatures'),
        ]);

        $this->user->save();

        if ($this->isANewUser) {
            $this->emit('UsersUpdated');
            event(new NewUserCreated($this->user, $this->password));
            $this->user->sendEmailVerificationNotification();
        }

        $this->user->syncRoles($this->rolesList);

        if (! $this->user->gabinetes->contains($this->gabinete)) {
            $this->user->gabinetes()->attach($this->gabinete);
        }

        $this->showEditModal = false;

        $this->user->load('gabinetes');

        if (! $this->user->favoriteGabinete()) {
            $this->user->gabinetes()->updateExistingPivot($this->user->gabinetes->first(), ['favorite' => 1]);
        }
//        $this->user->gabinetes()->updateExistingPivot($this->user->gabinetes->first(), ['favorite' => 1]);

//        $this->user->id === auth()->user()->id && $this->emit('userUpdated', $this->user);

        $this->resetToBlankUser();

//        $this->emitSelf('notify-saved');

        $this->notify(__('Guardado'), __('Se han actualizado los datos del usuario'));
    }

    public function toggleRolesList($value)
    {
        if (! isset($this->rolesList[$value])) {
            return $this->rolesList[$value] = $value;
        } else {
            unset($this->rolesList[$value]);
        }
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedUpload()
    {
        $this->validateOnly('upload');
    }

    public function render()
    {
        return view('livewire.gabinete.users', [
            'users' => $this->rows,
            'roles' => Role::where('level', '<=', auth()->user()->max_role)
                ->get(),
        ]);
    }
}
