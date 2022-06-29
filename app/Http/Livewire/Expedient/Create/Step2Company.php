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

class Step2Company extends Component
{
    use WithFileUploads,
        WithFileDelete,
        HasPersonData,
        Validations,
        HasAddressData,
        HasContactData;

    public Expedient $expedient;

    public Estimation $estimation;

    public $typecases = [];

    public Ramo $ramo;

    public $attachments = [];

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

    public function validationAttributes()
    {
        return array_merge(
            $this->validationAddressAttributes(),
            [
                'expedient.happened_at_for_editing' => __('fecha de ocurrencia'),
                'expedient.ramo_id' => __('ramo'),
                'typecases' => __('tipo de siniestro'),
                'contacts.*.type' => __('que indica el tipo'),
                'contacts.*.value' => __('que indica el dato'),
            ]);
    }

    public function mount()
    {
        $this->person = $this->expedient->policy->person
            ? Person::find($this->expedient->policy->person_id)
            : Person::make();
        $this->initializeAddress($this->expedient->address_id);
        $this->initializeContacts($this->person);
        $this->estimation = $this->expedient->first_estimation()
            ? $this->expedient->first_estimation()
            : $this->expedient->estimations()->create(['origin' => 'initial', 'currency_id' => ($this->expedient->address->country->currency_id ?? 1)]);
        $this->expedient->ramo_id == null && $this->expedient->ramo_id = '';
        $this->ramo = $this->expedient->ramo_id
            ? $this->expedient->ramo
            : Ramo::make();
        $this->typecases = $this->expedient->typecases->pluck('id');
    }

    public function goToStep($step)
    {
//        dd($this->typecases);
        $this->validate();
        $this->person->save();
        $this->address->save();

        $this->saveContacts($this->person);

        ! $this->expedient->policy->person_id && $this->expedient->policy->update(['person_id' => $this->person->id]);

        $this->expedient->person_id = $this->person->id;
        $this->expedient->address_id = $this->address->id;
        $this->expedient->save();
        $this->estimation->save();
        $this->expedient->typecases()->sync($this->typecases);

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
        return view('livewire.expedient.create.step2-company');
    }
}
