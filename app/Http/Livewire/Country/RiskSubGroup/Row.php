<?php

namespace App\Http\Livewire\Country\RiskSubGroup;

use App\Models\Admin\Risksubgroup;
use Livewire\Component;

class Row extends Component
{
    public Risksubgroup $subgroup;

    public $selected;

    protected $listeners = ['subgroupSelected', 'subgroupModified' => '$refresh'];

    protected $rules = [
        'subgroup.name' => 'required|min:3',
    ];

    public function mount($subgroup, $selected)
    {
        $this->subgroup = $subgroup;
        $this->selected = $selected;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->subgroup->save();
    }

    public function delete()
    {
        if ($this->subgroup->riskdetails->count() === 0) {
            $this->subgroup->delete() && $this->notify(__('Deleted'), __('El sub-grupo de edificaciones ha sido eliminado'));
            $this->emit('riskSubGroupDeleted');
        } else {
            $this->notify(__('No se puede eliminar'), __('El sub-grupo de edificaciones tiene tipologías creadas y no puede ser eliminado'), 'error');
        }
    }

    public function select()
    {
        $this->selected = $this->subgroup->id;
        $this->emit('subgroupSelected', $this->subgroup->id);
    }

    public function subgroupSelected($subgroupId)
    {
        $this->selected = $subgroupId;
    }

    public function render()
    {
        return view('livewire.country.risk-sub-group.row');
    }
}
