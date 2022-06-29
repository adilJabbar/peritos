<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Documentversion;
use App\Models\Expedient;
use App\Traits\WithExpedientAccessCheck;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentLog extends Component
{
    use WithExpedientAccessCheck;

    public Expedient $expedient;

    public $url;

    public $collection = '';

    public $templates;

    protected $listeners = ['newDocumentCreated' => '$refresh'];

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
        $this->verifyAllowed();

        auth()->user()->can('expedient.update') && $this->readonly = false;
        $this->url = request()->fullUrl();

        $this->templates = Documentversion::all();
    }

    public function createPDF()
    {
        $data = [
            'title' => 'Welcome to 360Claims hola hola',
            'date' => date('m/d/Y').' - es un gran dia',
        ];
        //saving to a path
        $path = date('Y').'/'.Str::orderedUuid().'.pdf';
        $pdf = PDF::loadView('myPDF', $data);
        Storage::disk('expedients')->put($path, $pdf->output());

        // opening it in the browser
        $this->redirect('/files/expedients/'.$path);

        //downloading the file
        return response()->streamDownload(
            fn () => print($pdf->output()), 'ejemplo.pdf'
        );
    }

    public function render()
    {
        return view('livewire.expedient.document-log');
    }
}
