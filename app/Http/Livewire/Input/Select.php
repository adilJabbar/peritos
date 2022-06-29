<?php

namespace App\Http\Livewire\Input;

use Livewire\Component;

class Select extends Component
{
    public $search = '';

    public $options = [];

    public $filteredOptions = [];

    public function mount()
    {
        $this->filteredOptions = $this->options;
    }

//    public function updatedSearch()
//    {
//
    ////        $this->filteredOptions = $this->options->filter(function ($item) use ($searchValue) {
    ////            return false !== stripos($item, $searchValue);
    ////        });
    ////        dd($this->filteredOptions);
//    }

    public function render()
    {
        $searchValue = $this->search;
        $this->filteredOptions = $this->search
            ? $this->options->filter(function ($item) use ($searchValue) {
                return false !== stripos($item, $searchValue);
            })
            : $this->options;

        return view('livewire.input.select');
    }
}
