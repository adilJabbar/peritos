<?php

namespace App\Http\Livewire\MyGabinetes;

use App\Models\Gabinete;
use App\Traits\WithSideNavigation;
use Livewire\Component;

class MyGabinetes extends Component
{
    use WithSideNavigation;

    public $gabinetes;

    public $gabineteSelectedId;

    public $gabinete;

    protected $queryString = ['showSubmenu', 'gabineteSelectedId'];

    protected $listeners = ['GabineteDataUpdated' => '$refresh'];

    public function mount()
    {
        $this->mountSubmenu('Expedients');
        $this->gabinete = $this->gabineteSelectedId ? Gabinete::find($this->gabineteSelectedId) : auth()->user()->gabinetes->first();
        if (! $this->gabineteSelectedId) {
            $this->gabineteSelectedId = $this->gabinete->id;
        }
        $this->gabinetes = auth()->user()->gabinetes;
    }

    public function selectSubMenu($gabinete, $menu)
    {
        $this->gabineteSelectedId = $gabinete;
        $this->gabinete = Gabinete::find($gabinete);
        $this->showSubmenu = $menu;
    }

    public function render()
    {
        return view('livewire.gabinete.my-gabinetes');
    }
}
