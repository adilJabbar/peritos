<?php

namespace App\Http\Livewire\Gabinete;

use App\Models\Gabinete;
use App\Models\User;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\User\WithNewUserModal;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPerPagePagination,
        WithSorting,
        WithBulkActions,
        WithNewUserModal;

    public Gabinete $gabinete;

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

    public $administration = false;

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function rules()
    {
        return array_merge(
            $this->rulesTraitUser(),
        );
    }

    public function mount($gabinete, $administration = false)
    {
        $this->gabinete = $gabinete;
        $this->gabineteSelected = $this->gabinete;
        $this->administration = $administration;
        $this->resetToBlankUser();
//        dd($this->gabineteSelected);
    }

    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->selected = [];
        $this->showDeleteModal = false;
    }

    public function edit($userSelected)
    {
        if ($this->administration) {
            redirect()->route('administration.user.show', ['gabinete' => $this->gabinete->id, 'user' => $userSelected]);
        } else {
            redirect()->route('my_gabinetes.user.show', ['gabinete' => $this->gabinete->id, 'user' => $userSelected]);
        }
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
        $gabineteId = $this->gabinete->id;
        $query = User::query()
            ->whereHas('gabinetes', function (Builder $query) use ($gabineteId) {
                $query->where('gabinete_id', $gabineteId)->where('subcontractor_id', 0);
            })
            ->when($this->filters['role'], fn ($query, $role) => $query->with('roles')
                ->whereHas('roles', function ($query) use ($role) {
                    $query->where('name', $role);
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
        return view('livewire.gabinete.users', [
            'users' => $this->rows,
            'roles' => Role::where('level', '<=', auth()->user()->max_role)
                ->get(),
        ]);
    }
}
