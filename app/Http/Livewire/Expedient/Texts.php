<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use App\Traits\WithExpedientAccessCheck;
use Livewire\Component;

class Texts extends Component
{
    use WithExpedientAccessCheck;

    public Expedient $expedient;

    public Expedient\TextAdjuster $textAdjuster;

    public bool $readonly = true;

    protected $rules = [
        'textAdjuster.expedient_id' => 'required',
        'textAdjuster.attended_by' => 'required|min:5',
        'textAdjuster.chronology' => 'required|min:20',
        'textAdjuster.adjuster' => 'min:20',
        'textAdjuster.damages' => 'min:20',
        'textAdjuster.evaluations' => 'min:20',
        'textAdjuster.coverage' => 'min:20',
    ];

    public function validationAttributes()
    {
        return [
            'textAdjuster.attended_by' => __('atendido por'),
            'textAdjuster.chronology' =>  __('cronología'),
            'textAdjuster.adjuster' =>  __('intervención pericial'),
            'textAdjuster.damages' =>  __('descripción de daños'),
            'textAdjuster.evaluations' =>  __('comentarios a la valoración'),
            'textAdjuster.coverage' =>  __('comentarios sobre cobertura'),
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->verifyAllowed();

        auth()->user()->can('expedient.update') && $this->readonly = false;

        $this->textAdjuster = $this->expedient->textAdjuster
            ? $this->expedient->textAdjuster
            : $this->expedient->textAdjuster()->make();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->textAdjuster->save();
    }

    public function render()
    {
        return view('livewire.expedient.edit.texts');
    }
}
