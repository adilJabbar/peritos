<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait HasWorkTime
{
    public function getListeners()
    {
        return $this->listeners + [
            'idleOutWorkTime',
            'loadedWorkTimeArea',
        ];
    }

    public function idleOutWorkTime($timeable_type, $timeable_id, $name)
    {
        $model = $timeable_type::find($timeable_id);
        $model->closeWorkTimeable($name);
    }

    public function loadedWorkTimeArea($timeable_type, $timeable_id, $name)
    {
        $model = $timeable_type::find($timeable_id);
        $model->checkWorkTimeable($name);
    }
}
