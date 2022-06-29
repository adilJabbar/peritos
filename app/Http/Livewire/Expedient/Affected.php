<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Address;
use App\Models\Expedient;
use App\Models\Person;
use Livewire\Component;

class Affected extends Component
{
    public Expedient $expedient;

    public Person $affected;

    public Address $address;

    public $totalValue;

    protected $rules = [
        'affected.pivot.expedient_id' => '',
        'affected.pivot.person_id' => '',
        'affected.pivot.type' => '',
        'affected.pivot.address_id' => '',
        'affected.pivot.currency_id' => '',
        'affected.pivot.amount' => '',
    ];

    public function mount($affected)
    {
        $this->affected = $affected;
        $this->address = Address::find($this->affected->pivot->address_id);
        $this->totalValue = $this->affected->pivot->type == 'causante'
            ? $this->expedient->totalProposedCovered()
            : $this->expedient->totalProposedByPerson($this->affected->id);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->expedient->affecteds()->updateExistingPivot($this->affected->id, [
            'type' => $this->affected->pivot['type'],
            'amount' => $this->affected->pivot['amount'],
        ]);
    }

    public function render()
    {
        return view('livewire.expedient.affected');
    }
}
