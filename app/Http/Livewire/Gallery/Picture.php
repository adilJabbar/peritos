<?php

namespace App\Http\Livewire\Gallery;

use Livewire\Component;

class Picture extends Component
{
    public \App\Models\Expedient\Picture $picture;

    protected $rules = [
        'picture.name' => 'required',
        'picture.comments' => '',
        'picture.avance' => '',
        'picture.prereport' => '',
        'picture.report' => '',
        'picture.incidencia' => '',
    ];

    public function mount(\App\Models\Expedient\Picture $picture)
    {
        $this->picture = $picture;
    }

    public function updatedPicture()
    {
        $this->validate();
        $this->picture->save();
        $this->emit('imageUpdated', $this->picture->id);
    }

    public function closeGalleryModal()
    {
        $this->emit('closeGalleryModal');
    }

    public function goNext()
    {
        $this->emit('nextImage');
    }

    public function goPrevious()
    {
        $this->emit('previousImage');
    }

    public function render()
    {
        return view('livewire.gallery.picture');
    }
}
