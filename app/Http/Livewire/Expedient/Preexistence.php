<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use App\Models\Preexistence\HomePreexistence;
use App\Traits\WithExpedientAccessCheck;
use Livewire\Component;

class Preexistence extends Component
{
    use WithExpedientAccessCheck;

    public Expedient $expedient;

    public Expedient\TextPreexistence $textPreexistence;

    public bool $readonly = true;

    protected $rules = [
        'textPreexistence.expedient_id' => 'required',
        'textPreexistence.risk_description' => 'min:20',
        'textPreexistence.risk_matches' => 'min:2',
    ];

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->verifyAllowed();

        auth()->user()->can('expedient.update') && $this->readonly = false;

        $this->textPreexistence = $this->expedient->textPreexistence ?? $this->expedient->textPreexistence()->make();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->textPreexistence->save();
    }

    public function render()
    {
        return view('livewire.expedient.edit.preexistence');
    }
}
