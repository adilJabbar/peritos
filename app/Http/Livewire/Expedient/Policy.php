<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use App\Models\Insurance\Product;
use App\Traits\WithExpedientAccessCheck;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Policy extends Component
{
    use WithExpedientAccessCheck,
        WithFileUploads,
        WithFileDelete;

    public bool $readonly = true;

    public $isCompanyExpedient = false;

    public $condicionesGenerales;

    public $condicionesParticulares;

    public $docToView = 'generales';

    public $ramo;

    public Expedient $expedient;

    public \App\Models\Insurance\Policy $policy;

    protected $listeners = ['condicionesUpdated' => '$refresh'];

    protected $rules = [
        'condicionesGenerales' => '',
        'condicionesParticulares' => 'file|mimes:pdf|max:4096',
        'policy.product_id' => '',
        'policy.cond_particular' => '',
        'policy.name_cia' => 'string|min:3',
        'policy.reference' => 'string|min:3',
    ];

    protected $queryString = ['docToView'];

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->verifyAllowed();

//        dd($this->expedient->policy);
        auth()->user()->can('expedient.update') && $this->readonly = false;

        $this->isCompanyExpedient = class_basename($this->expedient->billable) == 'Company';
        $this->ramo = $this->expedient->ramo_id;
        $this->policy = $this->expedient->policy ?? \App\Models\Insurance\Policy::make(['product_id' => null]);
        if (! $this->policy->product_id) {
            $this->policy->product_id = '';
        }
        $this->loadAvailableCapitals();
    }

    public function updated($field)
    {
        if ($field === 'policy.product_id') {
            $this->policy->update();
            $this->policy->refresh();
        }
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

    public function save()
    {
        if ($this->policy->product_id == '') {
            $this->policy->product_id = null;
        }

        if (! $this->isCompanyExpedient) {
            $this->validate([
                'policy.name_cia' => 'required|string|min:3',
                'policy.reference' => 'required|string|min:3',
            ]);
        }

        $this->condicionesGenerales
            && $this->deleteFile('products', $this->policy->product->cond_general)
            && $this->policy->product->update([
                'cond_general' => $this->condicionesGenerales->store('/', 'products'),
            ]);

        $this->condicionesParticulares
            && $this->deleteFile('policies', $this->policy->cond_particular)
            && $this->policy->update([
                'cond_particular' => $this->condicionesParticulares->store('/', 'policies'),
            ]);

        $this->reset(['condicionesGenerales', 'condicionesParticulares']);

        $this->emit('condicionesUpdated');
    }

    public function cancel($model)
    {
        $this->reset($model);
        $this->emit('condicionesUpdated');
    }

    public function render()
    {
        return view('livewire.expedient.edit.policy', [
            'products' => Product::where(['ramo_id' => $this->ramo, 'company_id' => $this->policy->company_id])->get(),
        ]);
    }
}
