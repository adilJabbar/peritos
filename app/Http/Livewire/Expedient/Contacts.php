<?php

namespace App\Http\Livewire\Expedient;

use App\Http\Livewire\Expedient\Create\HasAddressData;
use App\Models\Contact;
use App\Models\ContactAttempt;
use App\Models\Expedient;
use App\Models\VisitAppointment;
use Livewire\Component;

class Contacts extends Component
{
    use HasAddressData;

    public Expedient $expedient;

    public ContactAttempt $contactAttempt;

    public VisitAppointment $appointment;

    public bool $createAppointment = false;

    public $showNewContact = false;

    public $otherType = null;

    public $contactOptions = [];

    public $newValue = '';

    public $technicians;

    protected $rules = [
        'contactAttempt.expedient_id' => 'required',
        'contactAttempt.user_id' => 'required',
        'contactAttempt.time_for_editing' => 'required',
        'contactAttempt.attempt_type' => 'required',
        'contactAttempt.attempt_value' => 'required',
        'contactAttempt.response' => '',
        'contactAttempt.comments' => '',
        'newValue' => '',
        'createAppointment' => 'required|boolean',
        'appointment.date_time_for_editing' => 'exclude_if:createAppointment,false|required|date_format:Y-m-d\TH:i',
        'appointment.technician_id' => 'exclude_if:createAppointment,false|required|exists:users,id',
        'appointment.comments' => '',
        'appointment.address' => 'exclude_if:createAppointment,false|required|min:5',
        'appointment.city' => 'exclude_if:createAppointment,false|required|min:3',
        'appointment.zip' => '',
        'appointment.state' => 'exclude_if:createAppointment,false|required',
        'appointment.country_id' => 'exclude_if:createAppointment,false|required',
        'appointment.kms' => 'exclude_if:createAppointment,false|sometimes|integer',
    ];

    public function mount($expedient)
    {
        $this->expedient = $expedient;
        $this->resetContactAndAppointment();
//        $this->expedient->technicians();
    }

    public function updatedContactAttemptAttemptType($value)
    {
        $this->contactAttempt->attempt_value = '';
        $this->contactOptions = [];
        if ($value === 'phone' || $value === 'email') {
            foreach ($this->expedient->person->contacts->where('type', $value) as $contact) {
                $this->contactOptions[$contact->id] = [
                    'value' => $contact->value,
                    'description' => (class_basename($this->expedient->billable) === 'Company' ? __('Asegurado') : __('Solicitante')).': '.$contact->value.' ('.($contact->contactable->name ?? '').')', ];
            }
            foreach ($this->expedient->affecteds as $affected) {
                foreach ($affected->contacts->where('type', $value) as $contact) {
                    $this->contactOptions[$contact->id] = [
                        'value' => $contact->value,
                        'description' => ucfirst(__($affected->pivot->type)).': '.$contact->value.' ('.($affected->name ?? '').')', ];
                }
            }
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function createContactAttempt()
    {
        $this->validate();
        $this->contactAttempt->save();

        if ($this->createAppointment) {
            $this->appointment->expedient_id = $this->contactAttempt->expedient_id;
            $this->appointment->user_id = $this->contactAttempt->user_id;
            $this->appointment->contact_attempt_id = $this->contactAttempt->id;
            $this->appointment->save();
        }

        $this->showNewContact = false;
        $this->resetContactAndAppointment();
        $this->expedient->load('contactAttempts');
    }

    public function resetContactAndAppointment()
    {
        $this->contactAttempt = $this->expedient->contactAttempts()->make(['attempt_type' => '', 'user_id' => auth()->user()->id]);
        $this->appointment = $this->expedient->visits()->make([
            'technician_id' => '',
            'address' => $this->expedient->address->address,
            'city' => $this->expedient->address->city,
            'zip' => $this->expedient->address->zip,
            'state' => $this->expedient->address->state,
            'country_id' => $this->expedient->address->country_id,
        ]);
    }

    public function render()
    {
        return view('livewire.expedient.contacts');
    }
}
