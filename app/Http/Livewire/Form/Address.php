<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class Address extends Component
{
    public \App\Models\Address $address;

    public $readonly = false;

    protected $rules = [
        'address.addressable_type' => 'required',
        'address.name' => '',
        'address.address' => 'required',
        'address.city' => 'required',
        'address.zip' => 'required',
        'address.state' => 'required',
        'address.country_id' => 'required',
    ];

    protected $listeners = ['saveAddresses'];

    public function mount($address, $readonly, $addressable = null)
    {
        if ($addressable) {
            $this->addressable = $addressable;
        }
        $this->address = $address
            ? $address
            : \App\Models\Address::make(['country_id' => '']);
        $this->readonly = $readonly;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        if ($this->address->getKey()) {
            $this->address->save();
            $this->emit('addressUpdated');
        }
    }

    public function save()
    {
        $this->validate();
        $this->address->save();
    }

    public function saveAddresses($modelId)
    {
        $this->validate();
        if (! $this->address->addessable_id) {
            $this->address->addressable_id = $modelId;
        }
        $this->address->save();
    }

    public function render()
    {
        return view('livewire.form.address');
    }
}
