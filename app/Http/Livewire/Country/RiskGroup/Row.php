<?php

namespace App\Http\Livewire\Country\RiskGroup;

use App\Models\Admin\Riskgroup;
use Livewire\Component;

class Row extends Component
{
    public Riskgroup $group;

    public $selected;

    protected $listeners = ['groupSelected', 'groupModified' => '$refresh'];

    protected $rules = [
        'group.name' => 'required|min:3',
    ];

    public function mount($group, $selected)
    {
        $this->group = $group;
        $this->selected = $selected;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->group->save();
    }

    public function delete()
    {
        if ($this->group->risksubgroups->count() === 0) {
            $this->group->delete() && $this->notify(__('Deleted'), __('El grupo de edificaciones ha sido eliminado'));
            $this->emit('riskGroupDeleted');
        } else {
            $this->notify(__('No se puede eliminar'), __('El grupo de edificaciones tiene subgrupos y no puede ser eliminado'), 'error');
        }
    }

    public function groupSelected($groupId)
    {
        $this->selected = $groupId;
    }

    public function select()
    {
        $this->selected = $this->group->id;
        $this->emit('groupSelected', $this->group->id);
    }

    public function render()
    {
        return view('livewire.country.risk-group.row');
    }
}
