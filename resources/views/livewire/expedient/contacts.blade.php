<x-card.card class="divide-gray-200 divide-y" >
    <div x-data="{ showAddContact: @entangle('showNewContact') }" >
        <x-card.header>
            <h3>{{__('Contactos y visitas')}}</h3>
            <x-button.primary x-on:click="showAddContact = ! showAddContact" size="xs">
                <div x-show="!showAddContact"><x-icon.plus /></div>
                <div x-show="showAddContact"><x-icon.minus /></div>
            </x-button.primary>
        </x-card.header>
        <div x-show="showAddContact" class="py-4 px-4">

            <x-card.card class="border-primary border divide-primary divide-y">
                <div class="bg-primary text-white p-2 sm:px-2 flex items-center">
                    {{__('Nuevo contacto o intento de contacto')}}
                </div>
                <x-card.body>

                    <x-input.group for="contact-attempt-time" label="Día y hora"
                                   :error="$errors->first('contactAttempt.time_for_editing')" borderless>
                        <x-input.text wire:model.lazy="contactAttempt.time_for_editing" type="datetime-local"
                                      id="contact-attempt-time"
                                      :error="$errors->first('contactAttempt.time_for_editing')"/>
                    </x-input.group>

                    <x-input.group for="contact-attempt-type" label="Tipo de contacto" :error="$errors->first('contactAttempt.attempt_type')" borderless>
                        <div class="grid {{ $contactAttempt->attempt_value === 'new' ? 'sm:grid-cols-3' : 'sm:grid-cols-2' }} gap-4">
                            <x-input.select wire:model.lazy="contactAttempt.attempt_type" id="contact-attempt-type" :error="$errors->first('contactAttempt.attempt_type')" placeholder="Selecciona el tipo de contacto...">
                                <option value="email">{{__('Correo electrónico')}}</option>
                                <option value="person">{{__('En persona')}}</option>
                                <option value="phone">{{__('Teléfono')}}</option>
                                <option value="other">{{__('Otro')}}</option>
                            </x-input.select>
                            @if($contactAttempt->attempt_type === 'other')
                                <x-input.text wire:model.lazy="contactAttempt.attempt_value"
                                              id="contactAttempt-attempt_value"
                                              placeholder="Introduce el tipo de contacto realizado"
                                              :error="$errors->first('contactAttempt.attempt_value')"/>
                            @elseif($contactAttempt->attempt_type === 'person')
                                <x-input.text wire:model.lazy="contactAttempt.attempt_value"
                                              id="contactAttempt-attempt_value"
                                              placeholder="Lugar de contacto"
                                              :error="$errors->first('contactAttempt.attempt_value')"/>
                            @elseif($contactAttempt->attempt_type)
                                <x-input.select wire:model="contactAttempt.attempt_value" id="contactAttempt-attempt_value" :placeholder="$contactAttempt->attempt_type === 'phone' ? 'Selecciona el teléfono marcado...' : 'Selecciona el email de destino...'">
                                    @forelse($contactOptions as $key => $optionRow)
                                        <option value="{{$optionRow['value']}}">{{$optionRow['description']}}</option>
                                    @empty
                                    @endforelse
                                        <option value="new">{{__('La opción no está en la lista')}}</option>
                                </x-input.select>
                            @endif
                            @if($contactAttempt->attempt_value === 'new')
                                <x-input.text wire:model.lazy="newValue"
                                              id="newValue"
                                              placeholder="..."
                                              :error="$errors->first('newValue')"/>
                            @endif

                        </div>
                    </x-input.group>

                    <div>
                        @if(($contactAttempt->attempt_value && $contactAttempt->attempt_value !== 'new') || ($contactAttempt->attempt_value === 'new' && $newValue))

                            <x-input.group for="contactAttempt.response" label="Respuesta" :error="$errors->first('contactAttempt.response')" borderless>
                                <x-input.textarea wire:model.lazy="contactAttempt.response" id="contactAttempt.response" size="3" placeholder="Respuesta" :error="$errors->first('contactAttempt.response')" />
                            </x-input.group>

                            <x-input.group for="contactAttempt.comments" label="Comentarios" :error="$errors->first('contactAttempt.comments')" borderless>
                                <x-input.textarea wire:model.lazy="contactAttempt.comments" id="contactAttempt.comments" size="3" placeholder="Comentarios respecto al contacto realizado" :error="$errors->first('contactAttempt.comments')"/>
                            </x-input.group>

                            <x-input.group for="createAppointment" label="Visita concertada" :error="$errors->first('appointment.date_time_for_editing')">
                                <div class="flex space-x-2">
                                    <x-input.checkbox wire:model="createAppointment" class="mt-1" size="7" />
                                    @if($createAppointment)
                                        <x-input.text wire:model.lazy="appointment.date_time_for_editing" id="appointmentDateTimeForEditing" type="datetime-local" :error="$errors->first('appointment.date_time_for_editing')"/>
                                    @endif
                                </div>
                            </x-input.group>

                            <div>
                                @if($createAppointment)
                                    @include('partials.forms.address', ['model' => 'appointment', 'readonly' => false, 'hideAddressName' => true])

                                    <x-input.group for="appointment.technician_id" label="Técnico asignado" :error="$errors->first('appointment.technician_id')" borderless>
                                        <div class="flex space-x-2">
                                            <div class="flex-grow">
                                                <x-input.select wire:model.lazy="appointment.technician_id" id="appointment.technician_id" placeholder="Selecciona el técnico que realizará la visita..." :error="$errors->first('appointment.technician_id')">
                                                    @forelse($expedient->technicians() as $technician)
                                                    <option value="{{ $technician->id }}">
                                                        {{ $technician->isSubcontractor($expedient->gabinete->id) ? $expedient->gabineteOrSubcontractorName() . ' · ' : '' }}
                                                        {{ $technician->full_name }}
                                                    </option>
                                                    @empty
                                                    @endforelse
                                                </x-input.select>
                                            </div>
                                            <div class="flex flex-shrink-0 space-x-2">
                                                <label for="appointment-kms" class="block text-sm font-medium text-gray-700">
                                                    {{__('Kms')}}

                                                </label>
                                                <x-input.text wire:model.lazy="appointment.kms" type="number" step="0" id="appointment-kms" placeholder="Nº Kilometros..." />
                                            </div>
                                        </div>

                                        <div class="pt-2">
                                            <x-input.textarea wire:model.lazy="appointment.comments" id="appointment.comments" size="3"   placeholder="Comentarios para el técnico relativos a la visita" :error="$errors->first('appointment.comments')"/>
                                        </div>


                                    </x-input.group>
                                @endif
                            </div>

                        @endif
                    </div>

                </x-card.body>
                <div>
                    <div class="p-2 bg-primary flex justify-end">
                        <x-button.white x-show="showAddContact" wire:click="createContactAttempt">{{__('Guardar')}}</x-button.white>
                    </div>
                </div>
            </x-card.card>

        </div>
        <x-table.table>
        <x-slot name="head">
            <x-table.heading>{{__('Time')}}</x-table.heading>
            <x-table.heading>{{__('Person')}}</x-table.heading>
            <x-table.heading>{{__('Contact')}}</x-table.heading>
            <x-table.heading>{{__('Comments')}}</x-table.heading>
            <x-table.heading>{{__('Reponse')}}</x-table.heading>
            <x-table.heading>{{__('Visit Scheduled')}}</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @forelse($expedient->contactAttempts as $attemptRow)
                <x-table.row>
                    <x-table.cell>{{ $attemptRow->localize('time')->isoFormat('LLL') }}</x-table.cell>
                    <x-table.cell>{{ $attemptRow->user->full_name }}</x-table.cell>
                    <x-table.cell>
                        <div class="flex space-x-2">
                            <x-dynamic-component :component="'icon.' . $attemptRow->icon" />
                            <span>{{ $attemptRow->attempt_value }}</span>
                        </div>
                    </x-table.cell>
                    <x-table.cell>{{ $attemptRow->comments }}</x-table.cell>
                    <x-table.cell>{{ $attemptRow->response }}</x-table.cell>
                    <x-table.cell>
                        @if($attemptRow->visit)
                            <div class="flex space-x-2">
                                <x-icon.badge-check class="text-green-500" />
                                <div class="flex flex-col">
                                    <span>{{$attemptRow->visit->localize('date_time')->isoFormat('LLL')}}</span>
                                    <span>{{$attemptRow->visit->technician->full_name}}</span>

                                </div>
                            </div>
{{--                        @else--}}
{{--                            <x-icon.ban class="text-red-500" />--}}
                        @endif
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="5" class="text-center">{{__('No hay ningún intento de contacto grabado')}}</x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>
    </div>
</x-card.card>
