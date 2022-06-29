<?php

namespace App\Traits;

use Carbon\Carbon;

trait IsWorkTimeable
{
    public $showIdleModalConfirmation = false;

    public function checkWorkTimeable($name)
    {
        $openedWorkTime = $this->workTimes->whereNull('end')->where('user_id', auth()->user()->id)->first();
        if ($openedWorkTime) {
            if ($openedWorkTime->overFifteenMinutes()) {
                $this->showIdleModalConfirmation = true;
            } else {
                if ($openedWorkTime->name !== $name) {
                    $openedWorkTime->update(['end' => \Illuminate\Support\Carbon::now()]);
                    $this->workTimes()->create([
                        'user_id' => auth()->user()->id,
                        'name' => $name,
                        'start' => Carbon::now(),
                    ]);
                }
            }
        } else {
            $this->workTimes()->create([
                'user_id' => auth()->user()->id,
                'name' => $name,
                'start' => Carbon::now(),
            ]);
        }
//        dd('hola');
    }

    public function closeWorkTimeable($name)
    {
        $openedWorkTime = $this->workTimes->whereNull('end')->where('user_id', auth()->user()->id)->first();
        if ($openedWorkTime) {
            if ($openedWorkTime->name === $name) {
                $openedWorkTime->update(['end' => \Illuminate\Support\Carbon::now()]);
            }
        }
    }
}
