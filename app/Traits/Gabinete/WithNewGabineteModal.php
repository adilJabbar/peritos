<?php

namespace App\Traits\Gabinete;

use App\Models\Gabinete;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

trait WithNewGabineteModal
{
    /*Requires
    @include('partials.gabinete.new_gabinete_modal')
    Add rules to main file if there is another rules function declared
    */

    use WithFileUploads;

    public Gabinete $newGabinete;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $sendWelcomeEmail = false;

    public $logo;

    public $logo_horiz;

    public $logo_icon;

    public function rules()
    {
        return [
            'newGabinete.name' => 'required|min:3',
            'newGabinete.legal_name' => 'min:3',
            'newGabinete.legal_id' => '',
            'newGabinete.address' => '',
            'newGabinete.city' => '',
            'newGabinete.zip' => '',
            'newGabinete.state' => '',
            'newGabinete.country_id' => 'required',
            'newGabinete.phone' => 'string|min:7',
            'newGabinete.email' => ['required', 'email', Rule::unique('gabinetes', 'email')->ignore($this->newGabinete)],
            'newGabinete.www' => 'sometimes',
            'newGabinete.main_color' => 'sometimes',
            'newGabinete.secondary_color' => 'sometimes',
            'newGabinete.is_active' => 'boolean',
            'logo' => 'nullable|image|max:1024',
            'logo_horiz' => 'nullable|image|max:1024',
            'logo_icon' => 'nullable|image|max:512',
        ];
    }

    public function resetToBlankNewGabinete()
    {
        $this->newGabinete = Gabinete::make(['country_id' => '', 'is_active' => 0]);
        $this->logo = null;
        $this->logo_horiz = null;
        $this->logo_icon = null;
    }

    public function createNewGabinete()
    {
        if ($this->newGabinete->getKey()) {
            $this->resetToBlankNewGabinete();
        }
        $this->showEditModal = true;
    }

    public function createNewToken()
    {
        $this->newGabinete->createAdministratorUserToken();
        $this->notify(__('Accesos temporales creados'), __('Se han enviado los correos de bienvenida a: '.$this->gabinete->email));
    }

    public function saveNewGabinete()
    {
        $this->validate();

        $this->newGabinete->save();

        $this->logo
        && $this->deleteFile('logos', $this->newGabinete->logo)
        && $this->newGabinete->update([
            'logo' => $this->logo->store('/', 'logos'),
        ]);

        $this->logo_horiz
        && $this->deleteFile('logos', $this->newGabinete->logo_horiz)
        && $this->newGabinete->update([
            'logo_horiz' => $this->logo_horiz->store('/', 'logos'),
        ]);

        $this->logo_icon
        && $this->deleteFile('logos', $this->newGabinete->logo_icon)
        && $this->newGabinete->update([
            'logo_icon' => $this->logo_icon->store('/', 'logos'),
        ]);

        $this->newGabinete->createAdministratorUserToken();

        $this->showEditModal = false;

        $this->resetToBlankNewGabinete();

//        $this->emitSelf('notify-saved');

        $this->notify(__('Guardado'), __('Se han actualizado los datos del gabinete'));
    }
}
