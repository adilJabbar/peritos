<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use App\Models\Expedient\Image;
use App\Models\Expedient\Picture;
use App\Traits\HasGallery;
use App\Traits\WithExpedientAccessCheck;
use App\Traits\WithFileDelete;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Validator;

class Anexos extends Component
{
    use WithExpedientAccessCheck,
        WithFileUploads,
        WithFileDelete,
        HasGallery;

    public bool $readonly = true;

    public $anexos = [];

    public $pictures = [];

    public $collectionSelected;

    public $collection = '';

    public $totalPictures;

    public $showSelectPicturesOptions = false;

    public $imagesArray = [];

    public bool $selectAll = false;

    public $bulkAction = '';

    public $showSelectAnexosOptions = false;

    public $anexosArray = [];

    public $selectAllAnexos = false;

    public $bulkActionAnexos = '';

    public Expedient $expedient;

    protected $queryString = ['collection'];

    protected $listeners = [
        'imagesUpdated' => '$refresh',
        'anexosUpdated' => '$refresh',
        'showGalleries',
        'previousImage',
        'nextImage',
        'closeGalleryModal',
        'pictureToSelection',
    ];

    protected $rules = [
        'pictures.*' => 'image|max:4096',
        'anexos.*' => 'max:4096',
    ];

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->verifyAllowed();

        auth()->user()->can('expedient.update') && $this->readonly = false;
    }

    public function updatedCollection($value)
    {
        $this->totalPictures = $this->pictures_collection->count();
    }

    public function updatedShowSelectPicturesOptions()
    {
        $this->emit('showSelectPicturesOptions', $this->showSelectPicturesOptions);
        if (! $this->showSelectPicturesOptions) {
            $this->imagesArray = [];
            $this->selectAll = false;
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->imagesArray = $this->pictures_collection->pluck('id')->toArray();
            $this->emit('selectAllImages');
        } else {
            $this->imagesArray = [];
            $this->emit('unselectAllImages');
        }
    }

    public function updatedBulkAction($value)
    {
        $values = [];
        if ($value == 'addAvance' || $value == 'addAll') {
            $values['avance'] = 1;
        }
        if ($value == 'addPrereport' || $value == 'addAll') {
            $values['prereport'] = 1;
        }
        if ($value == 'addReport' || $value == 'addAll') {
            $values['report'] = 1;
        }
        if ($value == 'addIncidencia' || $value == 'addAll') {
            $values['incidencia'] = 1;
        }
        if ($value == 'deleteAvance' || $value == 'deleteAll') {
            $values['avance'] = 0;
        }
        if ($value == 'deletePrereport' || $value == 'deleteAll') {
            $values['prereport'] = 0;
        }
        if ($value == 'deleteReport' || $value == 'deleteAll') {
            $values['report'] = 0;
        }
        if ($value == 'deleteIncidencia' || $value == 'deleteAll') {
            $values['incidencia'] = 0;
        }
        foreach ($this->imagesArray as $key => $idValue) {
            Picture::find($idValue)->update($values);
        }
        $this->bulkAction = '';
        $this->imagesArray = [];
        $this->showSelectPicturesOptions = false;
        $this->selectAll = false;
        $this->updatedShowSelectPicturesOptions();
    }

    public function updatedBulkActionAnexos($value)
    {
        $values = [];
        if ($value == 'addAvance' || $value == 'addAll') {
            $values['avance'] = 1;
        }
        if ($value == 'addPrereport' || $value == 'addAll') {
            $values['prereport'] = 1;
        }
        if ($value == 'addReport' || $value == 'addAll') {
            $values['report'] = 1;
        }
        if ($value == 'addIncidencia' || $value == 'addAll') {
            $values['incidencia'] = 1;
        }
        if ($value == 'deleteAvance' || $value == 'deleteAll') {
            $values['avance'] = 0;
        }
        if ($value == 'deletePrereport' || $value == 'deleteAll') {
            $values['prereport'] = 0;
        }
        if ($value == 'deleteReport' || $value == 'deleteAll') {
            $values['report'] = 0;
        }
        if ($value == 'deleteIncidencia' || $value == 'deleteAll') {
            $values['incidencia'] = 0;
        }
        foreach ($this->anexosArray as $key => $idValue) {
            Expedient\Anexo::find($idValue)->update($values);
        }
        $this->bulkActionAnexos = '';
        $this->anexosArray = [];
        $this->showSelectAnexosOptions = false;
        $this->selectAllAnexos = false;
//        $this->updatedShowSelectPicturesOptions();
    }

    public function updatedSelectAllAnexos($value)
    {
        if ($value) {
            $this->anexosArray = $this->anexoss_collection->pluck('id')->map(fn ($id) => (string) $id);
        } else {
            $this->anexosArray = [];
        }
    }

    public function updatedAnexosArray()
    {
        $this->selectAllAnexos = false;
    }

    public function saveAnexos()
    {
        $this->validateOnly('anexos.*');
        $values = [];
        if ($this->collection == 'avance') {
            $values['avance'] = 1;
        }
        if ($this->collection == 'prereport' || $this->collection == 'avance') {
            $values['prereport'] = 1;
        }
        if ($this->collection == 'report' || $this->collection == 'prereport' || $this->collection == 'avance') {
            $values['report'] = 1;
        }
        if ($this->collection == 'incidencia') {
            $values['incidencia'] = 1;
        }
        foreach ($this->anexos as $anexo) {
            $this->expedient->anexos()->create(array_merge([
                'name' => pathinfo($anexo->getClientOriginalName())['filename'],
                'path' => $anexo->store('/'.$this->expedient->id, 'anexos'),
            ], $values)
            );
        }
        $this->dispatchBrowserEvent('refresh-page');
    }

    public function savePictures()
    {
        $this->validateOnly('pictures.*');
        $values = [];
        if ($this->collection == 'avance') {
            $values['avance'] = 1;
        }
        if ($this->collection == 'prereport' || $this->collection == 'avance') {
            $values['prereport'] = 1;
        }
        if ($this->collection == 'report' || $this->collection == 'prereport' || $this->collection == 'avance') {
            $values['report'] = 1;
        }
        if ($this->collection == 'incidencia') {
            $values['incidencia'] = 1;
        }
        foreach ($this->pictures as $picture) {
            $this->expedient->pictures()->create(array_merge([
                'name' => pathinfo($picture->getClientOriginalName())['filename'],
                'path' => $picture->store('/'.$this->expedient->id, 'images'),
            ], $values)
            );
        }
        $this->reset('pictures');
        $this->dispatchBrowserEvent('pondReset');
//        $this->dispatchBrowserEvent('refresh-page');
    }

    public function pictureToSelection($value, $imageId)
    {
        if ($value) {
            if (! in_array($imageId, $this->imagesArray)) {
                array_push($this->imagesArray, $imageId);
            }
        } else {
            unset($this->imagesArray[array_search($imageId, $this->imagesArray)]);
        }
    }

    public function openGallery()
    {
        $this->showGalleryModal = true;
    }

    public function showGallery(Expedient\Picture $picture)
    {
        $this->activeFoto = $picture->getKey()
            ? $picture->id
            : $this->pictures_collection->first()->id;

        $this->imageKeys = $this->pictures_collection->pluck('id')->toArray();

        $this->totalPictures = $this->pictures_collection->count();

        count($this->pictures_collection) && $this->showGalleryModal = true;
    }

    public function showGalleries(Expedient\Picture $picture)
    {
        $this->showGallery($picture);
    }

    public function getPicturesCollectionProperty()
    {
        return Picture::query()
            ->where('expedient_id', $this->expedient->id)
            ->when($this->collection, fn ($query, $collection) => $query->where($collection, true))
            ->orderBy('name')
            ->get();
    }

    public function getAnexossCollectionProperty()
    {
        return Expedient\Anexo::query()
            ->where('expedient_id', $this->expedient->id)
            ->when($this->collection, fn ($query, $collection) => $query->where($collection, true))
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.expedient.edit.anexos', [
            'picturesCollection' => $this->pictures_collection,
            'anexosCollection' => $this->anexoss_collection,
        ]);
    }
}
