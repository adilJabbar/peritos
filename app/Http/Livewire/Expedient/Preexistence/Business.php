<?php

namespace App\Http\Livewire\Expedient\Preexistence;

use App\Models\Admin\Riskdetail;
use App\Models\Admin\Riskgroup;
use App\Models\Admin\Risksubgroup;
use App\Models\Expedient;
use App\Models\Expedient\Image;
use App\Models\Preexistence\BusinessPreexistence;
use App\Traits\HasGallery;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class Business extends Component
{
    use WithFileUploads,
    WithFileDelete,
    HasGallery;

    public Expedient $expedient;

    public RiskGroup $riskgroup;

    public Risksubgroup $risksubgroup;

    public Riskdetail $riskdetail;

    public BusinessPreexistence $preexistence;

    public $riskOutsidePicture;

    public $riskInsidePicture;

    public $yearsOld;

    public $showContinenteCalculations = false;

    public $showContenidoCalculations = false;

    protected $listeners = ['previousImage', 'nextImage', 'closeGalleryModal'];

    protected $rules = [
        'riskgroup.id' => '',
        'risksubgroup.id' => '',
        'preexistence.riskdetail_id' => '',
        'preexistence.dimension' => '',
        'preexistence.year' => '',
        'preexistence.structure' => '',
        'preexistence.roof' => '',
        'preexistence.wall' => '',
        'preexistence.owner' => '',
        'preexistence.user' => '',
        'preexistence.used_as' => '',
        'preexistence.rooms' => '',
        'preexistence.quality' => '',
        'preexistence.maintenance' => '',
        'preexistence.people' => '',
        'preexistence.furniture' => '',
        'preexistence.amount' => '',
        'preexistence.pets' => 'boolean',
    ];

    public function validationAttributes()
    {
        return [
            'riskOutsidePicture' => __('fotografía exterior'),
            'contacts.*.type' => __('que indica el tipo'),
            'contacts.*.value' => __('que indica el dato'),
        ];
    }

    public function mount($expedient)
    {
        $this->expedient = $expedient;

        dd($this->expedient->address->preexistenceable);
        if ($this->expedient->address->preexistenceable) {
            $this->preexistence = $this->expedient->address->preexistenceable;
            $this->riskdetail = $this->preexistence->riskdetail;
            $this->risksubgroup = $this->riskdetail->risksubgroup;
            $this->riskgroup = $this->risksubgroup->riskgroup;
            $this->yearsOld = date('Y') - $this->preexistence->year;
        } else {
            $this->riskgroup = Riskgroup::make(['id' => '']);
            $this->risksubgroup = Risksubgroup::make(['id' => '']);
            $this->riskdetail = Riskdetail::make(['id' => '']);
            $this->preexistence = BusinessPreexistence::make([
                'riskdetail_id' => '',
                'structure' => '',
                'roof' => '',
                'wall' => '',
                'quality' => '',
                'maintenance' => 0,
                'furniture' => '',
                'amount' => '',
                'owner' => '',
                'user' => '',
                'used_as' => '',
                'pets' => 0,
            ]);
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedPreexistenceYear($value)
    {
        $this->yearsOld = date('Y') - $value;
    }

    public function updatedYearsOld($value)
    {
        $this->preexistence->year = date('Y') - $value;
    }

    public function updatedRiskgroupId($value)
    {
        $this->riskgroup = Riskgroup::find($value);
        $this->risksubgroup = Risksubgroup::make(['id' => '']);
    }

    public function updatedRisksubgroupId($value)
    {
        $this->risksubgroup = Risksubgroup::find($value);
        $this->preexistence->riskdetail_id = '';
    }

    public function updatedPreexistenceRiskdetailId($value)
    {
        $this->riskdetail = Riskdetail::find($value);
    }

    public function updatedPreexistence()
    {
        $this->validate();
        $this->preexistence->save();
        $this->preexistence->load('riskdetail');
        $this->preexistence->address()->save($this->expedient->address);
    }

    public function updatedRiskOutSidePicture()
    {
        $this->validate([
            'riskOutsidePicture' => 'required|max:3064|mimes:jpg,bmp,png',
        ]);

        $this->riskOutsidePicture
        && $this->deleteFile('images', $this->preexistence->outside_picture)
        && $this->preexistence->images()->updateOrCreate(['group' => 'OutsidePhoto'], [
            'name' => __('Foto Exterior'),
            'path' => $this->riskOutsidePicture->store('/', 'images'),
        ]);
    }

    public function updatedRiskInsidePicture()
    {
        $this->validate([
            'riskInsidePicture' => 'required|max:3064|mimes:jpg,bmp,png',
        ]);

        $this->riskInsidePicture
        && $this->deleteFile('images', $this->preexistence->inside_picture)
        && $this->preexistence->images()->updateOrCreate(['group' => 'InsidePhoto'], [
            'name' => __('Foto Interior'),
            'path' => $this->riskInsidePicture->store('/', 'images'),
        ]);
    }

    public function loadProposalContinent()
    {
        if ($this->expedient->policy->capitals->where('predefined', 'continente')->first()) {
            $this->expedient->policy->capitals()->updateExistingPivot($this->expedient->policy->capitals->where('predefined', 'continente')->first()->id, [
                'reposicion' => $this->preexistence->continentValueProposal($this->preexistence->building_value),
                'deprecation' => $this->preexistence->building_deprecation_percent,
            ]);
            $this->emit('continentUpdated');
        }
    }

    public function loadProposalContent()
    {
        if ($this->expedient->policy->capitals->where('predefined', 'contenido')->first()) {
            $this->expedient->policy->capitals()->updateExistingPivot($this->expedient->policy->capitals->where('predefined', 'contenido')->first()->id, [
                'reposicion' => $this->preexistence->contentValueProposal(),
            ]);
            $this->emit('contentUpdated');
        }
    }

    public function showGallery(Image $image)
    {
        $this->activeFoto = $image->getKey()
            ? $image->id
            : $this->preexistence->images->first()->id;

        $this->imageKeys = $this->preexistence->images->pluck('id')->toArray();

        count($this->preexistence->images) && $this->showGalleryModal = true;
    }

    public function showContinenteCalculations()
    {
        $this->showContinenteCalculations = true;
    }

    public function showContenidoCalculations()
    {
        $this->showContenidoCalculations = true;
    }

    public function render()
    {
        return view('livewire.expedient.preexistence.business');
    }
}
