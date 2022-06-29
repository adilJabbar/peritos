<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Expedient;
use App\Models\Person;
use App\Traits\HasContactData;
use Livewire\Component;

class Step3 extends Component
{
    use HasContactData, HasPersonData, HasAddressData;

    public Expedient $expedient;

    public $affected = [];

    public function rules()
    {
        return array_merge(
            $this->validatePerson(),
            $this->validateAddress(),
            [
                'affected.type' => 'required',
                'affected.reclamation' => '',
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
            'reclamation' => 0,
            'capital_id' => $this->expedient->address->country->capital_id,
        ];
        $this->initializePerson(null);
        $this->initializeAddress(null);
        $this->initializeContacts($this->person);
    }

    public function newAddress()
    {
        $this->validate(array_merge(
            $this->validatePerson(),
            [
                'affected.type' => 'required',
                'affected.reclamation' => '',
            ])
        );
        $this->person->save();
        $this->address = $this->person->addresses()->make([
            'country_id' => $this->expedient->address->country_id,
            'city' => $this->expedient->address->city,
            'state' => $this->expedient->address->state,
            'zip' => $this->expedient->address->zip,
        ]);
        $this->showAddressModal = true;
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

    public function addAffected()
    {
        $this->validate();
        $this->expedient->affecteds()->attach($this->person, [
            'type' => $this->affected['type'],
            'amount' => $this->affected['reclamation'],
            'currency_id' => $this->expedient->address->country->currency_id,
            'address_id' => $this->address->id,
        ]);
        $this->resetAll();
        $this->expedient->load('affecteds');
    }

    public function editAffected($affected_id)
    {
        $affected = $this->expedient->affecteds->where('id', $affected_id)->first();
        $this->affected = [
            'type' => $affected->pivot->type,
            'reclamation' => $affected->pivot->amount,
            'currency_id' => $affected->pivot->currency_id,
        ];
        $this->initializePerson($affected_id);
        $this->initializeAddress($affected->pivot->address_id);
        $this->initializeContacts($this->person);
        $this->expedient->affecteds()->detach($this->person);
        $this->expedient->load('affecteds');
    }

    public function removeAffected($affected_id)
    {
        $this->expedient->affecteds()->detach($affected_id);
        $this->expedient->load('affecteds');
    }

    public function goToStep($step)
    {
//        $this->validate();

        $this->emit('expedientUpdated', $this->expedient->id);
        $this->emit('createCaseGoToStep', $step);
    }

    public function finish()
    {
        $this->notify(__('Creado'), __('Se ha creado el expediente'));

        return redirect(route('expedient.index'));
    }

    public function render()
    {
        return view('livewire.expedient.create.step3');
    }
}
