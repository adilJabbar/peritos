<?php

namespace App\Models\Documents;

use App\Models\CreatedDocuments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createdDocument()
    {
        return $this->belongsTo(CreatedDocuments::class, 'created_document_id');
    }
}
