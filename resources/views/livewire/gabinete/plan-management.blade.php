<x-card.card class="divide-y divide-gray-200">
    <x-card.header>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            <strong>{{$gabinete->name}}</strong> · {{__('Plan actual')}}
        </h3>
    </x-card.header>
    <x-table.table>
        <x-slot name="head">
            <x-table.heading>{{__('Document Type')}}</x-table.heading>
            <x-table.heading>{{__('Document selected')}}</x-table.heading>
        </x-slot>
        <x-slot name="body">
            {{--                    @dd($reportsOptions)--}}
{{--            @foreach($reportsOptions->unique('type') as $reportOption)--}}
{{--                <x-table.row>--}}
{{--                    <x-table.cell>{{__($reportOption->type)}}</x-table.cell>--}}
{{--                    <x-table.cell>--}}
{{--                        <x-input.select wire:model="gabinete.{{$reportOption->type}}_id" placeholder="Select your {{$reportOption->type}}">--}}
{{--                            @foreach($reportsOptions->where('type', $reportOption->type) as $selectOption)--}}
{{--                                <option value="{{$selectOption->id}}">{{$selectOption->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </x-input.select>--}}
{{--                    </x-table.cell>--}}
{{--                </x-table.row>--}}
{{--            @endforeach--}}

        </x-slot>
    </x-table.table>

    <div class="space-y-4">
        <style>
            /* Toggle A */
            input:checked ~ .dot {
                transform: translateX(100%);
                background-color: #48bb78;
            }

        </style>
        <section class="flex flex-col  antialiased bg-gray-100 text-gray-600 min-h-screen p-4">
            <div class="h-full">
                <!-- Pricing -->
                <div class="max-w-7xl mx-auto" x-data="{ annual: {{ ($is_monthly == 1 ? "false" : "true") }} }">
                    <h2 class="text-3xl text-gray-800 font-bold text-center mb-4">{{__('Planes disponibles')}}</h2>
                    <!-- Toggle switch -->
                    <div class="flex justify-center">
                        <div class="flex items-center space-x-3 mb-8">


                            <label for="toogleA" class="flex items-center cursor-pointer space-x-4 {{ $currntSubscription && $currntSubscription->contract_length == "yearly" ? "cursor-not-allowed	" :"" }}">
                                <div class="text-sm text-gray-500 font-medium min-w-[120px] text-right">{{ __('Planes mensuales') }}</div>
                                <!-- toggle -->
                                <div class="relative">
                                    <!-- input -->
                                    <input id="toogleA" type="checkbox" class="sr-only" wire:change="changePlan()"
                                           {{ $currntSubscription && $currntSubscription->contract_length == "yearly" ? "disabled  wire:click=\"changePlan('disabled')\"" :"" }}

                                           x-model="annual"/>
                                    <!-- line -->
                                    <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                    <!-- dot -->
                                    <div
                                        class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                                </div>
                                <!-- label -->
                                <div class="text-sm text-gray-500 font-medium min-w-[120px]">
                                    {{ __('Planes anuales') }}
                                </div>
                            </label>
                        </div>
                    </div>
                    <!-- Pricing tabs -->
                    <div class="grid grid-cols-12 gap-6">
                        <!-- Tab 1 -->
                        @foreach($packages as $k=>$price)

                            <div
                                class="relative col-span-full md:col-span-3 bg-white shadow-md rounded-sm border border-gray-200 {{ $currntSubscription && $currntSubscription->package_id == $price->id ? "cursor-not-allowed" : "" }}    ">
                                <div class="absolute top-0 left-0 right-0 h-0.5 bg-yellow-600 " aria-hidden="true"></div>
                                <div class="px-5 pt-5 pb-6 border-b border-gray-200">
                                    <header class="flex items-center mb-2">

                                        <h3 class="text-lg text-gray-800 font-semibold">{{__($price->name)}}</h3>
                                    </header>
                                    <!-- Price -->
                                    <div class="text-gray-800 font-bold mb-4">

                                        @if($currntSubscription)
                                            @php
                                                $new_month_amount=  plan_amount_calculate($price->usd_month,$price->plan_days['month'],$currntSubscription->usd_renewal ?? 0 ,$currntSubscription->use_plan_days ?? 0,$currntSubscription->plan_days ?? 0);
                                               // $new_month_amount= $new_month_amount + uses_amount_calculate($uses,'user',$price->usd_user, $price->users) + uses_amount_calculate($uses,'expedient',$price->usd_user, $price->users);

                                                $new_yearly_amount=  plan_amount_calculate($price->usd_year,$price->plan_days['year'],$currntSubscription->usd_renewal ?? 0 ,$currntSubscription->use_plan_days ?? 0,$currntSubscription->plan_days ?? 0) ;
                                            //  $new_yearly_amount=$new_yearly_amount + uses_amount_calculate($uses,'user',$price->usd_user, $price->users) + uses_amount_calculate($uses,'expedient',$price->usd_user, $price->users *12)

                                            @endphp

                                            @if( $is_monthly == 1)

                                                @if($currntSubscription->contract_length == "monthly" )
                                                    @if( $currntSubscription->package_id == $price->id)
                                                        <span class="text-2xl"></span><span
                                                            class="text-3xl">{{money_format_360($price->usd_month, $money_format, 0, true) }}</span>
                                                        <span
                                                            class="text-gray-500 font-medium text-sm">{{__('mensual')}}</span>
                                                    @elseif($new_month_amount < 0)
                                                        <p><span

                                                                class="text-3xl">{{ money_format_360($price->usd_month, $money_format, 0, true) }}</span>
                                                            <span
                                                                class="text-gray-500 font-medium text-sm">{{__('mensual')}}</span>
                                                        </p>
                                                    @else
{{--                                                        <span class="text-gray-500 font-medium text-sm">{{__('Un pago de')}} </span>--}}
                                                        <span class="text-3xl">{{money_format_360($new_month_amount, $money_format, 0, true) }}</span>

                                                        <span class="text-gray-500 font-medium text-sm">({{__('luego')}} <span class="text-lg">{{ money_format_360($price->usd_month, $money_format, 0, true) }}</span>/{{__('mes')}})</span>
                                                    @endif
                                                @else
                                                    <span class="text-2xl"></span><span
                                                        class="text-3xl">{{money_format_360($price->usd_month, $money_format, 0, true) }}</span>
                                                    <span
                                                        class="text-gray-500 font-medium text-sm">{{__('mensual')}}</span>
                                                @endif
                                            @else

                                                @if($currntSubscription->contract_length != "monthly" )
                                                    @if($currntSubscription->package_id == $price->id )
                                                        <span class="text-2xl"></span><span
                                                            class="text-3xl">{{money_format_360($price->usd_year, $money_format, 0, true) }}</span>
                                                        <span
                                                            class="text-gray-500 font-medium text-sm">{{__('anual')}}</span>
                                                    @elseif($new_yearly_amount < 0)
                                                        <p><span

                                                                class="text-3xl">{{ money_format_360($price->usd_year, $money_format, 0, true) }}</span>
                                                            <span
                                                                class="text-gray-500 font-medium text-sm">{{__('mensual')}}</span>
                                                        </p>
                                                    @else
                                                        <p><span

                                                                class="text-xl line-through">{{ money_format_360($price->usd_year, $money_format, 0, true) }}</span>
                                                            <span
                                                                class="text-gray-500 font-medium text-sm">{{__('anual')}}</span>
                                                        </p>
                                                        <span class="text-2xl"></span><span
                                                            class="text-3xl">{{money_format_360($new_yearly_amount, $money_format, 0, true) }}</span>
                                                        <span
                                                            class="text-gray-500 font-medium text-sm">{{__('anual')}}</span>
                                                    @endif
                                                @else

                                                    @if($currntSubscription->transaction->package_amount == $price->usd_year )
                                                        <span class="text-2xl"></span><span
                                                            class="text-3xl">{{money_format_360($price->usd_year, $money_format, 0, true) }}</span>
                                                        <span
                                                            class="text-gray-500 font-medium text-sm">{{__('anual')}}</span>
                                                    @elseif($new_yearly_amount < 0)
                                                        <span class="text-3xl">{{ money_format_360($price->usd_year, $money_format, 0, true)  }}</span>
                                                        <span class="text-gray-500 font-medium text-sm">{{ __('anual') }}</span>
                                                    @else
                                                        <span class="text-3xl">{{money_format_360($new_yearly_amount, $money_format, 0, true) }}</span>

                                                        <span class="text-gray-500 font-medium text-sm">({{__('luego')}} <span class="text-lg">{{ money_format_360($price->usd_year, $money_format, 0, true) }}</span>/{{__('anual')}})</span>

                                                    @endif
                                                @endif

                                            @endif

                                        @else
                                            <span class="text-2xl"></span><span class="text-3xl"
                                                                                x-text="annual ? '{{ money_format_360($price->usd_year, $money_format, 0, true)  }}' : '{{money_format_360($price->usd_month, $money_format, 0, true) }}'"> </span>
                                            <span
                                                class="text-gray-500 font-medium text-sm"
                                                x-text="annual ? '{{ __('anual') }}' : '{{__('mensual')}}'"></span>
                                        @endif
                                    </div>
                                    <!-- CTA -->
                                    @if($currntSubscription  )
                                        @if( $is_monthly == 1)

                                            @if($currntSubscription->contract_length == "monthly" )
                                                @if( $currntSubscription->package_id == $price->id )
                                                    <button
                                                        class="font-medium text-sm cursor-not-allowed	 inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  border-yellow-600 text-yellow-600  text-gray-600 w-full">
                                                        {{ __('Plan Activo') }}
                                                    </button>
                                                @elseif($currntSubscription->usd_renewal < $price->usd_month )
                                                    <button wire:click="selectPlan({{ $price->id }})"
                                                            class="font-medium text-sm inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  hover:border-yellow-600 hover:text-yellow-600  text-gray-600 w-full">
                                                        {{__('upgrade') }}
                                                    </button>
                                                @else
                                                    {{--                                                {{ $currntSubscription }} - {{ $price->usd_month }}--}}
                                                    <button wire:click="selectPlan({{ $price->id }})"
                                                            class="font-medium text-sm inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  hover:border-yellow-600 hover:text-yellow-600  text-gray-600 w-full">
                                                        {{__('Downgrade') }}
                                                    </button>
                                                @endif
                                            @endif
                                        @else
                                            @if($currntSubscription->contract_length != "monthly" )
                                                @if($currntSubscription->package_id == $price->id)
                                                    <button
                                                        class="font-medium text-sm cursor-not-allowed	 inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  border-yellow-600 text-yellow-600  text-gray-600 w-full">
                                                        {{ __('Plan Activo') }}
                                                    </button>
                                                @elseif($currntSubscription->transaction->package_amount < $price->usd_year )
                                                    <button wire:click="selectPlan({{ $price->id }})"
                                                            class="font-medium text-sm inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  hover:border-yellow-600 hover:text-yellow-600  text-gray-600 w-full">
                                                        {{__('upgrade') }}
                                                    </button>
                                                @else
                                                    <button wire:click="selectPlan({{ $price->id }})"
                                                            class="font-medium text-sm inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  hover:border-yellow-600 hover:text-yellow-600  text-gray-600 w-full">
                                                        {{__('Downgrade') }}
                                                    </button>
                                                @endif
                                            @elseif($currntSubscription->transaction->package_amount != $price->usd_year)

                                                <button wire:click="selectPlan({{ $price->id }})"
                                                        class="font-medium text-sm inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  hover:border-yellow-600 hover:text-yellow-600  text-gray-600 w-full">
                                                    {{__('upgrade') }}
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        <button wire:click="selectPlan({{ $price->id }})"
                                                class="font-medium text-sm inline-flex items-center justify-center px-3 py-2 border border-gray-200 rounded leading-5 shadow-sm transition duration-150 ease-in-out focus:outline-none focus-visible:ring-2  hover:border-yellow-600 hover:text-yellow-600  text-gray-600 w-full">

                                            {{__('Seleccionar') }}
                                        </button>
                                    @endif
                                </div>
                                <div class="px-5 pt-4 pb-5">

                                    <!-- List -->
                                    <ul>
                                        <li class="flex items-center py-1">
                                            <svg class="w-3 h-3 flex-shrink-0 fill-current text-green-500 mr-2"
                                                 viewBox="0 0 12 12">
                                                <path
                                                    d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                            </svg>
                                            <div class="text-sm"

                                            >{{__('Hasta')}} <span
                                                    x-text="annual ? '{{$price->expedients  * 12 }} {{__('exp/año')}}' : '{{$price->expedients}} {{__('exp/mes')}}'"></span>
                                            </div>
                                        </li>
                                        <li class="flex items-center py-1">
                                            <svg class="w-3 h-3 flex-shrink-0 fill-current text-green-500 mr-2"
                                                 viewBox="0 0 12 12">
                                                <path
                                                    d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                            </svg>
                                            <div class="text-sm">{{$price->users}} {{__('Usuarios')}}</div>
                                        </li>
                                        <li class="flex items-center py-1">
                                            <svg class="w-3 h-3 flex-shrink-0 fill-current text-green-500 mr-2"
                                                 viewBox="0 0 12 12">
                                                <path
                                                    d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                            </svg>
                                            <div class="text-sm"
                                                 x-text="annual ? '{{$price->video_minutes  * 12 }}' : '{{$price->video_minutes}}'">{{__('Minutes')}}</div>
                                        </li>
                                        <li class="flex items-center py-1">
                                            <svg class="w-3 h-3 flex-shrink-0 fill-current text-green-500 mr-2"
                                                 viewBox="0 0 12 12">
                                                <path
                                                    d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                            </svg>
                                            <div class="text-sm">{{__('Soporte Técnico')}}</div>
                                        </li>

                                        <li class="flex items-center py-1">

                                            <svg class="w-3 h-3 flex-shrink-0 fill-current text-green-500 mr-2"
                                                 viewBox="0 0 12 12">
                                                <path
                                                    d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                            </svg>
                                            <div class="text-sm"> <span
                                                    x-text="annual ? '{{ money_format_360($price->usd_expedient - ($price->yearly_discount * $price->usd_expedient / 100), $money_format, null, true) }}' : '{{ money_format_360($price->usd_expedient, $money_format, null, true)}}'"></span>
                                                {{__('exp/extra')}}
                                            </div>
                                        </li>
                                        <li class="flex items-center py-1">

                                            <svg class="w-3 h-3 flex-shrink-0 fill-current text-green-500 mr-2"
                                                 viewBox="0 0 12 12">
                                                <path
                                                    d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                            </svg>
                                            <div class="text-sm"> <span
                                                    x-text="annual ? ' {{ money_format_360($price->usd_user - ($price->yearly_discount * $price->usd_user / 100), $money_format, null, true)}}' : ' {{ money_format_360($price->usd_user, $money_format, null, true)}}'"></span>
                                                {{__('usuario/extra')}}
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>




</x-card.card>
