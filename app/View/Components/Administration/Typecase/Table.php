<?php

namespace App\View\Components\Administration\Typecase;

use App\Models\Admin\Ramo;
use Illuminate\View\Component;

class Table extends Component
{
    public $typecases;

    public $ramo;

    /**
     * CreateOld a new component instance.
     *
     * @return void
     */
    public function __construct($typecases, Ramo $ramo = null)
    {
        $this->typecases = $typecases;
        $this->ramo = $ramo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.administration.typecase.table');
    }
}
