<?php

namespace App\Http\Livewire\Administration\Typecase;

use App\Models\Admin\Typecase;
use Livewire\Component;

class Row extends Component
{
    public Typecase $typecase;

    protected $rules = [
        'typecase.ramo_id' => '',
        'typecase.name' => 'required|min:3',
        'typecase.texts' => '',
        'typecase.preexistences' => 'boolean',
        'typecase.tasacion' => 'boolean',
    ];

    public function mount(Typecase $typecase)
    {
        $this->typecase = $typecase;
        ! $this->typecase->preexistences ? $this->typecase->preexistences = false : '';
        ! $this->typecase->tasacion ? $this->typecase->tasacion = false : '';
        $this->emit('typeCasesUpdated');
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->typecase->getKey()
            && $this->typecase->save();
    }

    public function save()
    {
        $this->validate();
        $this->typecase->save();
        $this->typecase = Typecase::make(['ramo_id' => $this->typecase->ramo_id, 'preexistences' => false, 'tasacion' => false]);
        $this->emit('typeCasesUpdated');
    }

    public function delete()
    {
        $this->typecase->delete();
        $this->emit('typeCasesUpdated');
    }

    public function render()
    {
        return view('livewire.administration.typecase.row');
    }
}
