<?php

namespace App\Mail\Welcome;

use App\Models\Gabinete;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class WelcomeNewGabineteMail extends Mailable
{
    use Queueable, SerializesModels;

    public Gabinete $gabinete;

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
        return $this->subject(__('mailing.new gabinete created', ['name' => $this->gabinete->name]))
            ->markdown('emails.welcome.new_gabinete');
    }
}
