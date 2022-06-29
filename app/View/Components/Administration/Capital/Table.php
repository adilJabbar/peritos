<?php

namespace App\View\Components\Administration\Capital;

use App\Models\Admin\Ramo;
use Illuminate\View\Component;

class Table extends Component
{
    public $capitals;

    public $ramo;

    /**
     * CreateOld a new component instance.
     *
     * @return void
     */
    public function __construct($capitals, Ramo $ramo = null)
    {
        $this->capitals = $capitals;
        $this->ramo = $ramo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.administration.capital.table');
    }
}
