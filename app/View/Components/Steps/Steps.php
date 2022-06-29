<?php

namespace App\View\Components\Steps;

use Illuminate\View\Component;

class Steps extends Component
{
    public $steps;

    public $stepSelected;

    public $completedSteps;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($steps, $stepSelected, $completedSteps)
    {
        //
        $this->steps = $steps;
        $this->stepSelected = $stepSelected;
        $this->completedSteps = $completedSteps;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.steps.steps');
    }
}
