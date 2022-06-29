<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class TwoColumns extends Component
{
    /**
     * CreateOld a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.layout.two-columns');
    }
}
