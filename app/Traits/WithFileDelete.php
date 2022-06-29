<?php

namespace App\Traits;

use App\Models\Admin\Country;
use Illuminate\Support\Facades\Storage;

trait WithFileDelete
{
    public function deleteFile($disk, $file)
    {
        if (Storage::disk($disk)->exists($file)) {
            Storage::disk($disk)->delete($file);
        }

        return true;
    }
}
