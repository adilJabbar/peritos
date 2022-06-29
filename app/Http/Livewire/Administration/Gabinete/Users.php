<?php

namespace App\Http\Livewire\Administration\Gabinete;

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
    use WithNewUserModal;

    public Gabinete $gabinete;

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function rules()
    {
        return array_merge(
            $this->rulesTraitUser(),
        );
    }

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
        $this->resetToBlankUser();
    }

    public function render()
    {
        return view('livewire.administration.gabinete.users');
    }
}
