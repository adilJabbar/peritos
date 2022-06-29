<?php

namespace App\Http\Livewire\Country\RiskDetails;

use App\Models\Admin\Riskdetail;
use Livewire\Component;

class Row extends Component
{
    public Riskdetail $detail;

    protected $rules = [
        'detail.description' => 'required|min:3',
        'detail.vpo_modificator' => 'required',
        'detail.low_modificator' => 'required',
        'detail.national_modificator' => 'required',
        'detail.high_modificator' => 'required',
        'detail.luxe_modificator' => 'required',
    ];

    public function getValidationAttributes()
    {
        return [
            'vpo_modificator' => __('vpo'),
            'low_modificator' => __('baja'),
            'national_modificator' => __('normal'),
            'high_modificator' => __('alta'),
            'luxe_modificator' => __('lujo'),
        ];
    }

    public function mount($detail)
    {
        $this->detail = $detail;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->detail->save();
    }

    public function delete()
    {
        $this->detail->delete() && $this->notify(__('Deleted'), __('La tipología de edificaciones ha sido eliminada'));
        $this->emit('detailDeleted');
    }

    public function render()
    {
        return view('livewire.country.risk-details.row');
    }
}
