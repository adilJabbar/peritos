<?php

namespace App\Http\Livewire\Expedients;

use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\Expedient\ExpedientTable;
use Livewire\Component;

class Gabinete extends Component
{
    use WithSorting, WithBulkActions, WithPerPagePagination, ExpedientTable;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $gabinete;

    public $showSubmenu;

    public function mount($gabinete = null)
    {
        $this->gabinete = $gabinete;
        ! $this->showSubmenu ? $this->showSubmenu = 'Active' : '';
    }

//    public function createCompany()
//    {
//        return redirect(route('expedient.createCompany'));
//    }
//
//    public function createParticular()
//    {
//        return redirect(route('expedient.createParticular'));
//    }
//
//    public function open(Expedient $expedient)
//    {
//        if($expedient->status->name === 'Finalizar Alta'){
//            return redirect()->route('expedient.new_expedient', ['expedient' => $expedient->id]);
//        } else {
//            return redirect(route('expedient.edit', $expedient));
//        }
//    }
//
//    public function view($expedient)
//    {
//        return redirect(route('expedient.show', $expedient));
//    }

    public function render()
    {
        return view('livewire.expedients.gabinete', [
            'expedients' => $this->rows,
        ]);
    }
}
