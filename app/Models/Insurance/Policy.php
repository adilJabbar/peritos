<?php

namespace App\Models\Insurance;

use App\Models\Admin\Capital;
use App\Models\CapitalPolicy;
use App\Models\Expedient;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Policy extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function capitals()
    {
        return $this->belongsToMany(Capital::class)->withPivot(['amount', 'primer_riesgo', 'perc_cia', 'reposicion', 'deprecation']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function expedients()
    {
        return $this->hasMany(Expedient::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getIconAttribute()
    {
        return file_exists('img/file-types/'.strtoupper(pathinfo($this->cond_particular)['extension']).'.png')
            ? asset('img/file-types/'.strtoupper(pathinfo($this->cond_particular)['extension']).'.png')
            : asset('img/file-types/NoPreview.png');
    }

    public function getUrlCondParticularAttribute()
    {
        return $this->cond_particular
            ? Storage::disk('policies')->url($this->cond_particular)
            : asset('img/file-types/NoPreview.png');
    }

    public function setReferenceAttribute($value)
    {
        if ($value) {
            $this->attributes['reference'] = preg_replace('/[^a-zA-Z0-9]/', '', strtoupper($value));
        }
    }
}
