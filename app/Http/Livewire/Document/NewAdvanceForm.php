<?php

namespace App\Http\Livewire\Document;

use App\Models\CreatedDocuments;
use App\Models\Documentversion;
use App\Models\Expedient\Picture;
use App\Traits\HasLocalDates;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class NewAdvanceForm extends Component
{
    use HasLocalDates;

    public $expedient;

    public $advanceDate;

    public $advanceTemplate;

    public $templates;

    public $pictures;

    public $picturesArray = [];

    public $reserve;

    public $text;

    public $includeAdvanceHistory = true;

    public $watermark = '';

    protected $listeners = ['updatePicturesArray'];

    protected $rules = [
        'advanceDate' => 'required',
        'advanceTemplate' => 'required',
        'text' => 'required',
        'reserve' => 'required',
    ];

    public function validationAttributes()
    {
        return [
            'advanceDate' => __('fecha del avance'),
            'advanceTemplate' =>  __('modelo de documento'),
            'text' =>  __('texto del avance'),
            'reserve' =>  __('reserva estimada'),
        ];
    }

    public function mount($expedient)
    {
        $this->expedient = $expedient;
        $this->templates = Documentversion::where('type', 'advance')->get();
        $this->pictures = $this->expedient->pictures->where('avance', 1);
        $this->picturesArray = $this->pictures->pluck('id')->toArray();
        $this->advanceTemplate = $this->expedient->gabinete->advance->id ?? '1';
        $this->advanceDate = Carbon::now()->format('Y-m-d');
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatePicturesArray($value)
    {
        if (($key = array_search($value, $this->picturesArray)) !== false) {
            unset($this->picturesArray[$key]);
        } else {
            array_push($this->picturesArray, $value);
        }
    }

    public function resetFields()
    {
        $this->picturesArray = $this->pictures->pluck('id')->toArray();
        $this->text = '';
        $this->reserve = '';
    }

    public function generateAdvance()
    {
        $this->validate();
        $templatePath = Documentversion::find($this->advanceTemplate)->path;

        $pictures = Picture::whereIn('id', $this->picturesArray)->get();

        $data = [
            'gabinete' => $this->expedient->gabinete,
            'expedient' => $this->expedient,
            'advanceContent' => [
                'date' => $this->isoFormatLong($this->advanceDate),
                'text' => $this->text,
                'reserve' => $this->reserve,
                'pictures' => $pictures,
                'includeAdvanceHistory' => $this->includeAdvanceHistory,
            ],
            'watermark' => $this->watermark,
        ];

        //defining to a path
        $path = date('Y').'/'.$this->expedient->id.'/'.Str::orderedUuid().'.pdf';

//        $pdf = PDF::loadView('pdfTemplates.samples.css_baseline', $data);
        $pdf = PDF::loadView($templatePath, $data);

        Storage::disk('expedients')->put($path, $pdf->output());

        $newDocument = $this->expedient->documents()->create([
            'document_version_id' => $this->advanceTemplate,
            'reserve' => $this->reserve,
            'created_by' => auth()->user()->id,
            'path' => $path,
        ]);

//        dd($newDocument);
        $newDocument->advance()->create([
            'date' => $this->advanceDate,
            'text' => $this->text,
            'reserve' => $this->reserve,
        ]);

//        $this->resetFields();
        $this->emit('newDocumentCreated');
        $this->notify(__('Documento creado'), __('Se hagenerado un nuevo documento listo para revisar y/o enviar'));
    }

    public function render()
    {
        return view('livewire.document.new-advance-form');
    }
}
