<?php

namespace App\Http\Livewire\Input;

use Illuminate\Support\Collection;
use Livewire\Component;

class Multiple extends Component
{
//    public $attributes;
    public $user;

    public $error;

    public $event;

    public $field = 'name';

    public $options = [];

    public $availableOptions = [];

    public $selectedOptions;

    public $preSelectedOptions;

    public $filteredOptions = [];

    public $selectId;

    public $type;

    public $search = '';

    public $leadingAddOn;

    public $placeholder;

    public function mount()
    {
//        dd($this->selectedOptions);
        $this->selectedOptions = collect($this->preSelectedOptions);
        $this->availableOptions = $this->options;
    }

    public function addSelected($element)
    {
        $this->selectedOptions->push($element);
        $this->updateOptions();
    }

    public function clearSelected($id)
    {
        $selected = $this->selectedOptions->firstWhere('id', $id);
        $this->selectedOptions = $this->selectedOptions->filter(function ($value, $key) use ($selected) {
            return $value['id'] != $selected['id'];
        });
        $this->updateOptions();
    }

    public function updateOptions()
    {
        $this->search = '';
        $this->availableOptions = $this->options->whereNotIn('id', $this->selectedOptions->pluck('id'));
        $this->emit($this->event, $this->selectedOptions);
    }

    public function render()
    {
//        if($this->selectedOptions->count() > 0)
//            dd($this->selectedOptions);

        $searchValue = $this->search;
        $this->filteredOptions = $this->search
            ? $this->availableOptions->filter(function ($item) use ($searchValue) {
                return false !== stripos($item, $searchValue);
            })
            : $this->availableOptions;

        return view('livewire.input.multiple');
    }
}
