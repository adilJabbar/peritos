<?php

namespace App\Http\Livewire\Gallery;

use Livewire\Component;

class Image extends Component
{
    public \App\Models\Expedient\Image $image;

    protected $rules = [
        'image.name' => 'required',
        'image.comments' => '',
    ];

    public function mount(\App\Models\Expedient\Image $image)
    {
        $this->image = $image;
    }

    public function updatedImage()
    {
        $this->validate();
        $this->image->save();
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
        return view('livewire.gallery.image');
    }
}
