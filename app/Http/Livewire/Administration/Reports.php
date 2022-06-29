<?php

namespace App\Http\Livewire\Administration;

use App\Models\Documentversion;
use Livewire\Component;

class Reports extends Component
{
    public $newAdvance;

    public $newPreReport;

    public $newReport;

    public $newInvoice;

    protected $listeners = ['reportsUpdated' => '$refresh'];

    public function mount()
    {
        $this->newAdvance = Documentversion::make(['type' => 'advance']);
        $this->newPreReport = Documentversion::make(['type' => 'prereport']);
        $this->newReport = Documentversion::make(['type' => 'report']);
        $this->newInvoice = Documentversion::make(['type' => 'invoice']);
    }

    public function render()
    {
        return view('livewire.administration.reports', [
            'advances' => Documentversion::where('type', 'advance')->get(),
            'prereports' => Documentversion::where('type', 'prereport')->get(),
            'reports' => Documentversion::where('type', 'report')->get(),
            'invoices' => Documentversion::where('type', 'invoice')->get(),
        ]);
    }
}
