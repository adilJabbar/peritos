<?php

namespace App\Listeners;

use App\Events\UserReseted;
use App\Mail\ResetUser;
use App\Mail\Welcome\NewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailResetToUser
{
    /**
     * Create the event listener.
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
     * @param  UserReseted  $event
     * @return void
     */
    public function handle(UserReseted $event)
    {
        Mail::to($event->user->email)->send(new ResetUser($event->user, $event->password));
    }
}
