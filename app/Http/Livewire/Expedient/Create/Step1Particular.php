<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Expedient;
use App\Traits\HasContactData;
use Livewire\Component;

class Step1Particular extends Component
{
    use HasContactData, HasPersonData, HasAddressData, Validations;

    public Expedient $expedient;

    public function rules()
    {
        return array_merge(
            $this->validateExpedient(),
            $this->validatePerson(),
            $this->validateAddress(),
            $this->validateContact('contacts')
        );
    }

    public function validationAttributes()
    {
        return [
            'address.country_id' => __('country'),
            'contacts.*.type' => __('que indica el tipo'),
            'contacts.*.value' => __('que indica el dato'),
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        if (! $this->expedient->gabinete_id) {
            if (auth()->user()->myGabinetes()->count() > 1) {
                $this->expedient->gabinete_id = '';
            } else {
                $this->expedient->gabinete_id = auth()->user()->favoriteGabinete()->id;
            }
        }
        $this->initializePerson($this->expedient->billable_id);
        $this->initializeAddress($this->expedient->billable_address_id);
        $this->initializeContacts($this->expedient->billable);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedExpedientGabineteId()
    {
        $this->initializePerson($this->expedient->billable_id);
        $this->initializeAddress($this->expedient->billable_address_id);
        $this->initializeContacts($this->expedient->billable);
    }

    public function resetAll()
    {
        $this->initializePerson();
        $this->initializeAddress($this->expedient->billable_address_id);
        $this->initializeContacts($this->expedient->billable);
    }

    public function goToStep($step)
    {
        $this->validate();
        $this->person->save();
        $this->address->save();
        if ($this->person->contacts->count() != count($this->contacts)) {
            $this->person->contacts()->delete();
        }
        foreach ($this->contacts as $contact) {
            $this->person->contacts()->updateOrCreate($contact);
        }
        $expedientValues = [
            'billable_address_id' => $this->address->id,
            'reference' => $this->expedient->reference,
            'requested_at_for_editing' => $this->expedient->requested_at_for_editing,
            'gabinete_id' => $this->expedient->gabinete_id,
            'creator_id' => auth()->user()->id,
        ];
        if (! $this->expedient->code) {
            $expedientValues['code'] = $this->expedient->createCode($this->expedient->gabinete_id);
        }
        if (! $this->expedient->person_id) {
            $expedientValues['person_id'] = $this->person->id;
        }
        if (! $this->expedient->address_id) {
            $expedientValues['address_id'] = $this->address->id;
        }

        $expedient = $this->person->expedients()->updateOrCreate(['id' => $this->expedient->id], $expedientValues);

        $this->emit('expedientCreated', $expedient->id);
        $this->emit('createCaseGoToStep', $step);
    }

    public function render()
    {
        return view('livewire.expedient.create.step1-particular');
    }
}
