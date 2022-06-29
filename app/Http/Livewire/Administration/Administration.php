<?php

namespace App\Http\Livewire\Administration;

use App\Models\Gabinete;
use App\Models\User;
use App\Traits\WithSideNavigation;
use http\QueryString;
use Livewire\Component;

class Administration extends Component
{
    use WithSideNavigation;

    public $showEditModal = false;

    public $selector;

    protected $listeners = [
        'GabinetesUpdated' => '$refresh',
        'UsersUpdated' => '$refresh',
    ];

    protected $queryString = ['showSubmenu', 'selector'];

    public function mount()
    {
        $this->mountSubmenu('Gabinetes');
    }

    public function render()
    {
        return view('livewire.administration.administration', [
            'gabinetes' => Gabinete::count(),
            'users' => User::count(),
        ]);
    }
}
