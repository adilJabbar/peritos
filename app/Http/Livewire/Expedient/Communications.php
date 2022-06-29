<?php

namespace App\Http\Livewire\Expedient;

use App\Models\Expedient;
use Carbon\Carbon;
use Livewire\Component;
use Twilio\Rest\Client;

class Communications extends Component
{
    public Expedient $expedient;

    public function mount(Expedient $expedient)
    {
        $this->expedient = $expedient;
    }

    public function startNewCall(): void
    {
        $videoSession = $this->expedient->videoSessions()->create([
            'user_id' => auth()->user()->id,
            'start_time' => Carbon::now()
        ]);
        $this->emit('createNewVideoCall', $videoSession->id);
    }

//    public function generateVideoLink(): void
//    {
//
//        $client = new Client($this->accountSid, $this->apiKeySecret);
//        //remove ssl
////        $curlOptions = [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false];
////        $client->setHttpClient(new CurlClient($curlOptions));
//        $roomName = rand(0000000001, 9999999999);
//        $exists = $client->video->rooms->read(['uniqueName' => $roomName]);
//        if (empty($exists)) {
//            $client->video->rooms->create([
//                'uniqueName' => $roomName,
//                'type' => 'group',
//                'recordParticipantsOnConnect' => true
//            ]);
//        }
//        $this->roomName = $roomName;
//        $this->emit('showVideoPanel', true);
//        $this->notify(__('Link generated'), __('Video link generated successfully.'));
//    }

    public function joinRoom(): void
    {
        $this->redirect(route("communications.join_room", [$this->roomName]));
    }

    public function render()
    {
        return view('livewire.expedient.edit.communications');
    }
}
