<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Admin\Status;
use App\Models\Expedient;
use Livewire\Component;

class Header extends Component
{
    public Expedient $expedient;

    public string $title;

    protected $rules = [
        'expedient.status_id' => 'required|in:statuses,id',
    ];

    public function mount($expedient, $title)
    {
        $this->expedient = $expedient;
        $this->title = $title;
    }

    public function updatedExpedientStatusId()
    {
        $this->expedient->updateStatus($this->expedient->getOriginal('status_id'), $this->expedient->status_id);
        $this->expedient->save();
        $this->notify(__('Actualizado'), __('Se ha actualizado el estado del expediente'));
    }

    public function render()
    {
        return view('livewire.expedient.header', [
            'statuses' => Status::orderBy('order')->get(),
        ]);
    }
}
