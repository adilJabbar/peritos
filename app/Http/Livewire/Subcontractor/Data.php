<?php

namespace App\Http\Livewire\Subcontractor;

use App\Models\Subcontractor;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Data extends Component
{
    public Subcontractor $subcontractor;

    public function rules()
    {
        return [
            'subcontractor.gabinete_id' => 'required|exists:gabinetes,id',
            'subcontractor.name' => 'required|min:3',
            'subcontractor.legal_name' => 'min:3',
            'subcontractor.legal_id' => '',
            'subcontractor.address' => '',
            'subcontractor.city' => '',
            'subcontractor.zip' => '',
            'subcontractor.state' => '',
            'subcontractor.country_id' => 'required',
            'subcontractor.phone' => 'string|min:7',
            'subcontractor.email' => ['required', 'email', Rule::unique('subcontractors', 'email')->ignore($this->subcontractor)],
        ];
    }

    public function mount($subcontractor)
    {
        $this->subcontractor = $subcontractor;
    }

    public function save()
    {
        $this->validate();
        $this->subcontractor->save();
        $this->emit('subcontractorUpdated');
        $this->notify(__('Guardado'), __('Los datos de la subcontrata se han actualizado'));
    }

    public function render()
    {
        return view('livewire.subcontractor.data');
    }
}
