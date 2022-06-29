<?php

namespace App\Http\Livewire\Administration\Risk;

use Livewire\Component;

class DetailTable extends Component
{
    public $riskSubgroup;

    protected $listeners = ['riskDetailsUpdated' => '$refresh'];

    public function mount($riskSubgroup)
    {
        $this->riskSubgroup = $riskSubgroup;
    }

    public function render()
    {
        return view('livewire.administration.risk.detail-table', [
            'details' => $this->riskSubgroup->riskdetails,
        ]);
    }
}
