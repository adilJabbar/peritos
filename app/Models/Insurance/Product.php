<?php

namespace App\Models\Insurance;

use App\Models\Admin\Capital;
use App\Models\Admin\Ramo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function addCapital($capitalId)
    {
        if (! $this->hasCapital($capitalId)) {
            $this->capitals()->attach($capitalId);
        }
    }

    public function capitals()
    {
        return $this->belongsToMany(Capital::class)->withPivot('derog_reg_prop', 'derog_amount', 'derog_percent');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getIconAttribute()
    {
        return file_exists('img/file-types/'.strtoupper(pathinfo($this->cond_general)['extension']).'.png')
            ? asset('img/file-types/'.strtoupper(pathinfo($this->cond_general)['extension']).'.png')
            : asset('img/file-types/NoPreview.png');
    }

    public function getUrlCondGeneralAttribute()
    {
        return $this->cond_general
            ? Storage::disk('products')->url($this->cond_general)
            : asset('img/file-types/NoPreview.png');
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function hasCapital($capitalId)
    {
        return $this->capitals->where('id', $capitalId)->count() > 0;
    }

    public function ramo()
    {
        return $this->belongsTo(Ramo::class);
    }

    public function removeCapital($capitalId)
    {
        $this->capitals()->detach($capitalId);
    }
}
