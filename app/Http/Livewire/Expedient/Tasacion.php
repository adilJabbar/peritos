<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Admin\Capital;
use App\Models\Expedient;
use App\Models\Insurance\Subguarantee;
use App\Models\Person;
use Livewire\Component;

class Tasacion extends Component
{
    public Expedient $expedient;

    public $assessments;

    public $capitals;

    public $subguarantees;

    public $people;

    public $destinies;

    public Subguarantee $subguarantee;

    public $showCalculationModal = false;

    public $tasacionView;

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        ! $this->tasacionView ? $this->tasacionView = 'capital' : '';
        $this->updatedTasacionView($this->tasacionView);
    }

    public function loadTasacionCapitalData()
    {
        $tasacion = $this->expedient->tasacionCapital();
        $this->capitals = $tasacion['capitals'];
        $this->subguarantees = $tasacion['subguarantees'];
        $this->people = $tasacion['people'];
        $this->destinies = $tasacion['destinies'];
    }

    public function loadTasacionPersonData()
    {
        $tasacion = $this->expedient->tasacionPerson();
        $this->capitals = $tasacion['capitals'];
        $this->subguarantees = $tasacion['subguarantees'];
        $this->people = $tasacion['people'];
        $this->destinies = $tasacion['destinies'];
    }

    public function updatedTasacionView($value)
    {
        $value == 'capital'
            ? $this->loadTasacionCapitalData()
            : $this->loadTasacionPersonData();
    }

    public function showCalculations(Subguarantee $subguarantee)
    {
        $this->subguarantee = $subguarantee;
        $this->assessments = $this->expedient->assessments->where('subguarantee_id', $subguarantee);
        $this->showCalculationModal = true;
    }

    public function render()
    {
        return view('livewire.expedient.edit.tasacion');
    }
}
