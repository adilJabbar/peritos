<?php

namespace App\Http\Livewire\Expedient;

use App\Http\Livewire\Expedient\Create\HasAddressData;
use App\Http\Livewire\Expedient\Create\HasPersonData;
use App\Http\Livewire\Expedient\Create\Validations;
use App\Models\Address;
use App\Models\Expedient;
use App\Models\Person;
use App\Traits\HasContactData;
use App\Traits\WithExpedientAccessCheck;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class InitialData extends Component
{
    use WithExpedientAccessCheck,
        WithFileUploads,
        WithFileDelete,
        HasPersonData,
        Validations,
        HasAddressData,
        HasContactData;

    public Expedient $expedient;

    public bool $readonly = true;

    public $attachments = [];

    protected $listeners = ['attachmentsUpdated' => '$refresh'];

    public function rules()
    {
        return array_merge(
            $this->validateExpedient(),
            $this->validatePerson(),
            $this->validateAddress(),
            $this->validateContact('contacts'),
            [
                'expedient.happened_at_for_editing' => 'required',
                'expedient.description' => 'required|min:5',
                'expedient.private_comments' => '',
                'expedient.ramo_id' => 'required',
                'typecases' => 'required',
                'estimation.estimation' => '',
            ]
        );
    }

    public function mount(Expedient $expedient)
    {
//        Check if there is person assigned to expedient
        if (! $this->expedient->person) {
            redirect()->route();
        }
        $this->expedient = $expedient;
        $this->person = $this->expedient->person;
        $this->initializeAddress($this->expedient->address_id);
        $this->initializeContacts($this->person);
        $this->verifyAllowed();

        auth()->user()->can('expedient.update') && $this->readonly = false;
    }

    public function updatedPerson()
    {
        $this->validate($this->validatePerson());
        $this->person->save();
    }

    public function updatedContacts()
    {
        $this->validate($this->validateContact('contacts'));
        $this->saveContacts($this->person);
    }

    public function updatedAttachments()
    {
        if ($this->attachments) {
//            dd($this->attachments);
            foreach ($this->attachments as $key => $attachment) {
                $this->expedient->attachments()->create([
                    'path' => $attachment->store('/', 'expedients'),
                    'name' => pathinfo($attachment->getClientOriginalName())['filename'],
                ]);
            }
            $this->expedient->load('attachments');
            $this->attachments = [];
        }
    }

    public function selectAddress($value)
    {
        $this->address = Address::find($value);
        $this->expedient->update(['address_id' => $value]);
    }

    public function render()
    {
        return view('livewire.expedient.edit.initial-data');
    }
}
