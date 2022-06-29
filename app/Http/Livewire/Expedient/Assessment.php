<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Address;
use App\Models\Admin\Destiny;
use App\Models\Expedient;
use App\Models\Insurance\Guarantee;
use App\Models\Insurance\Subguarantee;
use App\Models\Person;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use App\Traits\WithExpedientAccessCheck;
use Livewire\Component;

class Assessment extends Component
{
    use WithExpedientAccessCheck, WithSorting, WithBulkActions, WithPerPagePagination;

    public Expedient $expedient;

    public Expedient\Assessment $assessment;

    public Person $person;

    public $assessmentsPersonId;

    public Address $address;

    public bool $readonly = true;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $guarantee = '';

    protected $listeners = ['assessmentUpdated' => '$refresh'];

    protected $queryString = ['assessmentsPersonId'];

    public function rules()
    {
        return [
            'assessment.destiny_id' => 'required',
            'assessment.expedient_id' => '',
            'assessment.person_id' => 'required',
            'assessment.capital_id' => '',
            'assessment.currency_id' => 'required',
            'assessment.unit' => 'required',
            'assessment.description' => 'required|min:5',
            'assessment.deprecationgroup_id' => '',
            'assessment.unit_price' => 'required',
            'assessment.deprecation' => '',
            'assessment.origin' => '',
            'assessment.taxes' => '',
            'assessment.subguarantee_id' => 'required',
            'guarantee' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'assessment.destiny_id' => __('destino propuesto'),
            'assessment.person_id' => __('localización'),
            'assessment.capital_id' => __('capital'),
            'assessment.currency_id' => __('moneda'),
            'assessment.unit' => __('unidades'),
            'assessment.description' => __('descripción'),
            'assessment.deprecationgroup_id' => __('grupo de depreciación'),
            'assessment.unit_price' => __('precio unitario'),
            'assessment.deprecation' => __('depreciación'),
            'assessment.origin' => __('fuente u origen'),
            'assessment.subguarantee_id' => __('subgarantía'),
            'guarantee' => __('garantía'),
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->verifyAllowed();

        auth()->user()->can('expedient.update') && $this->readonly = false;
        $this->resetToBlankAssessment();
        $this->person = $this->assessmentsPersonId ? Person::find($this->assessmentsPersonId) : $this->expedient->person;
        $this->showDamages($this->person);
    }

    public function updated($field, $value)
    {
        $this->validateOnly($field);
        if ($field === 'assessment.deprecationgroup_id') {
            $this->assessment->deprecation = '';
        }
    }

    public function updatedGuarantee()
    {
//        dd('hola');
        $this->assessment->subguarantee_id = '';
    }

    public function create($person)
    {
//        if ($this->assessment->getKey()) {
        $this->resetToBlankAssessment();
        $this->assessment->person_id = $person;
//        }
        $this->showEditModal = true;
    }

    public function addOneForSubguarantee(Subguarantee $subguarantee, $person_id)
    {
        $this->guarantee = $subguarantee->guarantee_id;
        $this->assessment = $this->expedient->assessments()->make([
            'destiny_id' => '',
            'capital_id' => '',
            'currency_id' => $this->expedient->address->country->currency->id,
            'person_id' => $person_id,
            'subguarantee_id' => $subguarantee->id,
        ]);
        $this->showEditModal = true;
    }

    public function edit(Expedient\Assessment $assessment)
    {
        $this->assessment = $assessment;
        $this->guarantee = $assessment->subguarantee->guarantee_id;
        $this->showEditModal = true;
    }

    public function duplicate(Expedient\Assessment $assessment)
    {
        $this->guarantee = $assessment->subguarantee->guarantee_id;
        $this->assessment = $this->expedient->assessments()->make([
            'destiny_id' => $assessment->destiny_id,
            'capital_id' => $assessment->capital_id,
            'currency_id' => $assessment->currency_id,
            'person_id' => $assessment->person_id,
            'taxes' => $assessment->taxes,
            'subguarantee_id' => $assessment->subguarantee_id,
            'deprecationgroup_id' => $assessment->deprecationgroup_id,
        ]);
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->assessment->save();
        $this->showEditModal = false;
        $this->resetToBlankAssessment();
        $this->emit('assessmentUpdated');
    }

    public function resetToBlankAssessment()
    {
        $this->assessment = $this->expedient->assessments()->make([
            'destiny_id' => '',
            'person_id' => '',
            'capital_id' => '',
            'currency_id' => $this->expedient->address->country->currency->id,
            'subguarantee_id' => '',
        ]);
    }

    public function showDamages(Person $person)
    {
        if ($person == $this->expedient->person) {
            $this->person = $person;
            $this->address = $this->expedient->address;
        } else {
            $this->person = $this->expedient->affecteds->where('id', $person->id)->first();
            $this->address = Address::find($this->person->pivot->address_id);
        }
        $this->assessmentsPersonId = $this->person->id;
    }

    public function getRowsQueryProperty()
    {
        return Expedient\Assessment::query()
            ->where('person_id', $this->person->id)
            ->where('expedient_id', $this->expedient->id);
    }

    public function getRowsProperty()
    {
        $rowsQuery = $this->applySorting($this->rowsQuery);

        return $this->rowsQuery->get();
    }

    public function render()
    {
        return view('livewire.expedient.edit.assessment', [
            'assessments' => $this->rows,
            'destinies' => Destiny::all(),
            'affecteds' => $this->expedient->affecteds,
            'guarantees' => $this->expedient->guarantees(),
            'subguarantees' => Guarantee::find($this->guarantee)->subguarantees ?? [],
            'deprecationgroups' => $this->expedient->address->country->deprecationgroups ?? [],
        ]);
    }
}
