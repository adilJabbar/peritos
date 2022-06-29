<?php

namespace App\Http\Livewire\Expedient;

use App\Http\Livewire\Expedient\Create\HasAddressData;
use App\Http\Livewire\Expedient\Create\HasPersonData;
use App\Models\Address;
use App\Models\Expedient;
use App\Traits\HasContactData;
use App\Traits\WithExpedientAccessCheck;
use Livewire\Component;

class Affecteds extends Component
{
    use WithExpedientAccessCheck, HasPersonData, HasAddressData, HasContactData;

    public Expedient $expedient;

    public $showAffectedModal = false;

    public $affected = [];

    public function rules()
    {
        return array_merge(
            $this->validatePerson(),
            $this->validateAddress(),
//            $this->validateContact('contacts'),
            [
                'affected.type' => 'required',
                'affected.reclamation' => '',
                'affected.currency_id' => '',
            ]
        );
    }

    public function validationAttributes()
    {
        return array_merge(
            $this->validationAddressAttributes(),
            $this->validationContactAttributes('contacts'),
            [
                'affected.type' => __('tipo de afectado'),
            ]
        );
    }

    public function mount(Expedient $expedient)
    {
        $this->verifyAllowed();
        auth()->user()->can('expedient.update') && $this->readonly = false;
        $this->expedient = $expedient;
        $this->initializePerson(null);
        $this->initializeAddress(null);
        $this->initializeContacts($this->person);
        $this->affected = [
            'type' => '',
            'reclamation' => 0,
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function create()
    {
        $this->showAffectedModal = true;
    }

    public function resetAll()
    {
        $this->initializePerson(null);
        $this->initializeAddress(null);
        $this->initializeContacts($this->person);
        $this->affected = [
            'type' => '',
            'reclamation' => 0,
            'capital_id' => $this->expedient->address->country->capital_id,
        ];
    }

    public function save()
    {
        $this->validate();
        $this->expedient->affecteds()->attach($this->person, [
            'type' => $this->affected['type'],
            'amount' => $this->affected['reclamation'] ? $this->affected['reclamation'] : 0,
            'currency_id' => $this->expedient->address->country->currency_id,
            'address_id' => $this->address->id,
        ]);
        $this->resetAll();
        $this->expedient->load('affecteds');
        $this->showAffectedModal = false;
    }

    public function render()
    {
        return view('livewire.expedient.affecteds');
    }
}
