<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewGabineteCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gabinete;

    /**
     * CreateOld a new event instance.
     *
     * @return void
     */
    public function __construct($gabinete)
    {
        $this->gabinete = $gabinete;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('gabinetes-channel');
    }
}
