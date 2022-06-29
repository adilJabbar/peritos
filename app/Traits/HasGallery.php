<?php

namespace App\Traits;

use App\Models\Expedient\Image;
use Carbon\Carbon;

trait HasGallery
{
    public $showGalleryModal = false;

    public $activeFoto;

    public $imageKeys = [];

    public function previousImage()
    {
        if (count($this->imageKeys) > 1) {
            $index = array_search($this->activeFoto, $this->imageKeys);
            if ($index == 0) {
                $this->activeFoto = $this->imageKeys[array_key_last($this->imageKeys)];
            } else {
                $this->activeFoto = $this->imageKeys[$index - 1];
            }
        }
    }

    public function nextImage()
    {
        if (count($this->imageKeys) > 1) {
            $index = array_search($this->activeFoto, $this->imageKeys);
            if ($index == array_key_last($this->imageKeys)) {
                $this->activeFoto = $this->imageKeys[0];
            } else {
                $this->activeFoto = $this->imageKeys[$index + 1];
            }
        }
    }

    public function closeGalleryModal()
    {
        $this->showGalleryModal = false;
    }

//    public function showGallery(Image $image)
//    {
//        $this->activeFoto = $image->getKey()
//            ? $image->id
//            : $this->preexistence->images->first()->id;
//
//        $this->imageKeys = $this->preexistence->images->pluck('id')->toArray();
//
//        count($this->preexistence->images) && $this->showGalleryModal = true;
//    }
}
