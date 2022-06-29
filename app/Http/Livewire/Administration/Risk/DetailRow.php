<?php

namespace App\Http\Livewire\Administration\Risk;

use App\Models\Admin\Riskdetail;
use Livewire\Component;

class DetailRow extends Component
{
    public Riskdetail $detail;

    protected $rules = [
        'detail.risksubgroup_id' => 'required',
        'detail.description' => 'required',
        'detail.national_modificator' => 'required',
        'detail.vpo_modificator' => 'required',
        'detail.low_modificator' => 'required',
        'detail.high_modificator' => 'required',
        'detail.luxe_modificator' => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->detail->getKey()
            && $this->detail->save();
    }

    public function save()
    {
        $this->validate();
        $this->detail->save();
        $this->detail = Riskdetail::make(['risksubgroup_id' => $this->detail->risksubgroup_id]);
        $this->emit('riskDetailsUpdated');
    }

    public function delete()
    {
        $this->detail->safeDelete()
            ? $this->notify(__('Eliminado'), __('El detalle ha sido eliminado'))
            : $this->notify(__('Error'), __('El detalle no se puede eliminar. Tiene expedientes asociados'), 'error');
        $this->emit('riskDetailsUpdated');
    }

    public function render()
    {
        return view('livewire.administration.risk.detail-row');
    }
}
