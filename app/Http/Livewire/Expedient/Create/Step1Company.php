<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Admin\Ramo;
use App\Models\Expedient;
use App\Traits\HasContactData;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Step1Company extends Component
{
    use WithFileUploads,
        WithFileDelete,
        HasContactData,
        HasCompanyData,
        HasAddressData,
        HasPolicyData,
        Validations;

    public Expedient $expedient;

    public $capitals = [];

    public $condParticular;

    public function rules()
    {
        return array_merge(
            $this->validateExpedient(),
            $this->validatePolicy(),
            $this->validateCompany(),
            [
                'expedient.billable_id' => 'required',
                'expedient.ramo_id' => 'required',
                'expedient.reference' => 'required',
                'expedient.requires_policy' => '',
                'capitals.*.amount' => '',
                'capitals.*.primer_riesgo' => '',
                'policy.reference' => 'required',
                'policy.product_id' => 'required',
            ],
        );
    }

    public function validationAttributes()
    {
        return [
            'expedient.billable_id' => __('compañía'),
            'expedient.ramo_id' => __('ramo'),
            'expedient.reference' => __('referencia de compañía'),
            'policy.product_id' => __('producto'),
            'policy.reference' => __('Número de póliza'),
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        if (! $this->expedient->gabinete_id) {
            if (auth()->user()->myGabinetes()->count() > 1) {
                $this->expedient->gabinete_id = '';
            } else {
                $this->expedient->gabinete_id = auth()->user()->favoriteGabinete()->id;
            }
        }
        ! $this->expedient->billable && $this->expedient->billable_id = '';
        ! $this->expedient->agent_id && $this->expedient->agent_id = '';
        ! $this->expedient->requires_policy && $this->expedient->requires_policy = 1;
        $this->initializeCompany($this->expedient->billable_id);
        $this->initializePolicy($this->expedient->policy);
        $this->ramo = $this->expedient->ramo ?: Ramo::make();
        $this->loadCapitals();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedExpedientBillableId($value)
    {
        $this->company = \App\Models\Insurance\Company::find($value);
        $this->expedient->agent_id = '';
        $this->expedient->ramo_id = '';
        $this->policy->company_id = $value;
    }

    public function updatedExpedientAgentId()
    {
        $this->expedient->load('agent');
    }

    public function updatedExpedientRamoId($value)
    {
        $this->ramo = Ramo::find($value);
        $this->policy->product_id = '';
        $this->policy->load('product');
        $this->expedient->typecases()->detach();
        $this->ramo->load('products');
        $this->loadCapitals();
    }

    public function updatedExpedientGabineteId()
    {
        $this->initializeCompany($this->expedient->billable_id);
    }

    public function updatedPolicyProductId()
    {
        $this->policy->load('product');
        $this->loadCapitals();
    }

    public function updatedPolicyReference($value)
    {
        if ($policy = $this->checkPolicy($value)) {
            $this->policy = $policy;
            $this->expedient->ramo_id = $this->policy->product->ramo_id;
        } else {
            $this->policy->id = null;
        }
        $this->loadCapitals();
    }

    public function loadCapitals()
    {
        $this->capitals = [];
        if ($this->policy->product) {
            foreach ($this->policy->product->capitals as $capital) {
                if ($insuredCapital = $this->policy->capitals->where('id', $capital->id)->first()) {
                    $amount = $insuredCapital->pivot->amount;
                    $primerRiesgo = $insuredCapital->pivot->primer_riesgo;
                } else {
                    $amount = '';
                    $primerRiesgo = false;
                }
                $this->capitals[$capital->id] = ['amount' => $amount, 'name' => $capital->name, 'primer_riesgo' => $primerRiesgo];
            }
        }
    }

    public function resetAll()
    {
        $this->initializeCompany($this->expedient->billable_id);
    }

    public function goToStep($step)
    {
        $this->validate();
        if (! $this->expedient->agent_id) {
            $this->expedient->agent_id = null;
        }
        if (! $this->expedient->creator_id) {
            $this->expedient->creator_id = auth()->user()->id;
        }
        if (! $this->expedient->code) {
            $this->expedient->code = $this->expedient->createCode($this->expedient->gabinete_id);
        }
        $this->company->expedients()->save($this->expedient);

        $this->policy->save();
        $this->expedient->update(['policy_id' => $this->policy->id]);
        $this->condParticular
            && $this->deleteFile('policies', $this->policy->cond_particular)
            && $this->policy->update([
                'cond_particular' => $this->condParticular->store('/', 'policies'),
            ]);

//        dd(array_columns($this->capitals, ['amount', 'primer_riesgo']));

        $capitalsToSync = [];

        if ($this->capitals) {
            foreach ($this->capitals as $key => $capital) {
                if ($capital['amount']) {
                    $capitalsToSync[$key] = ['amount' => $capital['amount'], 'primer_riesgo' => $capital['primer_riesgo']];
                }
            }
            $this->policy->capitals()->sync($capitalsToSync);
        }

        $this->emit('expedientCreated', $this->expedient->id);
        $this->emit('createCaseGoToStep', $step);
    }

    public function render()
    {
        return view('livewire.expedient.create.step1-company');
    }
}
