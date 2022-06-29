<?php

namespace App\Http\Livewire\Administration\Deprecationgroup;

use App\Models\Admin\Deprecationgroup;
use Livewire\Component;

class Row extends Component
{
    public Deprecationgroup $deprecationgroup;

    protected $rules = [
        'deprecationgroup.country_id' => '',
        'deprecationgroup.name' => 'required',
        'deprecationgroup.estimated_years' => 'required',
        'deprecationgroup.residual_percent' => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->deprecationgroup->getKey()
            && $this->deprecationgroup->save();
    }

    public function save()
    {
        $this->validate();
        $this->deprecationgroup->save();
        $this->deprecationgroup = Deprecationgroup::make(['country_id' => $this->deprecationgroup->country_id]);

        $this->emit('deprecationgroupsUpdated');
    }

    public function delete()
    {
        $this->deprecationgroup->delete();
        $this->emit('deprecationgroupsUpdated');
    }

    public function render()
    {
        return view('livewire.administration.deprecationgroup.row');
    }
}
