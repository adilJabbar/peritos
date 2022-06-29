<?php

namespace App\Models;

use App\Models\Documents\Advance;
use App\Traits\HasLocalDates;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CreatedDocuments extends Model
{
    use HasFactory, HasLocalDates;

    protected $guarded = [];

    public function advance()
    {
//        if($this->template->type = 'advance'){
        return $this->hasOne(Advance::class);
//        }
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function expedient()
    {
        return $this->belongsTo(Expedient::class);
    }

    public function template()
    {
        return $this->belongsTo(Documentversion::class, 'document_version_id');
    }

    public function getTypeAttribute()
    {
        return $this->template->type;
    }

    public function getPublicUrlAttribute()
    {
        return Storage::disk('expedients')->url($this->path);
    }
}
