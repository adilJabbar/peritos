<?php

namespace App\Http\Livewire\Expedient\Create;

use App\Models\Admin\Ramo;
use App\Models\Estimation;
use App\Models\Expedient;
use App\Models\Person;
use App\Traits\HasContactData;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Step2Particular extends Component
{
    use HasContactData,
        HasPersonData,
        HasAddressData,
        Validations,
        HasPolicyData,
        WithFileUploads,
        WithFileDelete;

    public Expedient $expedient;

    public Estimation $estimation;

    public $typecases = [];

    public Ramo $ramo;

    public $condParticular;

    public $attachments = [];

    public $contactPersonIsBillablePerson = false;

    protected $listeners = ['attachmentsUpdated'];

    public function rules()
    {
        return array_merge(
            $this->validateExpedient(),
            $this->validatePerson(),
            $this->validateAddress(),
            $this->validatePolicy(),
            $this->validateContact('contacts'),
            [
                'contactPersonIsBillablePerson' => 'boolean',
                'expedient.happened_at_for_editing' => 'required',
                'expedient.description' => 'required|min:5',
                'expedient.private_comments' => '',
                'expedient.ramo_id' => 'required',
                'typecases' => 'required',
                'estimation.estimation' => '',
            ]
        );
    }

    public function validationAttributes()
    {
        return [
            'address.country_id' => __('country'),
            'expedient.happened_at_for_editing' => __('fecha de ocurrencia'),
            'expedient.ramo_id' => __('ramo'),
            'typecases' => __('tipo de siniestro'),
            'contacts.*.type' => __('que indica el tipo'),
            'contacts.*.value' => __('que indica el dato'),
            'condParticular' => __('condiciones particulares'),
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;

        $this->initializePerson($this->expedient->person_id);
//        $this->person = $this->expedient->person_id
//            ? Person::find($this->expedient->person_id)
//            : Person::make();
        $this->expedient->person_id === $this->expedient->billable_id && $this->contactPersonIsBillablePerson = true;
        $this->initializeContacts($this->person);
        $this->initializeAddress($this->expedient->address_id);
        $this->estimation = $this->expedient->first_estimation()
            ? $this->expedient->first_estimation()
            : $this->expedient->estimations()->create(['origin' => 'initial', 'currency_id' => $this->expedient->address->country->currency_id]);
        $this->expedient->ramo_id == null && $this->expedient->ramo_id = '';
        $this->ramo = $this->expedient->ramo_id
            ? $this->expedient->ramo
            : Ramo::make();
        $this->typecases = $this->expedient->typecases->pluck('id');
        $this->initializePolicy($this->expedient->policy);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $field === 'condParticular' && $this->validate(['condParticular' => 'sometimes|mimes:pdf']);
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

    public function updatedcontactPersonIsBillablePerson($value)
    {
        $this->person = $value
            ? $this->expedient->billable
            : Person::make();
        $this->initializeAddress(null);
        $this->initializeContacts($this->person);
//        dd($this->contacts);
    }

    public function updatedExpedientRamoId($value)
    {
        $this->ramo = Ramo::find($value);
        $this->reset('typecases');
    }

    public function resetAll()
    {
        $this->initializePerson(null);
        $this->initializeAddress(null);
        $this->initializeContacts($this->person);
    }

    public function attachmentsUpdated()
    {
        $this->expedient->load('attachments');
    }

    public function goToStep($step)
    {
        $this->validate();
        $this->condParticular && $this->validate(['condParticular' => 'file|mimes:pdf']);
        $this->person->save();
        $this->address->save();

        $this->saveContacts($this->person);

        $this->expedient->person_id = $this->person->id;
        $this->expedient->address_id = $this->address->id;
        $this->expedient->save();
        $this->estimation->save();
        $this->expedient->typecases()->sync($this->typecases);

        if ($this->policy->name_cia || $this->policy->reference) {
            $this->validate([
                'policy.name_cia' => 'required',
                'policy.reference' => 'required',
            ]);
            $this->policy->person_id = $this->expedient->billable_id;
            $this->policy->company_id = null;
            $this->policy->product_id = null;
            $this->policy->save();
            $this->expedient->update(['policy_id' => $this->policy->id]);
            $this->condParticular
                && $this->deleteFile('policies', $this->policy->cond_particular)
                && $this->policy->update([
                    'cond_particular' => $this->condParticular->store('/', 'policies'),
                ]);
        }

        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $this->expedient->attachments()->create([
                    'path' => $attachment->store('/', 'expedients'),
                    'name' => pathinfo($attachment->getClientOriginalName())['filename'],
                ]);
            }
        }

        $this->emit('expedientUpdated', $this->expedient->id);
        $this->emit('createCaseGoToStep', $step);
    }

    public function render()
    {
        return view('livewire.expedient.create.step2-particular');
    }
}
