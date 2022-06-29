<?php

namespace App\Http\Livewire\Subcontractor;

use App\Models\Subcontractor;
use App\Models\User;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\User\WithNewUserModal;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Users extends Component
{
    use WithPerPagePagination,
        WithSorting,
        WithBulkActions;

    public Subcontractor $subcontractor;

    public $filters = [
        'search' => '',
        'lastname' => '',
        'email' => '',
        'active' => '',
        'role' => '',
        'gabinete' => '',
        'language' => '',
    ];

    protected $listeners = ['subcontractorUsersUpdated' => '$refresh'];

    public function mount($subcontractor)
    {
        $this->subcontractor = $subcontractor;
    }

    public function edit($userSelected)
    {
        redirect()->route('my_gabinetes.user.show', ['gabinete' => $this->subcontractor->gabinete->id, 'user' => $userSelected, 'subcontractor' => $this->subcontractor->id]);
    }

//    public function getRowsProperty()
//    {
//        return $this->applyPagination($this->rowsQuery);
//    }
//
//    public function getRowsQueryProperty()
//    {
//
//        $query = User::query()
//            ->whereHas('gabinetes', function (Builder $query) use ($gabineteId) {
//                $query->where('gabinete_id', $gabineteId);
//            })
//            ->when($this->filters['role'], fn($query, $role) => $query->with('roles')
//                ->whereHas('roles', function($query) use ($role){
//                    $query->where('name', $role);
//                }))
//            ->when($this->filters['active'] != '', function($query){
//                $query->where('is_active', $this->filters['active']);
//            })
//            ->when($this->filters['search'], fn($query, $search) => $query->where('name', 'like', '%'.$search.'%')
//                ->orWhere('last_name', 'like', '%'.$search.'%'))
//            ->when($this->filters['language'], fn($query, $language) => $query->search('language' ,$language));
//
//        return $this->applySorting($query);
//    }

    public function render()
    {
        return view('livewire.subcontractor.users', [
            'users' => $this->subcontractor->users,
        ]);
    }
}
