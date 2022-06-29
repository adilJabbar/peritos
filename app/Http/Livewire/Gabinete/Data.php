<?php

namespace App\Http\Livewire\Gabinete;

use App\Traits\WithFileDelete;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Data extends Component
{
    use WithFileUploads, WithFileDelete;

    public \App\Models\Gabinete $gabinete;

    public $logo;

    public $logo_horiz;

    public $logo_icon;

    public function rules()
    {
        return [
            'gabinete.name' => 'required|min:3',
            'gabinete.legal_name' => 'min:3',
            'gabinete.legal_id' => '',
            'gabinete.address' => '',
            'gabinete.city' => '',
            'gabinete.zip' => '',
            'gabinete.state' => '',
            'gabinete.country_id' => 'required',
            'gabinete.phone' => 'string|min:7',
            'gabinete.email' => ['required', 'email', Rule::unique('gabinetes', 'email')->ignore($this->gabinete)],
            'gabinete.www' => 'sometimes',
            'gabinete.main_color' => 'sometimes',
            'gabinete.secondary_color' => 'sometimes',
            'gabinete.caller_number' => 'sometimes',
            'gabinete.is_active' => 'boolean',
            'logo' => 'nullable|image|max:1024',
            'logo_horiz' => 'nullable|image|max:1024',
            'logo_icon' => 'nullable|image|max:512',
        ];
    }

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
    }

    public function save()
    {
        $this->validate();

        $this->logo
        && $this->deleteFile('logos', $this->gabinete->logo)
        && $this->gabinete->logo = $this->logo->store('/', 'logos');

        $this->logo_horiz
        && $this->deleteFile('logos', $this->gabinete->logo_horiz)
        && $this->gabinete->logo_horiz = $this->logo_horiz->store('/', 'logos');

        $this->logo_icon
        && $this->deleteFile('logos', $this->gabinete->logo_icon)
        && $this->gabinete->logo_icon = $this->logo_icon->store('/', 'logos');

        $this->gabinete->save();
        $this->emit('GabineteDataUpdated');
        $this->notify(__('Guardado'), __('Se han actualizado los datos del gabinete'));
    }

    public function createNewToken()
    {
        $this->gabinete->createAdministratorUserToken();
        $this->notify(__('Accesos temporales creados'), __('Se han enviado los correos de bienvenida a: '.$this->gabinete->email));
    }

    public function render()
    {
        return view('livewire.gabinete.data');
    }
}
