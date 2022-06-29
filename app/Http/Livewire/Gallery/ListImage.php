<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Expedient\Picture;
use Livewire\Component;

class ListImage extends Component
{
    public Picture $image;

    public bool $showSelectionOptions;

    public $selected = false;

    public $deletable;

    public $size;

    public $excluded;

    protected $listeners = ['imageUpdated', 'showSelectPicturesOptions', 'selectAllImages', 'unselectAllImages'];

    protected $rules = [
        'image.name' => 'required',
    ];

    public function mount($image, $size = 48, $showSelectionOptions = false, $deletable = true, $excluded = false)
    {
        $this->image = $image;
        $this->showSelectionOptions = $showSelectionOptions;
        $this->deletable = $deletable;
        $this->size = $size;
        $this->excluded = $excluded;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->image->save();
    }

    public function toggleImage()
    {
        $this->excluded = ! $this->excluded;
        $this->emitUp('updatePicturesArray', $this->image->id);
    }

    public function updatedSelected($value)
    {
        $this->emit('pictureToSelection', $value, $this->image->id);
    }

    public function imageUpdated(Picture $picture)
    {
        if ($this->image->id == $picture->id) {
            $this->image = $picture;
        }
    }

    public function delete()
    {
        $this->deleteFile('images', $this->image->path);
        $this->image->delete();
        $this->emit('imagesUpdated');
    }

    public function viewGallery($picture)
    {
        $this->emit('showGalleries', $picture);
    }

    public function showSelectPicturesOptions($value)
    {
        $this->showSelectionOptions = $value;
        if (! $value) {
            $this->selected = false;
        }
    }

    public function selectAllImages()
    {
        $this->selected = true;
    }

    public function unselectAllImages()
    {
        $this->selected = false;
    }

    public function render()
    {
        return view('livewire.gallery.list-image');
    }
}
