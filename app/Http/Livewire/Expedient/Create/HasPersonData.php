<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Person;

trait HasPersonData
{
    public Person $person;

    public function validatePerson()
    {
        return [
            'person.legal_id' => '',
            'person.name' => 'required|min:3',
            'person.legal_name' => '',
        ];
    }

    public function initializePerson($person)
    {
        $this->person = $person
            ? Person::find($person)
            : Person::make();
    }

    public function updatedPersonLegalId($value)
    {
        $idTransformed = preg_replace('/[^a-zA-Z0-9]/', '', strtoupper($value));

        if ($person = $this->expedient->gabinete->checkLegalIdExists($idTransformed)) {
            $this->person = $person;
            $this->resetAddress();
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
}
