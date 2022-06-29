<?php

namespace App\View\Components\Administration\Destiny;

use Illuminate\View\Component;

class Table extends Component
{
    public $destinies;

    /**
     * CreateOld a new component instance.
     *
     * @return void
     */
    public function __construct($destinies)
    {
        $this->destinies = $destinies;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.administration.destiny.table');
    }
}
