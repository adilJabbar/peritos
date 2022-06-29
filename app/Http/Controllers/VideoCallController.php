<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Stevenmaguire\OAuth2\Client\Provider\Dropbox;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class VideoCallController extends Controller
{

    private $accountSid;
    private $token;


    public function __construct()
    {
        $this->accountSid = getenv('TWILIO_ACCOUNT_SID');
        $this->token = getenv("TWILIO_AUTH_TOKEN");
    }

    public function answerPhone()
    {
        // Start our TwiML response
        $response = new VoiceResponse;

        // Read a message aloud to the caller
        $response->say(
            "Thank you for calling 360Claims! Have a great day.",
            array("voice" => "alice")
        );

        echo $response;
    }

    /**
     * this function call from the twilio whenever an event generate
     * @throws \Twilio\Exceptions\TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function webhook(Request $request): void
    {
        $input = $request->all();
        if (isset($input['StatusCallbackEvent']) && $input['StatusCallbackEvent'] === 'recording-completed') {
//            $twilio = new Client($this->accountSid, $this->token);
            try {
                ini_set('max_execution_time', 0);
                $mediaUrl = getenv('TWILIO_MEDIA_URL') . $input['MediaUri'];
                // fetch recordings
                $response = Http::timeout(0)->withBasicAuth($this->accountSid, $this->token)->get($mediaUrl);

                $path = 'public/records/' . $input['RoomSid'] . '/' . $input['ParticipantSid'] . '/' . $input['TrackName'] . '.' . $input['Container'];
                if ($response->successful()) {
                    // store file into local
                    Storage::put($path, $response);
                    // upload file to dropbox
//                    $this->upload($path, $response->body());
                    // delete recording
//                    $twilio->video->v1->recordings($input['RecordingSid'])->delete();
                }
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }
    }

    /**
     * upload recording to Dropbox account
     * @param $file_name
     * @param $response
     */
    public function upload($file_name, $response): void
    {
        $fileName = $file_name;
        try {
            $dropboxClient = new \Spatie\Dropbox\Client([getenv('DROPBOX_APP_KEY'), getenv('DROPBOX_APP_SECRET')]);
            // Upload the file to Dropbox
            $dropboxClient->upload($fileName, $response, 'add', true);
            // File Uploaded
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function genAccessToken()
    {
        $provider = new Dropbox([
            'clientId' => getenv('DROPBOX_APP_KEY'),
            'clientSecret' => getenv('DROPBOX_APP_SECRET'),
            'redirectUri' => 'https://staging.vasundharaapps.com/callbacktest/public/'
        ]);

        if (!isset($_GET['code'])) {

            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: ' . $authUrl);
            exit;

            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            unset($_SESSION['oauth2state']);
            exit('Invalid state');

        } else {

            // Try to get an access token (using the authorization code grant)
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

            // Optional: Now you have a token you can look up a users profile data
            try {

                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);

                // Use these details to create a new profile
                printf('Hello %s!', $user->getId());

            } catch (\Exception $e) {

                // Failed to get user details
                exit('Oh dear...');
            }

            // Use this to interact with an API on the users behalf
            echo $token->getToken();
        }
    }
}
