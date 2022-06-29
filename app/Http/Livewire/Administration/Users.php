<?php

namespace App\Http\Livewire\Administration;

use App\Events\NewUserCreated;
use App\Models\Gabinete;
use App\Models\User;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\User\WithNewUserModal;
use App\Traits\WithFileDelete;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPerPagePagination,
        WithSorting,
        WithBulkActions,
        WithNewUserModal;

    public $showDeleteModal = false;

    public $showFilters;

    public $filters = [
        'search' => '',
        'lastname' => '',
        'email' => '',
        'active' => '',
        'role' => '',
        'gabinete' => '',
        'language' => '',
    ];

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function rules()
    {
        return array_merge(
            $this->rulesTraitUser(),
        );
    }

    public function mount()
    {
        $this->resetToBlankUser();
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->selected = [];
        $this->showDeleteModal = false;
    }

    public function edit($userSelected)
    {
        redirect()->route('administration.user.show', $userSelected);
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
        $query = User::query()
            ->when($this->filters['role'], fn ($query, $role) => $query->with('roles')
                ->whereHas('roles', function ($query) use ($role) {
                    $query->where('name', $role);
                }))
            ->when($this->filters['gabinete'], fn ($query, $gabinete) => $query->with('gabinetes')
                ->whereHas('gabinetes', function (Builder $query) use ($gabinete) {
                    $query->where('gabinete_id', $gabinete);
                }))
            ->when($this->filters['active'] != '', function ($query) {
                $query->where('is_active', $this->filters['active']);
            })
            ->when($this->filters['search'], fn ($query, $search) => $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('last_name', 'like', '%'.$search.'%'))
            ->when($this->filters['language'], fn ($query, $language) => $query->search('language', $language));

        return $this->applySorting($query);
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.administration.users', [
            'users' => $this->rows,
            'gabinetes' => Gabinete::all(),
            'roles' => Role::where('level', '<=', auth()->user()->max_role)
                ->get(),
        ]);
    }
}
