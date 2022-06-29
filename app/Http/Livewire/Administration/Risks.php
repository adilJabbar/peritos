<?php

namespace App\Http\Livewire\Administration;

use App\Models\Admin\Riskgroup;
use App\Models\Admin\Risksubgroup;
use Livewire\Component;

class Risks extends Component
{
    public $country;

    public $groupSelected = null;

    public $subgroupSelected = null;

    public Riskgroup $riskGroup;

    public Risksubgroup $riskSubgroup;

    protected $rules = [
        'groupSelected' => '',
    ];

    protected $listeners = ['riskgroupSelected', 'risksubgroupSelected'];

    public function mount(\App\Models\Admin\Country $country)
    {
        $this->country = $country;
        $this->riskGroup = Riskgroup::make();
        $this->riskSubgroup = Risksubgroup::make();
    }

    public function riskgroupSelected(Riskgroup $group)
    {
        $this->riskGroup = $group;
    }

    public function risksubgroupSelected(Risksubgroup $subgroup)
    {
        $this->riskSubgroup = $subgroup;
    }

    public function updatedGroupSelected($value)
    {
        $this->riskGroup = Riskgroup::find($value);
    }

    public function render()
    {
        return view('livewire.administration.risks', [
            'groups' => $this->country->riskgroups,
            //            'subgroups' =>
        ]);
    }
}
