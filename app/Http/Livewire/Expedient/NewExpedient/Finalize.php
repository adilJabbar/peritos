<?php

namespace App\Http\Livewire\Expedient\NewExpedient;

use App\Models\Admin\Status;
use App\Models\Expedient;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Finalize extends Component
{
    use WithFileUploads, WithFileDelete;

    public Expedient $expedient;

    public $pictures = [];

    public $documents = [];

    protected $rules = [
        'expedient.private_comments' => '',
        'expedient.adjuster_id' => 'required',
    ];

    public function getValidationAttributes()
    {
        return [
            'expedient.adjuster_id' => 'asignado a',
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        if (! $this->expedient->adjuster_id) {
            if (class_basename($this->expedient->billable) === 'Company') {
                $this->expedient->adjuster_id = $this->expedient->gabinete->companies->where('id', $this->expedient->billable_id)->first()->pivot['default_assign_user'] ?? auth()->user()->id;
            } else {
                $this->expedient->adjuster_id = '';
            }
        }
    }

    public function finish()
    {
        $this->validate();
//        dd($this->expedient);
        $this->expedient->status_id = Status::where('name', 'Pendiente de contacto')->first()->id ?? 2;
        $this->expedient->save();
        if ($this->pictures) {
            foreach ($this->pictures as $attachment) {
                $picture = $this->expedient->pictures()->create([
                    'path' => $attachment->store('/'.$this->expedient->id, 'images'),
                    'name' => pathinfo($attachment->getClientOriginalName())['filename'],
                ]);
                $this->expedient->attachments()->create([
                    'path' => 'images/'.$picture->path,
                    'name' => $picture->name,
                ]);
            }
        }
        if ($this->documents) {
            foreach ($this->documents as $attachment) {
                $document = $this->expedient->anexos()->create([
                    'path' => $attachment->store('/'.$this->expedient->id, 'anexos'),
                    'name' => pathinfo($attachment->getClientOriginalName())['filename'],
                ]);
                $this->expedient->attachments()->create([
                    'path' => 'anexos/'.$document->path,
                    'name' => $document->name,
                ]);
            }
        }
    }

    public function finishAndList()
    {
        $this->finish();
        redirect(route('expedient.index'));
    }

    public function finishAndOpen()
    {
        $this->finish();
        redirect(route('expedient.edit', ['expedient' => $this->expedient]));
    }

    public function render()
    {
        return view('livewire.expedient.new-expedient.finalize');
    }
}
