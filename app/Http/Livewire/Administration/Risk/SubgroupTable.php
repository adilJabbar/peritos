<?php

namespace App\Http\Livewire\Administration\Risk;

use Livewire\Component;

class SubgroupTable extends Component
{
    public $riskgroup;

    public $risksubgroupSelected = false;

    protected $listeners = ['riskSubgroupsUpdated' => '$refresh'];

    public function mount($riskgroup, $risksubgroupSelected)
    {
        $this->riskgroup = $riskgroup;
        $this->risksubgroupSelected = $risksubgroupSelected;
    }

    public function render()
    {
        return view('livewire.administration.risk.subgroup-table', [
            'subgroups' => $this->riskgroup->risksubgroups,
        ]);
    }
}
