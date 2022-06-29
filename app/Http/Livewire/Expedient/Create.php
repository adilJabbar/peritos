<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Address;
use App\Models\Expedient;
use App\Models\Gabinete;
use App\Models\Insurance\Company;
use App\Models\Person;
use Livewire\Component;

class Create extends Component
{
    public Expedient $expedient;

    public $steps = [
        1 => 'Alta del expediente',
        2 => 'Datos del siniestro',
        3 => 'Terceros afectados',
    ];

    public $currentStep = 1;

    public $openedStep = 1;

    public $completedSteps = [];

    protected $listeners = ['createCaseGoToStep', 'expedientCreated'];

//    protected $queryString = ['expedient'];

    public function mount()
    {
        $this->expedient = Expedient::make([
            'agent_id' => '',
        ]);
    }

    public function expedientCreated($expedient_id)
    {
        $this->expedient = Expedient::find($expedient_id);
    }

    public function createCaseGoToStep($step)
    {
        if (! in_array($this->openedStep, $this->completedSteps)) {
            array_push($this->completedSteps, $this->currentStep);
            $this->currentStep = $step;
        }
        $this->openedStep = $step;
    }

    public function render()
    {
        return view('livewire.expedient.create');
    }
}
