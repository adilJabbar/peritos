<?php

namespace App\Traits\Expedient\newExpedient;

trait RequesterManagement
{
    public bool $showChangeRequesterTypeModal = false;

    public function changeRequesterType()
    {
        $this->expedient->billable = null;
    }

    public function doNotChangeRequesterType()
    {
        $this->emit('changeRequesterTypeTo', class_basename($this->expedient->billable));
        $this->showChangeRequesterTypeModal = false;
    }

//    public function requesterTypeChanged($value)
//    {
//        if($this->expedient->billable){
//            $this->showChangeRequesterTypeModal = true;
//        } else {
//            $this->emit('showRequesterForm');
//        }
//    }
}
