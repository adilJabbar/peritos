<?php

namespace App\Http\Livewire\Country;

use App\Models\Admin\Country;
use App\Models\Admin\Ramo;
use Livewire\Component;

class Ramos extends Component
{
    public Country $country;

    public Ramo $ramo;

    public $newRamo;

    public function mount($country)
    {
        $this->country = $country;
        $this->ramo = Ramo::make();
    }

    public function addRamo()
    {
        $this->validate(['newRamo' => 'required|min:3']);
        $newRamo = $this->country->ramos()->create(['name' => $this->newRamo]);
//        dd($newRamo);
        redirect(route('administration.country.ramo.show', ['ramo' => $newRamo->id]));
    }

    public function removeRamo(Ramo $ramo)
    {
//        dd($ramo->expedients->count());
        if ($ramo->expedients->count() === 0) {
            $ramo->delete();
            $this->notify('Eliminado', __('Se ha eliminado el ramo para este pais'));
        } else {
            $this->notify('No se puede eliminar', __('Este ramo tiene expedientes asignados y no se puede eliminar'), 'error');
        }
    }

    public function render()
    {
        return view('livewire.country.ramos');
    }
}
