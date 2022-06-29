<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class ZipCoverage extends Component
{
    public \App\Models\User $user;

    public $gabinete;

    public $newZone;

    public $showNewZone = false;

    public $zipCoverages;

    protected $rules = [
        'newZone.country_id' => 'required|exists:countries,id',
        'newZone.gabinete_id' => 'required|exists:gabinetes,id',
        'newZone.user_id' => 'required|exists:users,id',
        'newZone.from' => 'required|numeric',
        'newZone.to' => 'required|numeric',
        'newZone.comments' => '',
    ];

    protected $listeners = [
        'UserRefreshZipCoverages' => '$refresh',
    ];

    public function mount($user, $gabinete = '')
    {
        $this->user = $user;
        $this->gabinete = $gabinete;
        $gabineteId = $this->gabinete->id ?? '';
        $this->newZone = $this->user->zipCoverages()->make(['country_id' => '', 'gabinete_id' => $gabineteId]);
        $this->loadZipCoverages();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function loadZipCoverages()
    {
        $this->zipCoverages = $this->gabinete->getKey() !== ''
            ? $this->user->zipCoverages->where('gabinete_id', $this->gabinete->id)->whereIn('gabinete_id', $this->user->gabinetes->pluck('id'))
            : $this->user->zipCoverages->whereIn('gabinete_id', $this->user->gabinetes->pluck('id'));
    }

    public function save()
    {
        $this->validate();
        $this->newZone->save();
        $this->showNewZone = false;
        $this->newZone = $this->user->zipCoverages()->make(['country_id' => '', 'gabinete_id' => $this->gabinete->id]);
        $this->user->load('zipCoverages');
        $this->loadZipCoverages();
        $this->emit('UserRefreshZipCoverages');
        $this->notify(__('Guardado'), __('La nueva zona de cobertura ha sido registrada'));
    }

    public function render()
    {
        return view('livewire.user.zip-coverage');
    }
}
