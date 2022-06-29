<?php

namespace App\Http\Livewire\User;

use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use Livewire\Component;

class Table extends Component
{
    public $users = [];

    public function mount($users)
    {
        $this->users = $users;
    }

    public function render()
    {
        return view('livewire.user.table');
    }
}
