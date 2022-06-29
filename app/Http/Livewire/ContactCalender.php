<?php

namespace App\Http\Livewire;

use App\Models\ContactAttempt;
use App\Models\VisitAppointment;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use Livewire\Component;

class ContactCalender extends Component
{
    use WithSorting, WithBulkActions, WithPerPagePagination;

    public $showSubmenu;

    protected $queryString = ['showSubmenu'];

    public function mount()
    {
        ! $this->showSubmenu ? $this->showSubmenu = 'Contact calls' : '';
    }

    public function getRowsQueryProperty()
    {
        if ($this->showSubmenu == 'Contact calls') {
            return ContactAttempt::query()->where('user_id', auth()->user()->id);
        } else {
            return VisitAppointment::query()->with('technician')->where('user_id', auth()->user()->id);
        }
    }

    public function getRowsProperty()
    {
        $rowsQuery = $this->applySorting($this->rowsQuery);

        return $this->applyPagination($rowsQuery);
    }

    public function render()
    {
        return view('livewire.contacts', ['contacts' => $this->rows]);
    }
}
