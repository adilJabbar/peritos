<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Expedient\Picture;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class GridImage extends Component
{
    use WithFileUploads,
        WithFileDelete;

    public Picture $image;

    public bool $showSelectionOptions;

    public $selected = false;

    public $deletable;

    public $height;

    protected $listeners = ['imageUpdated', 'showSelectPicturesOptions', 'selectAllImages', 'unselectAllImages'];

    protected $rules = [
        'image.name' => 'required',
    ];

    public function mount($image, $height = 48, $showSelectionOptions = false, $deletable = true)
    {
        $this->image = $image;
        $this->showSelectionOptions = $showSelectionOptions;
        $this->deletable = $deletable;
        $this->height = $height;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->image->save();
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
        return view('livewire.gallery.grid-image');
    }
}
