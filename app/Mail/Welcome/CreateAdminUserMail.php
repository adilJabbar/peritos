<?php

namespace App\Mail\Welcome;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateAdminUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gabinete;

    /**
     * CreateOld a new message instance.
     *
     * @return void
     */
    public function __construct($gabinete)
    {
        //
        $this->gabinete = $gabinete;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome.create_admin_user');
    }
}
