<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Address;

trait HasAddressData
{
    public Address $address;

    public $showAddressModal = false;

    public function validateAddress()
    {
        return [
            'address.addressable_type' => '',
            'address.addressable_id' => '',
            'address.name' => '',
            'address.address' => 'required|min:5',
            'address.city' => 'required|min:3',
            'address.zip' => '',
            'address.state' => 'required',
            'address.country_id' => 'required',
        ];
    }

    public function validationAddressAttributes()
    {
        return [
            'address.country_id' => __('country'),
            'address.state' => __('provincia'),
        ];
    }

    public function updatedAddressCountryId($value)
    {
        $this->address->load('country');
        $this->address->country->load('states');
        $this->address->state = '';
    }

    public function initializeAddress($addressId = null)
    {
        $this->address = $addressId
            ? Address::find($addressId)
            : Address::make(['country_id' => '', 'state' => '']);
    }

    public function resetAddress($model)
    {
        $this->address = $model->addresses()->make(['country_id' => '', 'state' => '']);
    }

    public function selectAddress($value)
    {
        $this->address = Address::find($value);
    }

    public function newAddress()
    {
        $this->validate($this->validatePerson());
        $this->person->save();
        $this->resetAddress();
        $this->showAddressModal = true;
    }

    public function editAddress($value)
    {
        $this->selectAddress($value);
        $this->showAddressModal = true;
    }

    public function saveAddress($model)
    {
        $this->validate($this->validateAddress());
        $this->address->save();
        $this->showAddressModal = false;
        $model->load('addresses');
    }
}
