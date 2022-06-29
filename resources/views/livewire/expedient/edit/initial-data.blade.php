<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Información de apertura del expediente'" />
    </x-card.card>

    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-4">
        <section aria-labelledby="solicitante">
            <div class="space-y-4">

                <x-card.card>
                    <h2 class="sr-only" id="solicitante">{{__('Solicitante')}}</h2>
                    <x-card.body>
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0 self-center">
                                    <img class="mx-auto {{class_basename($expedient->billable) == 'Person' ? 'rounded-full w-20 ' : ' w-32 '}}"
                                         src="{{ $expedient->icon_url }}"
                                         alt="">
                                </div>
                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    @if(class_basename($expedient->billable) == 'Person')
                                        <p class="text-sm font-medium text-gray-600">{{__('Solicitado por:')}}</p>
                                        <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $expedient->billable->name }}</p>
                                        <p class="text-sm font-medium text-gray-600">{{ $expedient->billable->contacts->pluck('value')->implode(', ') }}</p>
                                    @elseif(class_basename($expedient->billable) == 'Company')
                                        <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $expedient->billable->name }}</p>
                                        <p class="text-sm font-medium text-gray-600">{{ $expedient->agent?->name }}</p>
                                        <p class="text-sm font-medium text-gray-600">{!! implode('<br>', [$expedient->agent?->phone, $expedient->agent?->phone2, $expedient->agent?->email]) !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </x-card.body>

                    <div
                        class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
                        <div class="px-2 py-2 text-sm font-medium text-center">
                            <p class="text-sm font-medium text-gray-600">{{__('F. ocurrencia')}}</p>
                            <span class="text-gray-900">{{$expedient->happened_at_for_humans}}</span>
                        </div>

                        <div class="px-2 py-2 text-sm font-medium text-center bg-{{$expedient->limit_color}}-100">
                            <p class="text-sm font-medium text-{{$expedient->limit_color}}-600">{{__('F. límite')}}</p>
                            <span class="text-{{$expedient->limit_color}}-600">{{$expedient->expires_at_for_humans}}</span>
                        </div>
                    </div>


                </x-card.card>

                <x-card.card>
                    <x-card.body>
                        <div class="text-sm font-medium flex justify-between">
                            <span class="text-sm font-medium text-gray-600">{{ __('Dado de alta por')}}: </span>
                            <span class="text-gray-900">{{$expedient->creator->full_name}}</span>
                        </div>
                        <div class="text-sm font-medium flex justify-between">
                            <span class="text-sm font-medium text-gray-600">{{ __('Solicitado el')}}: </span>
                            <span class="text-gray-900">{{$expedient->requested_at_for_humans}}</span>
                        </div>
                        <div class="text-sm font-medium flex justify-between">
                            <span class="text-sm font-medium text-gray-600">{{ __('Creado el')}}: </span>
                            <span class="text-gray-900">{{$expedient->localize('created_at')->format(auth()->user()->full_date_for_humans_format)}}</span>
                        </div>
                    </x-card.body>
                </x-card.card>

                <x-card.card class="divide-y divide-gray-200">
                    <x-card.header>
                        <span class="font-bold">{{__('Documentos aportados')}}</span>
                    </x-card.header>
                    <x-card.body>
                        <x-input.group label="" for="attachments"  :error="$errors->first('attachments')" :key="'attachments-select'" borderless inline>
                            <div class="space-y-2">
                                @forelse($expedient->attachments as $attachment)
                                    <livewire:form.attachment-row :attachment="$attachment" :key="'attachment' . $attachment->id" />
                                @empty
                                @endforelse
                                <x-input.filepond wire:model="attachments" id="attachments" multiple />
                            </div>
                        </x-input.group>
                    </x-card.body>
                </x-card.card>
{{--                @if($expedient->attachments)--}}
{{--                    @json($expedient->attachments)--}}
{{--                @endif--}}

            </div>

        </section>
        <section class="2xl:col-span-2 ">
            <x-card.card class="divide-y divide-gray-200">
                <x-card.header>
                    <span class="font-bold">{{__('Datos de contacto')}}</span>
                </x-card.header>
                <x-card.body>
                    @include('livewire.expedient.create.contact_person_info')
                </x-card.body>
                @if($person->name || $person->legal_id)
                    <x-card.body>
                        @include('livewire.person.address_data')
                    </x-card.body>
                @endif
                @if($address?->getKey())
                    <x-card.body>
                        @include('livewire.person.contact_data')
                    </x-card.body>
                @endif

                <x-card.body class="flex justify-between space-x-4">
                    <span class="text-sm font-bold">{{__('Descripción')}}</span>
                    <span class="text-sm text-gray-600">{!! $expedient->description !!}</span>
                </x-card.body>
                <x-card.body class="flex justify-between space-x-4">
                    <span class="text-sm font-bold">{{__('Estimación inicial')}}</span>
                    <span class="text-sm text-gray-600">{{ $expedient->first_estimation()->currency_amount }}</span>
                </x-card.body>
            </x-card.card>
        </section>

    </div>


    @include('livewire.form.address-modal')
</div>
