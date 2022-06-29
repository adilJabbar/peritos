<?php

namespace App\Http\Livewire\Country;

use App\Models\Insurance\Product;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Ramo extends Component
{
    use WithFileUploads,
        WithFileDelete;

    public \App\Models\Admin\Ramo $ramo;

    public $showSubmenu;

    public $ramoNewIcon;

    protected $listeners = ['typeCasesUpdated', 'capitalsUpdated'];

    protected $rules = [
        'ramo.name' => 'required',
        'ramo.preexistence_class_id' => 'required',
        'ramo.default_product_id' => 'required',
    ];

    protected $queryString = ['showSubmenu'];

    public function mount($ramo)
    {
        $this->ramo = $ramo;
        $this->ramo->default_product_id === null ? $this->ramo->default_product_id = '' : '';
    }

    public function capitalsUpdated()
    {
        $this->ramo->load('capitals');
    }

    public function deleteRamo(\App\Models\Admin\Ramo $ramo)
    {
        if ($ramo->expedients->count() === 0) {
            $ramo->delete();
            $this->notify('Eliminado', __('Se ha eliminado el ramo para este pais'));
            redirect(route('administration.country.show', ['country' => $ramo->country]).'?showSubmenu=Ramos');
        } else {
            $this->notify('No se puede eliminar', __('Este ramo tiene expedientes asignados y no se puede eliminar'), 'error');
        }
//        $ramo->delete();
//        $this->country->load('ramos');
//        $this->ramoSelected = Ramo::make(['preexistence_class_id' => '']);
    }

    public function saveRamo()
    {
        $this->validate();
        $this->ramo->save();
        $this->ramoNewIcon
            && $this->deleteFile('public', $this->ramo->icon)
            && $this->ramo->update(['icon' => $this->ramoNewIcon->store('img/icons', 'public')])
            && $this->reset('ramoNewIcon');
    }

    public function typeCasesUpdated()
    {
        $this->ramo->load('typecases');
    }

    public function render()
    {
        return view('livewire.country.ramo', [
            'default_products' => Product::where('company_id', 0)->get(),
        ]);
    }
}
