<?php

namespace App\Http\Livewire\Administration\Deprecationgroup;

use App\Models\Admin\Country;
use Livewire\Component;

class Table extends Component
{
    public $country;

    protected $listeners = ['deprecationgroupsUpdated' => '$refresh'];

    public function mount(Country $country)
    {
        $this->country = $country;
    }

    public function render()
    {
        return view('livewire.administration.deprecationgroup.table', [
            'deprecationGroups' => $this->country->deprecationgroups,
        ]);
    }
}
