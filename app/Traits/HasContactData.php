<?php

namespace App\Traits;

use App\Models\Contact;
use Carbon\Carbon;

trait HasContactData
{
    public $contacts = [];

    public function initializeContacts($person)
    {
        $this->contacts = $person && $person->contacts?->count() > 0
            ? $person->contacts->toArray()
            : [Contact::make(['type' => '', 'value' => ''])];
    }

    public function addContactOption($array)
    {
        $this->validate($this->validateContact($array));
        array_push($this->$array, Contact::make(['type' => '', 'value' => '']));
    }

    public function removeContactOption($array, $index)
    {
        unset($this->$array[$index]);
        $this->$array = array_values($this->$array);
    }

    public function validateContact($array_name)
    {
        return[
            $array_name.'.*.type' => 'required|in:phone,email',
            $array_name.'.*.value' => 'required|min:6',
        ];
    }

    public function validationContactAttributes($array_name)
    {
        return [
            $array_name.'.*.type' => __('tipo de contacto'),
            $array_name.'.*.value' => __('valor de contacto'),
        ];
    }

    public function saveContacts($person)
    {
        $validContacts = [];
        foreach ($this->contacts as $contact) {
//        dd($contact);
            $updatedContact = $person->contacts()->updateOrCreate(['id' => $contact['id'] ?? null], $contact);
            array_push($validContacts, $updatedContact->id);
        }
        $person->contacts()->whereNotIn('id', $validContacts)->delete();
    }
}
