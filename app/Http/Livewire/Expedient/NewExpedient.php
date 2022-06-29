<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use App\Models\Gabinete;
use App\Traits\Expedient\newExpedient\RequesterManagement;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewExpedient extends Component
{
    use WithFileUploads,
        WithFileDelete,
        RequesterManagement;

    public Expedient $expedient;

    public $showSubmenu;

    public $showTerceros = false;

    public $showFinalize = false;

    protected $listeners = ['expedientCreated', 'expedientUpdated'];

    protected $rules = [
        'expedient.code' => 'required',
        'gabinete.id' => 'required',
    ];

    protected $queryString = ['showSubmenu'];

    public function mount($expedient = null)
    {
        ! $this->showSubmenu && $this->showSubmenu = 'Requester';
        if ($expedient) {
            $this->expedient = $expedient;
        } else {
            $this->expedient = Expedient::make(['creator_id' => auth()->user()->id]);
        }
//        if (auth()->user()->gabinetes->count() === 1) $this->gabinete = auth()->user()->gabinetes->first();
//        else $this->gabinete = Gabinete::make();
    }

    public function expedientCreated(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->showSubmenu = 'CaseData';
    }

    public function expedientUpdated($menu = null)
    {
        $this->expedient->fresh();
        if ($menu === 'Terceros') {
            $this->showTerceros = true;
        }
        if ($menu === 'Finalize') {
            $this->showFinalize = true;
        }
        if ($menu) {
            $this->showSubmenu = $menu;
        }
    }

    public function render()
    {
        return view('livewire.expedient.new-expedient');
    }
}
