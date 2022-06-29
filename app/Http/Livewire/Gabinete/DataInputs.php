<?php

namespace App\Http\Livewire\Gabinete;

use App\Models\Gabinete;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataInputs extends Component
{
    use WithFileUploads,
        WithFileDelete;

    public Gabinete $gabinete;

    public $logo;

    public $logo_horiz;

    public $logo_icon;

    protected $rules = [
        'gabinete.name' => 'required|min:3',
        'gabinete.legal_name' => '',
        'gabinete.legal_id' => '',
        'gabinete.address' => '',
        'gabinete.city' => '',
        'gabinete.zip' => '',
        'gabinete.state' => '',
        'gabinete.country_id' => '',
        'gabinete.phone' => 'sometimes',
        'gabinete.email' => 'sometimes',
        'gabinete.www' => 'sometimes',
        'gabinete.main_color' => 'sometimes',
        'gabinete.secondary_color' => 'sometimes',
        'gabinete.is_active' => 'boolean',
        'logo' => 'nullable|image|max:1024',
        'logo_horiz' => 'nullable|image|max:1024',
        'logo_icon' => 'nullable|image|max:512',
    ];

    public function mount($gabinete)
    {
        $this->gabinete = $gabinete;
//        dd($this->gabinete);
    }

    public function save()
    {
        $this->validate();

        $this->gabinete->save();

        $this->logo
        && $this->deleteFile('logos', $this->gabinete->logo)
        && $this->gabinete->update([
            'logo' => $this->logo->store('/', 'logos'),
        ]);

        $this->logo_horiz
        && $this->deleteFile('logos', $this->gabinete->logo_horiz)
        && $this->gabinete->update([
            'logo_horiz' => $this->logo_horiz->store('/', 'logos'),
        ]);

        $this->logo_icon
        && $this->deleteFile('logos', $this->gabinete->logo_icon)
        && $this->gabinete->update([
            'logo_icon' => $this->logo_icon->store('/', 'logos'),
        ]);

        $this->notify(__('Guardado'), __('Se han actualizado los datos del gabinete'));
    }

    public function render()
    {
        return view('livewire.gabinete.data-inputs');
    }
}
