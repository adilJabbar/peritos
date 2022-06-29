<?php

namespace App\Http\Livewire\Expedient\NewExpedient;

use App\Models\Address;
use App\Models\Admin\Country;
use App\Models\Admin\Ramo;
use App\Models\Expedient;
use App\Models\Person;
use App\Traits\HasContactData;
use Livewire\Component;

class CaseData extends Component
{
    use HasContactData;

    public Expedient $expedient;

    public bool $sameContact;

    public bool $sameAddress;

    public Person $contactPerson;

    public Address $address;

    public $ramos;

    public $estimation;

    public $addressSelector = '';

    public $ramoTypecases;

    public $typecases = [];

    public function rules()
    {
        return array_merge(
            $this->validateContact('contacts'),
            [
                'expedient.happened_at_for_editing' => 'required|date|before:tomorrow',
                'expedient.description' => 'required|min:10',
                'expedient.ramo_id' => 'required',
                'contactPerson.name' => 'required',
                'contactPerson.legal_name' => '',
                'contactPerson.legal_id' => '',
                'address.country_id' => 'required',
                'address.address' => 'required',
                'address.city' => 'required',
                'address.zip' => '',
                'address.state' => 'required',
                'estimation.estimation' => '',
                'typecases' => 'array|min:1',
            ]
        );
    }

    public function getValidationAttributes()
    {
        return array_merge(
            $this->validationContactAttributes('contacts'),
            [
                'happened_at_for_editing' => __('fecha de ocurrencia'),
                'country_id' => __('pais'),
                'state' => __('provincia'),
                'typecases' => __('tipos de siniestro'),

            ]
        );
    }

    public function messages()
    {
        return [
            'expedient.happened_at_for_editing.before' => __('La fecha de ocurrencia no puede ser posterior a hoy'),
        ];
    }

    public function mount($expedient)
    {
        $this->expedient = $expedient;
        $this->expedient->ramo_id === null ? $this->expedient->ramo_id = '' : '';
        $this->estimation = $this->expedient->first_estimation()
            ? $this->expedient->first_estimation()
            : $this->expedient->estimations()->create(['origin' => 'initial', 'currency_id' => ($this->expedient->address->country->currency_id ?? 1)]);

        if ($this->expedient->person) {
            $this->contactPerson = $this->expedient->person;
        } else {
            if (class_basename($this->expedient->billable) === 'Person') {
                $this->contactPerson = ($this->expedient->billable);
            } else {
                $this->resetContactPerson();
            }
        }
        $this->sameContact = ($this->contactPerson->id == $this->expedient->billable_id && class_basename($this->expedient->billable) && class_basename($this->expedient->billable) === 'Person');
        $this->initializeContacts($this->contactPerson);

        if ($this->expedient->address) {
            $this->address = $this->expedient->address;
        } else {
            if (class_basename($this->expedient->billable) === 'Person') {
                $this->address = Address::find($this->expedient->billable_address_id);
            } else {
                $this->resetAddress();
            }
        }
        $this->sameAddress = $this->address->id === $this->expedient->billable_address_id && class_basename($this->expedient->billable) === 'Person';

        $this->ramos = class_basename($this->expedient->billable) === 'Company'
            ? $this->expedient->billable->ramos
            : $this->address->country->ramos;

        $this->ramoTypecases = optional(Ramo::find($this->expedient->ramo_id))->typecases;
        $this->typecases = $this->expedient->typecases->pluck('id');
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedAddressCountryId($value)
    {
        $this->resetAddress($value);
        if (class_basename($this->expedient->billable !== 'Company')) {
            $this->resetRamo($value);
        }
    }

    public function updatedAddressSelector()
    {
        if ($this->addressSelector === 'new') {
            $this->resetAddress();
        } else {
            $this->address = Address::find($this->addressSelector);
            $this->resetRamo($this->address->country_id);
//            if(class_basename($this->expedient->billable) !== 'Company') $this->resetRamo($this->address->country_id);
        }
        $this->addressSelector = '';
    }

    public function updatedContactPersonLegalId($value)
    {
        if ($value) {
            $idTransformed = preg_replace('/[^a-zA-Z0-9]/', '', strtoupper($value));

            if ($person = $this->expedient->gabinete->checkLegalIdExists($idTransformed)) {
                $this->contactPerson = $person;
                $this->contacts = [];
                foreach ($this->contactPerson->contacts as $contact) {
                    array_push($this->contacts, [
                        'id' => $contact->id,
                        'type' => $contact->type,
                        'value' => $contact->value,
                    ]);
                }
            }
        }
    }

    public function updatedExpedientRamoId()
    {
        $this->ramoTypecases = Ramo::find($this->expedient->ramo_id)->typecases;
        $this->typecases = [];
    }

    public function updatedSameAddress()
    {
        if ($this->sameAddress) {
            $this->address = Address::find($this->expedient->billable_address_id);
        } else {
            $this->resetAddress();
        }
    }

    public function updatedSameContact()
    {
        if ($this->sameContact) {
            $this->contactPerson = $this->expedient->billable;
            $this->initializeContacts($this->contactPerson);
            $this->validateOnly('contactPerson.*');
        } else {
            $this->resetContactPerson();
            $this->initializeContacts($this->contactPerson);
        }
    }

    public function resetAddress($country_id = '')
    {
        $this->address = Address::make(['country_id' => $country_id, 'state'=> '']);
    }

    public function resetContactPerson()
    {
        $this->contactPerson = Person::make();
        $this->initializeContacts($this->contactPerson);
    }

    public function resetRamo($country)
    {
        $this->ramos = class_basename($this->expedient->billable) === 'Company'
            ? $this->expedient->billable->ramos
            : Country::find($country)->ramos;
//        $this->ramos = Country::find($country)->ramos;
        $this->expedient->ramo_id = '';
        $this->typecases = [];
    }

    public function saveAndGoTo($menu)
    {
//        dd($this->contactPerson);
        $this->validate();
        if (! $this->sameContact) {
            $this->contactPerson->save();
            $this->saveContacts($this->contactPerson);
        }
        if (! $this->sameAddress || ! $this->sameContact) {
            if (in_array($this->address->id, $this->contactPerson->addresses->pluck('id')->toArray())) {
                $this->address->save();
            } else {
                $this->address = $this->contactPerson->addresses()->create($this->address->attributesToArray());
            }
        }
        $this->expedient->person_id = $this->contactPerson->id;
        $this->expedient->address_id = $this->address->id;
        $this->expedient->save();
        $this->expedient->typecases()->sync($this->typecases);
        $this->estimation->save();
        $this->notify(__('Guardado'), __('Los datos del siniestro se han actualizado'));
        $this->emit('expedientUpdated', $menu);
//            dd($this->address);
    }

    public function render()
    {
        return view('livewire.expedient.new-expedient.case-data');
    }
}
