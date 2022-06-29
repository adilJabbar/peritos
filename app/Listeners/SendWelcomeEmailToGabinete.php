<?php

namespace App\Listeners;

use App\Events\NewGabineteCreated;
use App\Mail\Welcome\WelcomeNewGabineteMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailToGabinete
{
    /**
     * CreateOld the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewGabineteCreated  $event
     * @return void
     */
    public function handle(NewGabineteCreated $event)
    {
        Mail::to($event->gabinete->email)->send(new WelcomeNewGabineteMail($event->gabinete));
    }
}
