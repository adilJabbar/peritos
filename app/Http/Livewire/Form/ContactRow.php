<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class ContactRow extends Component
{
    public \App\Models\Contact $contact;

    public $readonly;

    protected $rules = [
        'contact.type' => '',
        'contact.value' => '',
    ];

    public function mount($contact, $readonly = false)
    {
        $this->contact = $contact;
        $this->readonly = $readonly;
    }

    public function render()
    {
        return view('livewire.form.contact-row');
    }
}
