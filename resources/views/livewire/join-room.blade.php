<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">

<style>
    .height {
        height: calc(100vh - 100px);
    }

    video {
        height: 100%;
        width: 100%;
    }

    .participant-media {
        position: absolute;
        height: 100%;
        width: 100%;
    }

    .participant-media img {
        height: 100%;
        width: 100%;
    }

    .video-screen {
        background: #fff;
        bottom: -100px;
        transition: .8s;
    }

    .hover-video .video-screen {
        bottom: 0;
    }

    .right-bar {
        right: -20%;
        transition: .8s;
    }

    .hover-video .right-bar {
        right: 0;
    }


    /*.hover-video:hover .video-screen {*/
    /*    bottom: 0;*/
    /*}*/

    /*.right-bar {*/
    /*    right: -20%;*/
    /*    transition: .8s;*/
    /*}*/

    /*.hover-video:hover .right-bar {*/
    /*    right: 0;*/
    /*}*/
</style>


<div class="w-4/5 m-auto ">
    <div class="flex justify-between items-center my-4">
        <div class="">
            {{--            <p class="flex items-center text-gray-500">--}}
            {{--                <span class=" rounded-sm flex justify-center items-center  mr-2">--}}
            {{--                <i class="fas fa-record-vinyl text-red-500"></i>--}}
            {{--            </span>--}}
            {{--                Record 00:00:26</p>--}}
            {{--            <p></p>--}}
        </div>
        <div id="button-leave" class="cursor-pointer">
            <p class="flex items-center text-green-500">
                    <span class=" rounded-sm flex justify-center items-center  mr-2">
                        <i class="fas fa-sign-out-alt text-2xl"></i>
                    </span> Leave</p>
        </div>

        {{--        <div class="flex flex-col justify-center items-center ml-auto " id="button-leave">--}}
        {{--            <div class="hover:text-white hover:bg-primary rounded-md flex justify-center items-center w-10 h-10">--}}
        {{--                <i class="fas fa-sign-out-alt text-xl"></i>--}}
        {{--            </div>--}}
        {{--            <p class="text-sm text-gray-500 mt-1">Leave</p>--}}
        {{--        </div>--}}
    </div>
    <div class="rounded-xl  bg-black border  relative overflow-hidden height hover-video">
        <div class="absolute h-full w-full rounded-xl " id="local-media">

        </div>
        <span class="absolute top-4 left-4 rounded-lg  py-1 px-4 text-white bg-red-600">
            You
        </span>
        <div class="ml-auto  absolute z-50 height right-bar overflow-y-auto">
            <div class="flex flex-col pt-8 mr-8 ml-auto" id="remote-media">

            </div>
        </div>

        <div class="flex justify-between mt-10 absolute video-screen  w-full pt-2 pb-1 pl-4" id="room-controls">
            <div class="flex justify-center items-center  gap-x-4 ">
                <div class="flex flex-col justify-center items-center">
                    <div id="me-mic"
                         class="hover:text-white hover:bg-primary rounded-md flex justify-center items-center w-14 h-14  ">
                        <i class="fas fa-microphone text-2xl"></i>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Mic</p>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <div id="me-cam"
                         class="hover:text-white hover:bg-primary  rounded-md flex justify-center items-center w-14 h-14">
                        <i class="fas fa-video text-xl"></i>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Cam</p>
                </div>
                {{--                <div class="flex flex-col justify-center items-center">--}}
                {{--                    <div id="me-screen"--}}
                {{--                         class="hover:text-white hover:bg-primary rounded-md flex justify-center items-center w-14 h-14">--}}
                {{--                        <i class="fas fa-expand text-2xl"></i>--}}
                {{--                        --}}{{--                    <i class="fas fa-compress-arrows-alt text-xl"></i>--}}
                {{--                    </div>--}}
                {{--                    <p class="text-sm text-gray-500 mt-1">Screen</p>--}}
                {{--                </div>--}}

                {{--                <div class="flex flex-col justify-center items-center">--}}
                {{--                    <div--}}
                {{--                        class="hover:text-white hover:bg-primary rounded-md flex justify-center items-center w-14 h-14">--}}
                {{--                        <i class="fas fa-paper-plane text-2xl"></i>--}}
                {{--                    </div>--}}
                {{--                    <p class="text-sm text-gray-500 mt-1">invite</p>--}}
                {{--                </div>--}}
                {{--                        <div class="">--}}
                {{--                            <p class="flex items-center text-green-500">--}}
                {{--                            <span class=" rounded-sm flex justify-center items-center  mr-2">--}}
                {{--                                <i class="fas fa-paper-plane"></i>--}}
                {{--                            </span> invite people</p>--}}
                {{--                        </div>--}}
            </div>


        </div>
    </div>

</div>
{{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
<script src="//sdk.twilio.com/js/video/releases/2.17.1/twilio-video.min.js"></script>
<script type="text/javascript">

    let activeRoom;
    let previewTracks;
    let token = "{{ $token }}";
    let identity = "{{ $identity }}";
    let roomName = ("{{ $roomName }}");
    const participants = document.getElementById("remote-media");
    const me = document.getElementById("local-media");
    console.log({identity})

    startVideoChat(roomName, token)

    function startVideoChat(room, token) {
        // Start video chat and listen to participant connected events
        Twilio.Video.connect(token, {
            room: room,
            audio: true,
            video: true,
            // logLevel: 'debug',
        }).then((room) => {
            activeRoom = room;
            // Once we're connected to the room, add the local participant to the page
            participantConnected(room.localParticipant);
            // Add any existing participants to the page.
            room.participants.forEach(participantConnected);
            // Listen for other participants to join and add them to the page when they
            // do.
            room.on("participantConnected", participantConnected);
            // Listen for participants to leave the room and remove them from the page
            room.on("participantDisconnected", participantDisconnected);
            room.on('dominantSpeakerChanged', participant => {
                console.log('The new dominant speaker in the Room is:', participant);
            });

            // Eject the participant from the room if they reload or leave the page
            window.addEventListener("beforeunload", tidyUp(room));
            window.addEventListener("pagehide", tidyUp(room));
        });
    }

    function participantConnected(participant) {
        const el = document.createElement("div");
        el.setAttribute("id", participant.identity);
        if (!isLocalStream(participant.identity)) {
            // Create new <div> for participant and add it to the page
            el.innerHTML = remoteBox;
            // el.querySelector('.participant-name').innerHTML = participant.identity;
            participants.appendChild(el);
        } else {
            const el1 = document.createElement("div");
            el1.classList.add('participant-media');
            el.appendChild(el1);
            me.appendChild(el);
        }

        // Find all the participant's existing tracks and publish them to our page
        participant.tracks.forEach((trackPublication) => {
            trackPublished(trackPublication, participant);
        });
        // Listen for the participant publishing new tracks
        participant.on("trackPublished", (trackPublication) => {
            trackPublished(trackPublication, participant)
        });
        // participant.on("trackUnpublished", ()=>{
        //     console.log('hello')
        // });
    }

    function trackPublished(trackPublication, participant) {

        // Get the participant's <div> we created earlier
        const el = document.getElementById(participant.identity);
        // Find out if the track has been subscribed to and add it to the page or
        // listen for the subscription, then add it to the page.

        // First create a function that adds the track to the page
        const trackSubscribed = (track) => {
            track.on('disabled', () => {
                /* Hide the associated <video> element and show an avatar image. */
                if (track.kind === 'audio') {
                    console.log(el.querySelector('.participant-audio'))
                    if (el.querySelector('.participant-audio')) {
                        el.querySelector('.participant-audio').classList.remove('hidden');
                    }
                } else {
                    el.querySelector('.participant-media').querySelector('video').remove();
                    el.querySelector('.participant-media').appendChild(getUiImage(participant.identity));
                }
            });
            track.on('enabled', () => {
                console.log('enable')
                /* Hide the associated <video> element and show an avatar image. */
                if (track.kind === 'audio') {
                    if (el.querySelector('.participant-audio')) {
                        el.querySelector('.participant-audio').classList.add('hidden');
                    }
                } else {
                    el.querySelector('.participant-media').querySelector('img').remove();
                }
            });


            // if (isLocal) {
            //     me.innerHTML = '';
            //     me.appendChild(track.attach());
            //     // return;
            // }
            // track.attach() creates the media elements <video> and <audio> to
            // to display the track on the page.
            console.log(track)
            // el.querySelector('.participant-media').innerHTML = '';
            if (track.kind === 'video') {
                if (el.querySelector('.participant-media').querySelector('img')) {
                    el.querySelector('.participant-media').querySelector('img').remove();
                }
            }
            el.querySelector('.participant-media').appendChild(track.attach());
        };
        // If the track is already subscribed, add it immediately to the page
        if (trackPublication.track) {
            trackSubscribed(trackPublication.track);
        }
        // Otherwise listen for the track to be subscribed to, then add it to the
        // page
        trackPublication.on("subscribed", trackSubscribed);
        trackPublication.on('unsubscribed', () => {
            if (el.querySelector('.participant-media').querySelector('video')) {
                el.querySelector('.participant-media').querySelector('video').remove();
            }
            el.querySelector('.participant-media').appendChild(getUiImage(participant.identity));
            /* Hide the associated <video> element and show an avatar image. */
        });
    }

    function participantDisconnected(participant) {
        participant.removeAllListeners();
        const el = document.getElementById(participant.identity);
        el.remove();
    }

    function trackUnpublished(trackPublication) {
        trackPublication.track.detach().forEach(function (mediaElement) {
            mediaElement.remove();
        });
    }

    let meMute = false;
    document.getElementById("me-mic").addEventListener("click", function () {
        meMute = !meMute;
        console.log({activeRoom})
        if (meMute) {
            activeRoom.localParticipant.audioTracks.forEach(publication => {
                publication.track.disable();
            });
            this.querySelector("i").classList.add('fa-microphone-slash');
            this.querySelector("i").classList.remove('fa-microphone');
        } else {
            activeRoom.localParticipant.audioTracks.forEach(publication => {
                publication.track.enable();
            });
            this.querySelector("i").classList.add('fa-microphone')
            this.querySelector("i").classList.remove('fa-microphone-slash');
        }
    });
    let meCam = false;
    document.getElementById("me-cam").addEventListener("click", function () {
        meCam = !meCam;
        if (meCam) {
            activeRoom.localParticipant.videoTracks.forEach(publication => {
                publication.track.stop();
                publication.unpublish();
                publication.track.disable();
            });
            this.querySelector("i").classList.add('fa-video-slash');
            this.querySelector("i").classList.remove('fa-video');
        } else {
            Twilio.Video.createLocalVideoTrack().then(localVideoTrack => {
                return activeRoom.localParticipant.publishTrack(localVideoTrack);
            }).then(publication => {
                publication.track.disable();
                publication.track.enable();
                console.log('Successfully unmounted your video:', publication);
            });
            this.querySelector("i").classList.add('fa-video');
            this.querySelector("i").classList.remove('fa-video-slash')
        }
    });
    document.getElementById('button-leave').addEventListener("click", function () {
        tidyUp(activeRoom);
        location.href = '/';
    });

    function tidyUp(room) {
        return function (event) {
            if (event.persisted) {
                return;
            }
            if (room) {
                room.disconnect();
                room = null;
            }
        };
    }

    let remoteBox = ` <div class="rounded-xl border-white border-4 w-36 h-36 bg-red-100 relative ml-auto mb-5">
                    <span class="participant-media"></span>
                    <span class="participant-name text-sm text-white absolute bottom-0 pl-2 pb-1">Devi</span>
                    <span
                        class="hidden participant-audio flex items-center justify-center absolute -right-4 bottom-0 rounded-full text-white bg-red-600 w-8 h-8">
                          <i class="fas fa-microphone-slash font-sm"></i>
                  </span>
                </div>`;

    const getUiImage = (name) => {
        let ele = document.createElement('img');
        ele.src = `https://ui-avatars.com/api/?name=${name}`;
        ele.alt = "";
        return ele;
    }
    const isLocalStream = (id) => {
        return id === identity;
    }


</script>
