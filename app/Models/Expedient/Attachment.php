<?php

namespace App\Models\Expedient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getExtensionAttribute()
    {
        return pathinfo($this->path)['extension'];
    }

    public function getIconAttribute()
    {
        return file_exists('img/file-types/'.strtoupper($this->extension).'.png')
                ? asset('img/file-types/'.strtoupper($this->extension).'.png')
                : asset('img/file-types/NoPreview.png');
    }

    public function getUrlExpedientAttribute()
    {
        return $this->path
            ? Storage::disk('expedients')->url($this->path)
            : asset('img/file-types/NoPreview.png');
    }
}
