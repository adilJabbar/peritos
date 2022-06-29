<?php

namespace App\Http\Livewire\Anexo;

use App\Models\Expedient\Anexo;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class AnexoRow extends Component
{
    use WithFileUploads,
        WithFileDelete;

    public Anexo $anexo;

    protected $rules = [
        'anexo.name' => 'required',
    ];

    public function mount(Anexo $anexo)
    {
        $this->anexo = $anexo;
    }

    public function updatedAnexoName()
    {
        $this->anexo->save();
    }

    public function removeAnexo()
    {
        $this->deleteFile('expedients', $this->anexo->path);
        $this->anexo->delete();
        $this->emit('anexosUpdated');
    }

    public function render()
    {
        return view('livewire.anexo.anexo-row');
    }
}
