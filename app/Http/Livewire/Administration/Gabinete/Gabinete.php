<?php

namespace App\Http\Livewire\Administration\Gabinete;

use App\Traits\WithSideNavigation;
use Livewire\Component;

class Gabinete extends Component
{
    use WithSideNavigation;

    public \App\Models\Gabinete $gabinete;

    protected $queryString = ['showSubmenu'];

    protected $listeners = ['GabineteDataUpdated' => '$refresh'];

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
        $this->mountSubmenu('data');
    }

    public function render()
    {
        return view('livewire.administration.gabinete.gabinete');
    }
}
