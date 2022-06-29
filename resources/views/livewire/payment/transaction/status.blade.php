<div>
    <style>
        .success-animation {
            margin: 20px auto;
        }

        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #047857;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px #4bb71b;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            position: relative;
            top: 5px;
            right: 5px;
            margin: 0 auto;
        }

        #Layer_1 {
            width: 80px;
            height: 80px;

        }

        #path {
            stroke-dasharray: 200;
            stroke-dashoffset: 400;

            animation: checker 2.8s linear;
            animation-fill-mode: forwards;
        }

        @keyframes checker {
            from {
                stroke-dashoffset: 320;
            }
            to {
                stroke-dashoffset: 400;
            }
        }


        #path2 {
            stroke-dasharray: 430;
            stroke-dashoffset: 800;

            animation: x 0.6s linear;
            animation-fill-mode: forwards;
        }

        #path3 {
            stroke-dasharray: 430;
            stroke-dashoffset: 800;

            animation: x 0.6s linear;
            animation-fill-mode: forwards;
            animation-delay: 0.3s;
        }

        @keyframes x {
            from {
                stroke-dasharray: 430;
            }
            to {
                stroke-dasharray: 400;
            }
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #047857;
            fill: #fff;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;

        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {
            0%, 100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #047857;
            }
        }
    </style>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="mt-12 m-auto -space-y-4 items-center justify-center md:flex md:space-y-0 md:-space-x-4 xl:w-10/12">

        <div class="relative group md:w-4/12 lg:w-5/12">
            <div aria-hidden="true"
                 class="absolute top-0 w-full h-full rounded-2xl bg-white shadow-lg transition duration-500 group-hover:scale-105"></div>
            @isset($payment)
                <div class="relative p-6 pt-16 md:p-8 md:pl-12 md:rounded-r-2xl lg:pl-20 lg:p-16">
                    <div class="border-solid border-b	pb-2	 border-gray-300">
                        <h1 class="text-4xl text-center	 text-green-700	">Payment Successful!</h1>
                        <div class="success-animation">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex justify-between w-full gap-3 py-4">
                        <div class="box w-full	">
                            <div class="border rounded-md p-4">
                                <h5 class="text-gray-900  text-center text-xl font-medium mb-2">Transaction Details</h5>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">Transaction</p>
                                    <p>{{ $transaction->session_id }}</p>
                                </div>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">Time</p>
                                    <p>{{ $transaction->PurchaseDateTime }}</p>
                                </div>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">Amount</p>
                                    <p>{{ money_format_360($transaction->usd_renewal, $money_format, 0, true)  }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-between w-full gap-3 py-2">
                        <div class="box w-full	">
                            <div class="border rounded-md p-4">
                                <h5 class="text-gray-900  text-center text-xl font-medium mb-2">Subscription
                                    Details</h5>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">Plan</p>
                                    <p>{{ $transaction->plan->name }}({{ ucfirst($transaction->renewal_time) }})</p>
                                </div>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">Start</p>
                                    <p>{{ $transaction->PurchaseDateTime }}</p>
                                </div>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">Expire</p>
                                    <p>{{ $payment->ExpirationDateTime }}</p>
                                </div>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">{{__('Hasta')}}</p>
                                    <p>{{ $payment->expedients }} {{__('Hasta')}}</p>
                                </div>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">{{__('Usuarios')}}</p>
                                    <p>{{$payment->users}}</p>
                                </div>
                                <div class="flex justify-between text-slate-900">
                                    <p class="capitalize font-medium">{{__('Minutes')}}</p>
                                    <p>{{$payment->video_minutes}} {{__('Minutes')}}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-center w-full gap-3 py-4">
                        <a href="{{ route('gabinete.contact.index') }}"
                           class="bg-transparent w-2/5 text-center hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded">
                            Back
                        </a>
                    </div>
                </div>
            @else
                <div class="relative p-6 pt-16 md:p-8 md:pl-12 md:rounded-r-2xl lg:pl-20 lg:p-16">
                    <div class="border-solid border-b	pb-2	 border-gray-300">
                        <h1 class="text-4xl text-center	 text-red-700	">Op's, Transaction failed!</h1>

                        <div class="success-animation">
                            <svg class="mx-auto m-3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50"
                                 xml:space="preserve">
                            <g id="Layer_3">
                                <line id="path2" fill="none" stroke="#bb1c1c" stroke-width="3"
                                      stroke-miterlimit="10" x1="8.5" y1="41.5" x2="41.5"
                                      y2="8.5"/>
                                <line id="path3" fill="none" stroke="#bb1c1c" stroke-width="3"
                                      stroke-miterlimit="10" x1="41.5" y1="41.5" x2="8.5"
                                      y2="8.5"/>
                            </g>
                                </svg>
                        </div>
                    </div>

                    @if($transaction)
                        <div class="flex justify-between w-full gap-3 py-4">
                            <div class="box w-full	">
                                <div class="border rounded-md p-4">
                                    <h5 class="text-gray-900  text-center text-xl font-medium mb-2">Transaction
                                        Details</h5>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">Transaction</p>
                                        <p>{{ $transaction->session_id }}</p>
                                    </div>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">Time</p>
                                        <p>{{ $transaction->PurchaseDateTime }}</p>
                                    </div>
                                    <div class="flex justify-between text-slate-900">
                                        <p class="capitalize font-medium">Amount</p>
                                        <p>{{ money_format_360($transaction->usd_renewal, $money_format, 0, true)  }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @else
                    @endif

                    <div class="flex justify-center w-full gap-3 py-4">
                        <a href="{{ route('gabinete.contact.index') }}"
                           class="bg-transparent w-2/5 text-center hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded">
                            Back
                        </a>
                    </div>
                </div>

            @endif
        </div>
    </div>
</div>
