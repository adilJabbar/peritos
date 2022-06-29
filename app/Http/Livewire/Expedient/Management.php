<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use App\Models\User;
use App\Traits\WithExpedientAccessCheck;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Management extends Component
{
    use WithExpedientAccessCheck;

    public Expedient $expedient;

    public $showDeleteModal = false;

    public $typecases;

    public bool $readonly = true;

    public $addCollaborator;

    protected $listeners = ['refreshManagement' => '$refresh'];

    protected $rules = [
        'expedient.ramo_id' => '',
        'expedient.requires_policy' => 'boolean',
        'expedient.adjuster_id' => 'required',
        'typecases' => '',
        'addCollaborator' => '',
    ];

    public function getValidationAttributes()
    {
        return [
            'adjuster_id' => __('asignado a...'),
        ];
    }

    public function mount(Expedient $expedient)
    {
        $this->verifyAllowed();
        auth()->user()->can('expedient.update') && $this->readonly = false;

        $this->expedient = $expedient;
        $this->typecases = $this->expedient->typecases->pluck('id');
        ! $this->expedient->adjuster_id && $this->expedient->adjuster_id = '';
        $this->addCollaborator = '';
    }

    public function updated($field)
    {
        if ($field === 'expedient.ramo_id') {
            if ($this->expedient->policy && $this->expedient->policy->product_id) {
                $this->showDeleteModal = true;
            }
        }
    }

    public function updatedAddCollaborator($value)
    {
        $this->expedient->collaborators()->attach($value);
        $this->expedient->load('collaborators');
        $this->addCollaborator = '';
    }

    public function updatedExpedientAdjusterId($value)
    {
        $this->expedient->load('adjuster');
    }

    public function deleteProduct()
    {
        $this->expedient->policy->update(['product_id' => null]);
        $this->showDeleteModal = false;
    }

    public function cancelDeletion()
    {
        $this->showDeleteModal = false;
        $this->expedient->ramo_id = $this->expedient->getOriginal('ramo_id');
    }

    public function detachCollaborator($id)
    {
        $this->expedient->collaborators()->detach($id);
        $this->expedient->load('collaborators');
    }

    public function save()
    {
        $this->validate();
//        dd($this->expedient->policy_id);
        if ($this->expedient->requires_policy && ! $this->expedient->policy) {
            $this->expedient->policy_id = \App\Models\Insurance\Policy::create()->id;
        } elseif (! $this->expedient->requires_policy) {
            $policy = \App\Models\Insurance\Policy::find($this->expedient->policy_id);
//            $this->expedient->policy_id = null;
        }

        $this->expedient->save();
        $this->expedient->load('adjuster');
        $this->detachCollaborator($this->expedient->adjuster_id);

        $this->expedient->typecases()->sync($this->typecases);

        $this->notify(__('Guardado'), __('Se han actualizado los datos del expediente: '.$this->expedient->full_code));
        $this->emit('expedientManagementUpdated');
    }

    public function render()
    {
        return view('livewire.expedient.edit.management', [
            'employees' => $this->expedient->gabinete->techniciansForZip($this->expedient->address->country_id, $this->expedient->address->zip),
            'externals' => $this->expedient->gabinete->techniciansExternalsForZip($this->expedient->address->country_id, $this->expedient->address->zip),
        ]);
    }
}
