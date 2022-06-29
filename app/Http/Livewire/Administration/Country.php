<?php

namespace App\Http\Livewire\Administration;

use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Country extends Component
{
    use WithFileUploads,
    WithFileDelete;

    public \App\Models\Admin\Country $country;

    public $flag;

    public $showSubmenu;

    protected $queryString = ['showSubmenu'];

    protected $listeners = ['statesUpdated'];

    public function rules()
    {
        return array_merge(
            $this->countryDataRules(),
            [
                'newRamo' => '',
                'ramoSelected.name' => '',
                'ramoSelected.preexistence_class_id' => '',
            ]
        );
    }

    public function countryDataRules()
    {
        return [
            'country.name' => 'required',
            'country.code' => 'required',
            'country.taxes' => 'required',
            'country.precio_m' => '',
            'country.furniture' => '',
            'country.room' => '',
            'country.person' => '',
            'country.anexo' => '',
            'country.currency_id' => 'required|exists:App\Models\Admin\Currency,id',
            'flag' => '',
        ];
    }

    public function mount($country)
    {
        $this->country = $country;
    }

    public function saveData()
    {
        $this->validate($this->countryDataRules());
        $this->country->save();

        $this->flag
        && $this->deleteFile('public', $this->flag)
        && $this->country->update([
            'flag' => $this->flag->store('img/flags', 'public'),
        ]);

        $this->notify(__('Guardado'), __('Se han actualizado los datos del país'));
    }

    public function statesUpdated()
    {
        $this->country->load('states');
    }

    public function render()
    {
        return view('livewire.administration.country.country');
    }
}
