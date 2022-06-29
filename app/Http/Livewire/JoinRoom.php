<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class JoinRoom extends Component
{
    public $roomName;

    public $token;

    public $identity;

    public function mount($roomName)
    {
        $accountSid = getenv('TWILIO_ACCOUNT_SID');
        $apiKeySid = getenv('TWILIO_API_KEY_SID');
        $apiKeySecret = getenv('TWILIO_API_SECRET');
        $identity = uniqid('', true);

        // Create Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );

        // Grant accesses to Video
        $grant = new VideoGrant();
        $grant->setRoom($roomName);
        $token->addGrant($grant);

        $this->token = $token->toJWT();
        $this->identity = $identity;
        $this->roomName = $roomName;
    }

    public function render()
    {
        return view('livewire.join-room')->layout('layouts.guest');
    }
}
