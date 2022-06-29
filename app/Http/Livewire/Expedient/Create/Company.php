<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Expedient;
use Livewire\Component;

class Company extends Component
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

    public function createCaseGoToStep($nextStep)
    {
        if (! in_array($this->currentStep, $this->completedSteps)) {
            array_push($this->completedSteps, $this->currentStep);
        }
        $this->currentStep = $nextStep > $this->currentStep
            ? $nextStep
            : $this->currentStep;
        $this->openedStep = $nextStep;
    }

    public function render()
    {
        return view('livewire.expedient.create.company');
    }
}
