<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class AddressModal extends Component
{
    public $address;

    public $readonly = false;

    public $showModal = false;

    protected $rules = [
        'address.addressable_type' => 'required',
        'address.name' => '',
        'address.address' => 'required',
        'address.city' => 'required',
        'address.zip' => 'required',
        'address.state' => 'required',
        'address.country_id' => 'required',
    ];

    public function mount($address, $readonly, $showModal)
    {
        $this->address = $address
            ? $address
            : \App\Models\Address::make(['country_id' => '']);
        $this->readonly = $readonly;
        $this->showModal = $showModal;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        if ($this->address->getKey()) {
            $this->address->save();
            $this->emit('addressUpdated');
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->emitUp('addressModalClosed');
    }

    public function save()
    {
        $this->validate();
        $this->address->save();
    }

    public function render()
    {
        return view('livewire.form.address-modal');
    }
}
