<?php

namespace App\Http\Livewire\Country;

use App\Models\Admin\Country;
use App\Models\Admin\Riskgroup;
use App\Models\Admin\Risksubgroup;
use Livewire\Component;

class Buildings extends Component
{
    public Country $country;

    public $newGroup;

    public $newSubgroup;

    public $newDetail;

    public Riskgroup $groupSelected;

    public Risksubgroup $subgroupSelected;

    protected $listeners = [
        'riskGroupDeleted',
        'riskSubGroupDeleted',
        'groupSelected',
        'subgroupSelected',
        'detailDeleted',
    ];

    protected $rules = [
        'newGroup' => 'required|min:3',
        'newSubgroup' => 'required|min:3',
        'newDetail' => 'required|min:3',
    ];

    public function getValidationAttributes()
    {
        return [
            'newGroup' => __('nuevo grupo'),
            'newSubgroup' => __('nuevo sub-grupo'),
            'newDetail' => __('tipología'),
        ];
    }

    public function mount($country)
    {
        $this->country = $country;
        $this->groupSelected = Riskgroup::make();
        $this->subgroupSelected = Risksubgroup::make();
    }

    public function addDetail()
    {
        $this->validate(['newDetail' => 'required|min:3']);
        $this->subgroupSelected->riskdetails()->create([
            'description' => $this->newDetail,
        ]);
        $this->newDetail = '';
        $this->emit('subgroupModified');
        $this->subgroupSelected->load('riskdetails');
    }

    public function addGroup()
    {
        $this->validate(['newGroup' => 'required|min:3']);
        $this->country->riskgroups()->create(['name' => $this->newGroup]);
        $this->newGroup = '';
        $this->country->load('riskgroups');
    }

    public function addSubgroup()
    {
        $this->validate(['newSubgroup' => 'required|min:3']);
        $this->groupSelected->risksubgroups()->create(['name' => $this->newSubgroup]);
        $this->newSubgroup = '';
        $this->emit('groupModified');
        $this->groupSelected->load('risksubgroups');
    }

    public function detailDeleted()
    {
        $this->subgroupSelected->load('riskdetails');
        $this->emit('subgroupModified');
    }

    public function groupSelected($groupId)
    {
        $this->groupSelected = Riskgroup::find($groupId);
        $this->emit('subgroupSelected', null);
    }

    public function riskGroupDeleted()
    {
        $this->country->load('riskgroups');
    }

    public function riskSubGroupDeleted()
    {
        $this->groupSelected->load('risksubgroups');
        $this->emit('groupModified');
    }

    public function subgroupSelected($subgroupId)
    {
        $this->subgroupSelected = Risksubgroup::find($subgroupId) ?? Risksubgroup::make();
    }

    public function render()
    {
        return view('livewire.country.buildings');
    }
}
