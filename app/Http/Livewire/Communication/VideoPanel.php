<?php

namespace App\Http\Livewire\Communication;

use App\Models\Video\VideoSession;
use Livewire\Component;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;

class VideoPanel extends Component
{
    public bool $showVideoPanel = false;
    public $accountSid;
    public $apiKeySid;
    public $apiKeySecret;
    public $twilio;
    public $roomName;

    public $token;
    public $identity;

    protected $listeners = ['createNewVideoCall'];

    public function mount()
    {
        $this->accountSid = getenv('TWILIO_ACCOUNT_SID');
        $this->apiKeySid = getenv('TWILIO_API_KEY_SID');
        $this->apiKeySecret = getenv('TWILIO_API_SECRET');
        $this->authToken = getenv('TWILIO_AUTH_TOKEN');
        $this->identity = uniqid('', true);
        $this->roomName = '';

    }

    public function createNewVideoCall(VideoSession $videoSession_id)
    {
        $client = new Client($this->accountSid, $this->authToken);
        //remove ssl
//        $curlOptions = [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false];
//        $client->setHttpClient(new CurlClient($curlOptions));
        $roomName = rand(0000000001, 9999999999);
        $exists = $client->video->rooms->read(['uniqueName' => $roomName]);
        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $roomName,
                'type' => 'group',
                'recordParticipantsOnConnect' => true
            ]);
        }
        $this->roomName = $roomName;
        $videoSession_id->update(['roomName' => $this->roomName]);
        $this->showVideoPanel = true;

        // Create Access Token
        $token = new AccessToken(
            $this->accountSid,
            $this->apiKeySid,
            $this->apiKeySecret,
            3600,
            $this->identity
        );

        // Grant accesses to Video
        $grant = new VideoGrant();
        $grant->setRoom($roomName);
        $token->addGrant($grant);

        $this->token = $token->toJWT();
        $this->roomName = $roomName;
    }

    public function render()
    {
        return view('livewire.communication.video-panel');
    }
}
