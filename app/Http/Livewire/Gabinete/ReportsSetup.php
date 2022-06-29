<?php

namespace App\Http\Livewire\Gabinete;

use App\Models\Documentversion;
use Livewire\Component;

class ReportsSetup extends Component
{
    public $gabinete;

    public $reportsOptions;

    protected $rules = [
        'gabinete.advance_id' => 'required',
        'gabinete.preReport_id' => 'required',
        'gabinete.report_id' => 'required',
        'gabinete.invoice_id' => 'required',
    ];

    public function mount()
    {
        $this->reportsOptions = Documentversion::all();
    }

    public function updated($field)
    {
        $this->gabinete->update();
    }

    public function render()
    {
        return view('livewire.gabinete.reports-setup');
    }
}
