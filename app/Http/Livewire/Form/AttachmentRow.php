<?php

namespace App\Http\Livewire\Form;

use App\Models\Expedient\Attachment;
use App\Traits\WithFileDelete;
use Livewire\Component;
use Livewire\WithFileUploads;

class AttachmentRow extends Component
{
    use WithFileUploads,
        WithFileDelete;

    public Attachment $attachment;

    protected $rules = [
        'attachment.name' => 'required',
    ];

    public function mount(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    public function updatedAttachmentName()
    {
        $this->attachment->save();
    }

    public function removeAttachment()
    {
        $this->deleteFile('expedients', $this->attachment->path);
        $this->attachment->delete();
        $this->emit('attachmentsUpdated');
    }

    public function render()
    {
        return view('livewire.form.attachment-row');
    }
}
