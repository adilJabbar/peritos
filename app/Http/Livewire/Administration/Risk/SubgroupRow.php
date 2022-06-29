<?php

namespace App\Http\Livewire\Administration\Risk;

use App\Models\Admin\Risksubgroup;
use Livewire\Component;

class SubgroupRow extends Component
{
    public Risksubgroup $subgroup;

    public $selected;

    protected $rules = [
        'subgroup.riskgroup_id' => 'required',
        'subgroup.name' => '',
    ];

    public function mount($subgroup, $selected = false)
    {
        $this->subgroup = $subgroup;
        $this->selected = $selected;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->subgroup->getKey()
        && $this->subgroup->save();
    }

    public function select()
    {
        $this->emit('risksubgroupSelected', $this->subgroup);
    }

    public function save()
    {
        $this->validate();
        $this->subgroup->save();
        $this->subgroup = Risksubgroup::make(['riskgroup_id' => $this->subgroup->riskgroup_id]);
        $this->emit('riskSubgroupsUpdated');
    }

    public function delete()
    {
        $this->subgroup->safeDelete()
            ? $this->notify(__('Eliminado'), __('El tipo ha sido eliminado'))
            : $this->notify(__('Error'), __('El tipo no se puede eliminar. Tiene detalles asignados'), 'error');
        $this->emit('riskSubgroupsUpdated');
    }

    public function render()
    {
        return view('livewire.administration.risk.subgroup-row');
    }
}
