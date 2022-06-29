<?php

namespace App\Http\Livewire\Country;

use App\Models\Admin\Country;
use Livewire\Component;

class DeprecationGroups extends Component
{
    public Country $country;

    public function mount($country)
    {
        $this->country = $country;
    }

    public function render()
    {
        return view('livewire.country.deprecation-groups');
    }
}
