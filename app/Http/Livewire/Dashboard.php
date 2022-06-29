<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $timezone;

    protected $listeners = ['timezoneData'];

    public function timezoneData($value)
    {
        auth()->user()->update(['timezone' => $value]);
//        dd($value);
    }

    protected $rules = [
        'timezone' => '',
    ];

    public function render()
    {
        return view('livewire.dashboard');
    }
}
