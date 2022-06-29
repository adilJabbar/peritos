<?php

namespace App\Http\Livewire\Communication;

use Livewire\Component;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

class Dialer extends Component
{
    public $phoneNumber = '';
    public $callerNumber = '';
    public $call_button_message = 'Call';

    public function mount($callerNumber)
    {
        $this->callerNumber = $callerNumber;
    }

    public function addNumber($number)
    {
        if(strlen($this->phoneNumber) <= 10){
            $this->phoneNumber .= $number;
        }
    }

    public function resetDialer()
    {
        $this->phoneNumber = '';
    }

    public function delete()
    {
        if(strlen($this->phoneNumber) > 0){
            $this->phoneNumber = substr($this->phoneNumber, 0, -1);
        }
    }

    public function makePhoneCall()
    {
        $this->call_button_message = 'Dialing ...';
        try {
            $client = new Client(
                getenv('TWILIO_ACCOUNT_SID'),
                getenv('TWILIO_AUTH_TOKEN')
            );

            try{
                $client->calls->create(
                    $this->phoneNumber,
                    $this->callerNumber,
                    array(
                        "url" => "http://demo.twilio.com/docs/voice.xml")
                );
                $this->call_button_message = 'Call Connected!';
            }catch(\Exception $e){
                $this->call_button_message = $e->getMessage();
            }
        } catch (ConfigurationException $e) {
            $this->call_button_message = $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.communication.dialer');
    }
}
