<?php

namespace App\Http\Livewire;

use App\Models\Documentversion;
use App\Models\Gabinete;
use Livewire\Component;

class GabineteManagement extends Component
{
    public $showSubmenu;

    public $selectedGabinete;

    public $gabinete;

    protected $queryString = ['showSubmenu'];

    public function mount($gabinete)
    {
        $this->selectedGabinete = $gabinete;
        $this->checkAccessAllowed();
        ! $this->showSubmenu ? $this->showSubmenu = $gabinete.'Gabinete' : '';
    }

    public function checkAccessAllowed()
    {
        if (! auth()->user()->allowedToGabinete($this->gabinete) && $this->gabinete != 0) {
            return redirect(route('error.forbidden'));
        }
    }

    public function createGabinetesCollection()
    {
        if ($this->selectedGabinete === '0') {
            return auth()->user()->gabinetes;
        } else {
            return collect([Gabinete::find($this->selectedGabinete)]);
        }
    }

    public function render()
    {
        return view('livewire.gabinete-management', [
            'gabinetes' => $this->createGabinetesCollection(),
        ]);
    }
}
