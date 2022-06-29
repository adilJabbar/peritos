<?php

namespace App\Http\Livewire\Administration\Capital;

use App\Models\Admin\Capital;
use App\Models\Admin\Ramo;
use Livewire\Component;

class Row extends Component
{
    public $capital;

    public $total = false;

    protected $rules = [
        'capital.ramo_id' => '',
        'capital.name' => 'required',
        'capital.position' => '',
        'capital.predefined' => '',
    ];

    public function mount(Capital $capital, $total = null)
    {
        $this->capital = $capital;
        $this->total = $total;
        ! $this->capital->predefined ? $this->capital->predefined = '' : '';
    }

    public function updated($field, $value)
    {
        $this->validateOnly($field);
        $this->capital->update([$field => $value]);
    }

    public function moveUp()
    {
        if ($this->capital->position != 1) {
            $this->capital->moveUp();
        }

        $this->emit('capitalsUpdated');
    }

    public function moveDown()
    {
        if ($this->capital->position != $this->total) {
            $this->capital->moveDown();
        }

        $this->emit('capitalsUpdated');
    }

    public function save()
    {
        $this->validate();
        if (! $this->capital->getKey()) {
            $this->capital->position = Ramo::find($this->capital->ramo_id)->capitals->count() + 1;
        }

        $this->capital->save();
        $this->capital = Capital::make([
            'ramo_id' => $this->capital->ramo_id,
        ]);
        $this->emit('capitalsUpdated');
    }

    public function delete()
    {
        $higherCapital = Capital::where('ramo_id', $this->capital->ramo_id)
            ->where('position', '>', $this->capital->fresh()->position)->get();
        foreach ($higherCapital as $capital) {
            $capital->update(['position' => $capital->position - 1]);
        }
        $this->capital->products()->detach();
        $this->capital->delete();

        $this->emit('capitalsUpdated');
    }

    public function render()
    {
        return view('livewire.administration.capital.row');
    }
}
