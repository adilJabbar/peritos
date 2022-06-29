<?php

namespace App\Http\Livewire\Administration\Destiny;

use App\Models\Admin\Destiny;
use Livewire\Component;

class Row extends Component
{
    public Destiny $destiny;

    protected $rules = [
        'destiny.code' => 'required',
        'destiny.name' => 'required',
    ];

    public function mount(Destiny $destiny)
    {
        $this->destiny = $destiny;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->destiny->getKey()
            && $this->destiny->save();
    }

    public function delete()
    {
        $this->destiny->delete();
        $this->emit('destiniesUpdated');
    }

    public function save()
    {
        $this->validate();
        $this->destiny->save();
        $this->emit('destiniesUpdated');
        $this->destiny = Destiny::make();
    }

    public function render()
    {
        return view('livewire.administration.destiny.row');
    }
}
