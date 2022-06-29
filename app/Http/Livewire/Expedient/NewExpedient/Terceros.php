<?php

namespace App\Http\Livewire\Expedient\NewExpedient;

use App\Http\Livewire\Expedient\Create\HasAddressData;
use App\Http\Livewire\Expedient\Create\HasPersonData;
use App\Models\Address;
use App\Models\Expedient;
use App\Models\Person;
use App\Traits\HasContactData;
use Livewire\Component;

class Terceros extends Component
{
    use HasContactData, HasPersonData, HasAddressData;

    public Expedient $expedient;

    public $affected = [];

    public Person $person;

    public $addressSelector = '';

    public Address $address;

    public function rules()
    {
        return array_merge(
            $this->validatePerson(),
            $this->validateAddress(),
            [
                'affected.type' => 'required',
                'affected.amount' => '',
                'affected.currency_id' => '',
            ]);
    }

    public function validationAttributes()
    {
        return [
            'affected.type' => __('tipo de afectado'),
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->affected = [
            'type' => '',
            'amount' => 0,
            'currency_id' => $this->expedient->address->country->currency_id,
        ];
        $this->initializePerson(null);
        $this->resetAddress();
//        $this->initializeAddress(null);
        $this->initializeContacts($this->person);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedAddressSelector()
    {
        if ($this->addressSelector === 'new') {
            $this->resetAddress();
        } else {
            $this->address = Address::find($this->addressSelector);
//            if(class_basename($this->expedient->billable) !== 'Company') $this->resetRamo($this->address->country_id);
        }
        $this->addressSelector = '';
    }

    public function updatedPersonLegalId($value)
    {
        $idTransformed = preg_replace('/[^a-zA-Z0-9]/', '', strtoupper($value));

        if ($person = $this->expedient->gabinete->checkLegalIdExists($idTransformed)) {
            $this->person = $person;
            $this->contacts = [];
            foreach ($this->person->contacts as $contact) {
                array_push($this->contacts, [
                    'id' => $contact->id,
                    'type' => $contact->type,
                    'value' => $contact->value,
                ]);
            }
        }
    }

    public function createAffected()
    {
        $this->validate();
        $this->person->save();
        if (! $this->address->getKey()) {
            $this->address->addressable()->associate($this->person);
        }
        $this->address->save();
        $this->saveContacts($this->person);
        $this->expedient->affecteds()->attach($this->person, [
            'type' => $this->affected['type'],
            'amount' => $this->affected['amount'] ?? null,
            'currency_id' => $this->expedient->address->country->currency_id,
            'address_id' => $this->address->id,
            'notes' => $this->affected['notes'] ?? null,
            'company' => $this->affected['company'] ?? null,
            'policy' => $this->affected['policy'] ?? null,
            'case' => $this->affected['case'] ?? null,
        ]);
        $this->resetAll();
        $this->expedient->load('affecteds');
    }

    public function resetAddress()
    {
//        dd($this->expedient->address);
        $this->address = Address::make([
            'country_id' => $this->expedient->address->country_id,
            'city'=> $this->expedient->address->city,
            'state'=> $this->expedient->address->state,
            'zip'=> $this->expedient->address->zip,
        ]);
    }

    public function resetAll()
    {
        $this->initializePerson(null);
        $this->resetAddress();
        $this->initializeContacts($this->person);
        $this->affected = [
            'type' => '',
            'amount' => 0,
            'currency_id' => $this->expedient->address->country->currency_id,
            'notes' => '',
            'company' => '',
            'policy' => '',
            'case' => '',
        ];
    }

    public function saveAndGoTo($menu)
    {
        $this->emit('expedientUpdated', $menu);
    }

    public function render()
    {
        return view('livewire.expedient.new-expedient.terceros');
    }
}
