<?php

namespace App\Http\Livewire\Expedient\NewExpedient;

use App\Http\Livewire\Expedient\Create\HasAddressData;
use App\Http\Livewire\Expedient\Create\HasPersonData;
use App\Http\Livewire\Expedient\Create\Validations;
use App\Models\Address;
use App\Models\Admin\Status;
use App\Models\Expedient;
use App\Models\Gabinete;
use App\Models\Insurance\Company;
use App\Models\Person;
use App\Traits\HasContactData;
use Livewire\Component;

class Requester extends Component
{
    use HasContactData, HasPersonData, HasAddressData, Validations;

    public Expedient $expedient;

    public $gabineteId;

    public $requesterType;

    public $requester;

    protected $listeners = ['changeRequesterTypeTo', 'showRequesterForm'];

    public function rules()
    {
        return array_merge(
            [
                'requesterType' => 'required',
                'expedient.area_id' => 'sometimes|required',
                'expedient.creator_id' => 'required',
                'expedient.code' => '',
                'expedient.gabinete_id' => 'required',
                'expedient.agent_id' => '',
                'expedient.billable_address_id' => '',
                'expedient.reference' => '',
                'expedient.requested_at_for_editing' => 'required',
                'expedient.requires_policy' => 'bool',
                'requester.id' => 'required',
                'requester.legal_id' => 'required',
                'requester.name' => '',
                'requester.legal_name' => '',
            ],
            $this->validateAddress()
        );
    }

    public function getValidationAttributes()
    {
        return [
            'reference' => __('referencia'),
            'requires_policy' => __('incluir datos'),
        ];
    }

    public function mount($expedient)
    {
        $this->expedient = $expedient;
        if (! $expedient->getKey()) {
            $this->resetExpedient();
            $this->requesterType = '';
            $this->resetRequester();
        } else {
            $this->requesterType = class_basename($this->expedient->billable);
            $this->requester = $this->expedient->billable;
            $this->initializeAddress($this->expedient->billable_address_id);
            $this->initializeContacts($this->requester);
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedExpedientGabineteId($value)
    {
        $this->validateOnly('expedient.gabinete_id');
        $this->requesterType = '';
        $this->resetRequester();
//        $this->expedient->gabinete = Gabinete::find($value);
    }

    public function updatedRequester()
    {
        if ($this->requesterType === 'Company') {
            $this->requester = Company::find($this->requester['id']);
            $this->expedient->agent_id = '';
            $this->expedient->area_id = '';
        }
    }

    public function updatedRequesterLegalId($value)
    {
        $idTransformed = preg_replace('/[^a-zA-Z0-9]/', '', strtoupper($value));

        if ($person = $this->expedient->gabinete->checkLegalIdExists($idTransformed)) {
            $this->requester = $person;
            $this->resetAddress($this->requester);
            $this->contacts = [];
            foreach ($this->requester->contacts as $contact) {
                array_push($this->contacts, [
                    'id' => $contact->id,
                    'type' => $contact->type,
                    'value' => $contact->value,
                ]);
            }
        }
    }

    public function updatedRequesterType()
    {
        $this->validateOnly('requesterType');
        $this->resetExpedient();
        $this->resetRequester();
    }

    public function changeRequesterTypeTo($value)
    {
        $this->requesterType = $value;
    }

    public function createCompanyExpedient()
    {
        $companyExpedientValidation = [
            'expedient.creator_id' => 'required',
            'expedient.code' => '',
            'expedient.gabinete_id' => 'required',
            'expedient.agent_id' => '',
            'expedient.billable_address_id' => '',
            'expedient.reference' => 'required',
            'expedient.requested_at_for_editing' => 'required',
            'requester.id' => 'required',
        ];

        if ($this->requester->areas->count() > 0) {
            $this->validate(array_merge($companyExpedientValidation, ['expedient.area_id' => 'required|exists:areas,id']));
        } else {
            $this->validate($companyExpedientValidation);
            $this->expedient->area_id = null;
        }
        if ($subscription = getGebineteStripeSubscriptionId($this->expedient->gabinete_id)) {
            if (updateUsageRecord($subscription)) {
                $this->expedient->code = $this->expedient->createCode($this->expedient->gabinete_id);
                $this->expedient = $this->requester->expedients()->create($this->expedient->attributesToArray());
                $this->notify(__('Guardado'), __('Se ha creado el nuevo expediente de :company', ['company' => $this->expedient->billable->name]));
                $this->emit('expedientCreated', $this->expedient->id);
            }
        }
        $this->notify(__('Error'), __('gabinate don\'t have subscribe. please subscribe and try again'), 'error');
    }

    public function createPersonExpedient()
    {
        $this->validate([
            'requester.id' => 'required',
            'requester.legal_id' => '',
            'requester.name' => '',
            'requester.legal_name' => '',
            'expedient.requires_policy' => 'required|bool',
        ]);
        $this->requester->save();
        $this->saveContacts($this->requester);
        $this->expedient->agent_id = null;
        $this->expedient->billable_address_id = $this->address->id;
        $this->expedient->code = $this->expedient->createCode($this->expedient->gabinete_id);
        $this->expedient = $this->requester->expedients()->create($this->expedient->attributesToArray());
        $this->emit('expedientCreated', $this->expedient->id);
    }

    public function newAddress()
    {
        $this->validate([
            'requester.legal_id' => 'required',
            'requester.name' => '',
            'requester.legal_name' => '',
        ]);
        $this->requester->save();
        $this->initializeContacts($this->requester);
        $this->resetAddress($this->requester);
        $this->showAddressModal = true;
    }

    public function resetExpedient()
    {
        $this->expedient->reference = null;
        if (auth()->user()->gabinetes->count() === 1) {
            $this->expedient->gabinete_id = auth()->user()->gabinetes->first()->id;
        }
        $this->expedient->gabinete_id = $this->expedient->gabinete_id !== null ? $this->expedient->gabinete_id : '';
        $this->expedient->agent_id = '';
        $this->expedient->area_id = '';
        $this->expedient->status_id = Status::where('name', 'Finalizar Alta')->first()->id ?? 1;
    }

    public function resetRequester()
    {
        if ($this->requesterType && $this->requesterType === 'Person') {
            $this->requester = Person::make();
            $this->expedient->requires_policy = '';
        } else {
            $this->requester = [];
            $this->requester['id'] = '';
            $this->expedient->requires_policy = 1;
        }
        $this->expedient->agent_id = '';
    }

    public function saveAddress()
    {
        $this->validate($this->validateAddress());
        $this->address->save();
        $this->showAddressModal = false;
        $this->requester->load('addresses');
    }

    public function selectAddress($value)
    {
        $this->address = Address::find($value);
        $this->expedient->billable_address_id = $this->address->id;
    }

    public function showRequesterForm()
    {
    }

    public function updateCompanyExpedient()
    {
//        dd($this->expedient->billable);
        $this->validate([
            'expedient.creator_id' => 'required',
            'expedient.code' => '',
            'expedient.gabinete_id' => 'required',
            'expedient.agent_id' => '',
            'expedient.billable_address_id' => '',
            'expedient.reference' => 'required',
            'expedient.requested_at_for_editing' => 'required',
            'requester.id' => 'required',
        ]);
        $this->expedient->billable_id = $this->requester->id;
        $this->expedient->save();
        $this->emit('expedientUpdated', 'CaseData');
        $this->notify(__('Guardado'), __('Los datos del solicitante se han actualizado'));
    }

    public function updatePersonExpedient()
    {
        $this->validate([
            'requester.id' => 'required',
            'requester.legal_id' => '',
            'requester.name' => '',
            'requester.legal_name' => '',
            'expedient.requires_policy' => 'required|bool',
        ]);
        $this->requester->save();
        $this->expedient->save();
        $this->saveContacts($this->requester);
        $this->emit('expedientUpdated', 'CaseData');
        $this->notify(__('Guardado'), __('Los datos del solicitante se han actualizado'));
    }

    public function render()
    {
        return view('livewire.expedient.new-expedient.requester');
    }
}
