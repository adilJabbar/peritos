<?php

namespace App\Http\Livewire\Layout\Menu;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class LanguageSelector extends Component
{
    public User $user;

    public $language;

    public $availableLanguages = ['es' => 'Spanish', 'en' => 'English'];

    protected $listeners = ['userUpdated', 'loggedUserUpdated' => '$refresh'];

    public function mount()
    {
        $this->user = Auth::user();
        $this->language = App::getLocale();
    }

    public function userUpdated(User $user)
    {
        $this->language != $user->language
            ? redirect()->to(session()->get('_previous.url'))
            : '';
    }

    public function updateUserLanguage($value)
    {
        $this->user->update(['language' => $value]);

        return redirect()->to(session()->get('_previous.url'));
    }

    public function render()
    {
        return view('livewire.layout.menu.language-selector');
    }
}
