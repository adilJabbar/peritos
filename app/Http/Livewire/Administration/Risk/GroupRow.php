<?php

namespace App\Http\Livewire\Administration\Risk;

use App\Models\Admin\Riskgroup;
use Livewire\Component;

class GroupRow extends Component
{
    public Riskgroup $group;

    public $selected;

    protected $rules = [
        'group.country_id' => 'required',
        'group.name' => 'required',
    ];

    public function mount($group, $selected = false)
    {
        $this->group = $group;
        $this->selected = $selected;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->group->getKey()
            && $this->group->save();
    }

    public function select()
    {
        $this->emit('riskgroupSelected', $this->group);
    }

    public function save()
    {
        $this->validate();
        $this->group->save();
        $this->group = Riskgroup::make(['country_id' => $this->group->country_id]);
        $this->emit('riskGroupsUpdated');
    }

    public function delete()
    {
        $this->group->safeDelete()
            ? $this->notify(__('Eliminado'), __('El grupo ha sido eliminado'))
            : $this->notify(__('Error'), __('El grupo no se puede eliminar. Tiene subgrupos asignados'), 'error');
        $this->emit('riskGroupsUpdated');
    }

    public function render()
    {
        return view('livewire.administration.risk.group-row');
    }
}
