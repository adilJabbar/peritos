<?php

namespace App\Http\Livewire\Expedient\NewExpedient;

use App\Models\Expedient;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Policy extends Component
{
    use WithFileUploads, WithFileDelete;

    public Expedient $expedient;

    public \App\Models\Insurance\Policy $policy;

    public $insuranceCompany = '';

    public $availableCapitals;

    public $capitals = [];

    public $condParticular;

    public $showCapitals = false;

    protected $rules = [
        'policy.company_id' => '',
        'policy.name_cia' => '',
        'policy.reference' => 'required',
        'policy.product_id' => 'required',
        'insuranceCompany' => '',
        //        'capitals' => 'array|min:1',
        //        'capitals.*.amount' => ''
    ];

    public function getValidationAttributes()
    {
        return [
            'reference' => __('referencia'),
            'capitals' => __('capitales'),
        ];
    }

    public function mount($expedient)
    {
        $this->expedient = $expedient;

        if ($this->expedient->policy) {
            $this->policy = $this->expedient->policy;
            $this->showCapitals = true;
        } else {
            $this->policy = \App\Models\Insurance\Policy::make(['product_id' => '', 'ramo_id' => $this->expedient->ramo_id]);
        }

        if (class_basename($this->expedient->billable) === 'Company') {
            $this->policy->company_id = $this->expedient->billable->id;
        }

        $this->loadAvailableCapitals();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedCapitals()
    {
        ////        dd($this->capitals);
////        $this->policy->load('product');
//        foreach($this->capitals as $key => $capital){
////            dd($capital);
////            if(!$this->policy->product->ramo) $this->capitals[$key]['amount'] = null;
//
//            if(array_key_exists('primer_riesgo', $capital) && !$capital['primer_riesgo']){
//                if(!array_key_exists('amount', $capital) || !$capital['amount']) {
//                    unset($this->capitals[$key]);
//                }
//            }
//        }
    }

    public function updatedInsuranceCompany($value)
    {
        if ($value !== 'notListedCompany') {
            $this->policy->company_id = $this->insuranceCompany;
            $this->policy->name_cia = null;
        } else {
            $this->policy->company_id = null;
        }
    }

    public function updatedPolicyProductId()
    {
        $this->validate([
            'policy.reference' => 'required',
            'policy.product_id' => 'required',
        ]);
        $this->policy->save();
        $this->policy->load('product');
        $this->loadAvailableCapitals();
        $this->capitals = [];
    }

    public function enterCapitals()
    {
        $this->validate();
        $this->condParticular
        && $this->deleteFile('policies', $this->policy->cond_particular)
        && $this->policy->update([
            'cond_particular' => $this->condParticular->store('/', 'policies'),
        ]);
        $this->policy->save();
        $this->emit('CapitalLoadPolicy', $this->policy->id);
        $this->expedient->policy_id = $this->policy->id;
        $this->expedient->save();
        $this->showCapitals = true;
    }

    public function loadAvailableCapitals()
    {
        if ($this->policy->product && $this->policy->product->ramo) {
            if ($this->policy->product->capitals->count() > 0) {
                $this->availableCapitals = $this->policy->product->capitals;
            } else {
                $this->availableCapitals = [];
            }
        } else {
            $this->availableCapitals = $this->expedient->ramo->capitals;
        }
        $this->loadCapitals();
    }

    public function loadCapitals()
    {
        $this->capitals = [];
        if ($this->policy->product && $this->policy->capitals) {
            foreach ($this->policy->capitals as $capital) {
                $this->capitals[$capital->id] = ['amount' => $capital->pivot->amount, 'primer_riesgo' => $capital->pivot->primer_riesgo];
            }
        }
    }

    public function removeCondParticular()
    {
        $this->deleteFile('policies', $this->policy->cond_particular);
        $this->policy->cond_particular = null;
        $this->policy->save();
        $this->condParticular = null;
    }

    public function saveAndGoTo($menu)
    {
        $this->notify(__('Guardado'), __('Los datos de la póliza se han actualizado'));
        $this->emit('expedientUpdated', $menu);
    }

    public function render()
    {
        return view('livewire.expedient.new-expedient.policy');
    }
}
