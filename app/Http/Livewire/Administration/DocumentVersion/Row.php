<?php

namespace App\Http\Livewire\Administration\DocumentVersion;

use App\Models\Documentversion;
use Livewire\Component;

class Row extends Component
{
    public Documentversion $document;

    protected $rules = [
        'document.type' => 'required',
        'document.name' => 'required',
        'document.path' => 'required',
    ];

    public function mount($document)
    {
        $this->document = $document;
    }

    public function updated()
    {
        $this->validate();
        $this->document->save();
    }

    public function save()
    {
        $this->validate();
        $this->document->save();
//        $this->emit('reportsUpdated');
    }

    public function delete()
    {
        $this->document->delete();
        $this->emit('reportsUpdated');
    }

    public function render()
    {
        return view('livewire.administration.document-version.row');
    }
}
