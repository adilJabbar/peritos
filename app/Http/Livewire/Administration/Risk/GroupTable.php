<?php

namespace App\Http\Livewire\Administration\Risk;

use Livewire\Component;

class GroupTable extends Component
{
    public $country;

    public $riskgroupSelected;

    protected $listeners = ['riskGroupsUpdated' => '$refresh'];

    public function mount($country, $riskgroupSelected)
    {
        $this->country = $country;
        $this->riskgroupSelected = $riskgroupSelected;
    }

    public function render()
    {
        return view('livewire.administration.risk.group-table', [
            'groups' => $this->country->riskgroups,
        ]);
    }
}
