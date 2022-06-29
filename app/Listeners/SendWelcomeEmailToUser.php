<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use App\Mail\Welcome\NewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailToUser
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
     * @param  NewUserCreated  $event
     * @return void
     */
    public function handle(NewUserCreated $event)
    {
        Mail::to($event->user->email)->send(new NewUser($event->user, $event->password));
    }
}
