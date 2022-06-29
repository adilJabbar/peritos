<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use App\Traits\HasWorkTime;
use App\Traits\WithExpedientAccessCheck;
use Livewire\Component;

class Edit extends Component
{
    use WithExpedientAccessCheck, HasWorkTime;

    public Expedient $expedient;

    public $showSubmenu = '';

    public $topMenu = '';

    protected $queryString = ['showSubmenu'];

    protected $listeners = ['expedientManagementUpdated' => '$refresh'];

    public function mount($expedient)
    {
        $this->expedient = $expedient;
        $this->verifyAllowed();
//       !$this->topMenu ? $this->topMenu = 'expedient' : '';
        ! $this->showSubmenu ? $this->showSubmenu = 'summary' : '';
        $this->updatedShowSubmenu($this->showSubmenu);
    }

    public function updatedShowSubmenu($value)
    {
        if (in_array($value, ['preexistence', 'texts', 'assessment', 'tasacion', 'anexos'])) {
            $this->topMenu = 'technicalZone';
        } elseif (in_array($value, ['communications', 'documentLog'])) {
            $this->topMenu = 'envios';
        } elseif (in_array($value, ['billing'])) {
            $this->topMenu = 'contabilidad';
        } else {
            $this->topMenu = 'summary';
        }

        $this->emit('loadedWorkTimeArea', \App\Models\Expedient::class, $this->expedient->id, $this->topMenu);
    }

    public function render()
    {
        return view('livewire.expedient.edit');
    }
}
