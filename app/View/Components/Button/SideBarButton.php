<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class SideBarButton extends Component
{
    public $active;

    public $classes;

    public $url;

    public $placeholder;

    /**
     * CreateOld a new component instance.
     *
     * @return void
     */
    public function __construct($active, $url)
    {
        $this->active = $active;
        $this->classes = $this->active
            ? 'bg-gray-900 text-white flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg'
            : 'text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg';
        $this->url = $url ?? '#';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.button.side-bar-button');
    }
}
