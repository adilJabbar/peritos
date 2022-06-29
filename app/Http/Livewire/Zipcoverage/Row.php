<?php

namespace App\Http\Livewire\Zipcoverage;

use App\Models\ZipCoverage;
use Livewire\Component;

class Row extends Component
{
    public ZipCoverage $zipCoverage;

    protected $rules = [
        'zipCoverage.country_id' => 'required|exists:countries,id',
        'zipCoverage.gabinete_id' => 'required|exists:gabinetes,id',
        'zipCoverage.user_id' => 'required|exists:users,id',
        'zipCoverage.from' => 'required|numeric',
        'zipCoverage.to' => 'required|numeric',
        'zipCoverage.comments' => '',
    ];

    public function mount($zipCoverage)
    {
        $this->zipCoverage = $zipCoverage;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->zipCoverage->save();
    }

    public function delete()
    {
        $this->zipCoverage->delete();
        $this->emit('UserRefreshZipCoverages');
    }

    public function render()
    {
        return view('livewire.zipcoverage.row');
    }
}
