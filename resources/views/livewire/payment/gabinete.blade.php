<div>


    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="grid grid-cols-3 gap-2 p-5">
        @dd($gabinetes)
        @foreach($gabinetes as $gabinete)
            <a href="{{ route('pricing.index',$gabinete->id) }}"
               class="flex flex-col bg-white rounded-lg border shadow-md md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                <div class="flex flex-col   p-4 w-full leading-normal">
                    <div class="flex justify-between text-slate-900">
                        <div class="">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $gabinete->name }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $gabinete->legal_name }}</p>
                        </div>
                        <div >
                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-ping h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>


                    @if($gabinete->currentSubscription())
                        <div class="flex justify-between w-full gap-3 py-2">
                            <div class="box w-full	">
                                <div class="border w-full rounded-md p-4">
                                    <h5 class="text-gray-900  text-center text-xl font-medium mb-2">Subscription
                                        Details</h5>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">Plan</p>
                                        <p>{{ $gabinete->currentSubscription()->plan->name }}
                                            ({{ ucfirst($gabinete->currentSubscription()->renewal_time) }})</p>
                                    </div>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">Start</p>
                                        <p>{{ $gabinete->currentSubscription()->StartDateTime }}</p>
                                    </div>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">Expire</p>
                                        <p>{{ $gabinete->currentSubscription()->ExpirationDateTime }}</p>
                                    </div>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">{{__('Hasta')}}</p>
                                        <p>{{ $gabinete->currentSubscription()->expedients }} {{__('Hasta')}}</p>
                                    </div>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">{{__('Usuarios')}}</p>
                                        <p>{{$gabinete->currentSubscription()->users}}</p>
                                    </div>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">{{__('Minutes')}}</p>
                                        <p>{{$gabinete->currentSubscription()->video_minutes}} {{__('Minutes')}}</p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @else
                        <div class="flex justify-between w-full gap-3 py-2">
                            <div class="box w-full	">
                                <div class="border w-full rounded-md p-4">
                                    <h5 class="text-gray-900  text-center text-xl font-medium mb-2">Not Subscribed
                                    </h5>
                                </div>
                            </div>

                        </div>
                    @endif

                </div>
            </a>
        @endforeach
    </div>
</div>
