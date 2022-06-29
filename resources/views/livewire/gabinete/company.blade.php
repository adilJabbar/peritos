<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('gabinete.show', ['gabinete' => 0]) }}">{{__('Gabinete')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('gabinete.show', ['gabinete' => 0]) }}?showSubmenu={{$gabinete->id}}Gabinete" >{{ $gabinete->name }}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('gabinete.show', ['gabinete' => 0]) }}?showSubmenu={{$gabinete->id}}Companies" >{{ __('Compañías') }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($company->name) }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>


    <div class="space-y-4">
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    <strong>{{$gabinete->name}}</strong> · {{$company->name}}
                </h3>
            </x-card.header>
        </x-card.card>

        <div class="grid grid-cols-2 gap-4">
            <x-card.card class="divide-gray-200 divide-y" x-data="{showAdd: false}">
                <x-card.header>
                    <h3>{{__('Tramitadores')}}</h3>
                    <x-button.primary size="xs" x-on:click="showAdd = !showAdd" >
                        <span x-show="!showAdd"><x-icon.plus size="4" /></span>
                        <span x-show="showAdd"><x-icon.minus size="4" /></span>
                    </x-button.primary>
                </x-card.header>
                <x-card.body>
                    <ul role="list" class="divide-y divide-gray-200">
                        @forelse($gabinete->agents->where('company_id', $company->id)->sortBy('name') as $rowAgent)
                            <li class="py-2 flex justify-between">
                                <div class="flex-shrink-0">
                                        <p class="font-medium text-gray-900">{{$rowAgent->name}}</p>
                                        <div class="flex text-sm text-gray-500 space-x-4">
                                            @if($rowAgent->phone || $rowAgent->phone2)
                                                <div class="flex space-x-2">
                                                    <x-icon.phone size="4" />
                                                    {!! '<a href="tel:' . $rowAgent->phone . '">' . $rowAgent->phone . '</a>' !!}
                                                    {!! '<a href="tel:' . $rowAgent->phone2 . '">' . $rowAgent->phone2 . '</a>' !!}
                                                </div>
                                            @endif
                                            @if($rowAgent->email)
                                                <div class="flex space-x-2">
                                                    <x-icon.mail size="4" />
                                                    {!! '<a href="mailto:' . $rowAgent->email . '">' . $rowAgent->email . '</a>' !!}
                                                </div>
                                            @endif


                                        </div>
                                </div>
                                <div>
                                    <x-button.danger wire:click="removeAgent({{$rowAgent->id}})" size="xs"><x-icon.trash size="5" /></x-button.danger>
                                </div>
{{--                                <div class="flex flex-grow text-gray-500 text-sm">--}}
{{--                                    <span>{{$company->products->where('ramo_id', $rowRamo->id)->pluck('name')->implode(' · ')}}</span>--}}
{{--                                </div>--}}
{{--                                <div class="right flex-shrink-0">--}}
{{--                                    <x-button.danger wire:click="removeRamo({{$rowRamo->id}})" size="xs"><x-icon.trash /></x-button.danger>--}}
{{--                                </div>--}}
                            </li>
                        @empty
                        @endforelse
                    </ul>
                    <div x-show="showAdd"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0">
                        <div>
                            @if($company->agents->whereNotIn('id', $gabinete->agents->pluck('id'))->count() > 0)
                            <x-input.group for="existent-agent" label="Ya existentes" :error="$errors->first('existentAgent')">
                                <x-input.select wire:model.lazy="existentAgent" id="existent-agent" placeholder="Selecciona otro tramitador de {{$company->name}}">
                                    @foreach($company->agents->whereNotIn('id', $gabinete->agents->pluck('id')) as $rowExistentAgent)
                                        <option value="{{$rowExistentAgent->id}}">{{$rowExistentAgent->name}}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                            @endif
                        </div>
                        <div>
                            <x-input.group for="agent-name" label="Nombre" :error="$errors->first('agent.name')">
                                <x-input.text wire:model.lazy="agent.name" id="agent-name" placeholder="Nombre del tramitador" :error="$errors->first('agent.name')" />
                            </x-input.group>
                            <x-input.group for="agent-phone" label="Teléfono 1" :error="$errors->first('agent.phone')" borderless>
                                <x-input.text wire:model.lazy="agent.phone" id="agent-phone" placeholder="Teléfono 1" :error="$errors->first('agent.phone')" />
                            </x-input.group>
                            <x-input.group for="agent-phone2" label="Teléfono 2" :error="$errors->first('agent.phone2')" borderless>
                                <x-input.text wire:model.lazy="agent.phone2" id="agent-phone2" placeholder="Teléfono 2" :error="$errors->first('agent.phone2')" />
                            </x-input.group>
                            <x-input.group for="agent-email" label="email" :error="$errors->first('agent.email')" borderless>
                                <x-input.text wire:model.lazy="agent.email" id="agent-email" placeholder="email" :error="$errors->first('agent.email')" />
                            </x-input.group>
                        </div>
                        <div class="flex justify-end">
                            <x-button.primary wire:click="addAgent" size="xs">{{__('Añadir tramitador')}}</x-button.primary>
                        </div>
                    </div>
                </x-card.body>
            </x-card.card>
            <x-card.card class="divide-gray-200 divide-y">
                <x-card.header>
                    <h3>{{__('Asignaciones automáticas')}}</h3>
                </x-card.header>
                <x-card.body>

                    <x-input.group for="default-backoffice-user" label="Nuevos expedientes" :error="$errors->first('company.pivot.default_assign_user')" borderless>
                        <x-input.select wire:model.lazy="company.pivot.default_assign_user" id="default-assign-user" placeholder="Selecciona un compañero...">
                            @forelse($gabinete->users as $userRow)
                                <option value="{{$userRow->id}}">{{$userRow->full_name}}</option>
                            @empty
                                <option disabled>{{__('No hay ningún empleado de :Gabinete disponbile', ['gabinete' => $gabinete->name])}}</option>
                            @endforelse
                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="default-backoffice-user" label="Backoffice" :error="$errors->first('company.pivot.default_backoffice_user')" borderless>
                        <x-input.select wire:model.lazy="company.pivot.default_backoffice_user" id="default-backoffice-user" placeholder="Selecciona un compañero...">
                            @forelse($gabinete->users as $userRow)
                                <option value="{{$userRow->id}}">{{$userRow->full_name}}</option>
                            @empty
                                <option disabled>{{__('No hay ningún empleado de :Gabinete disponbile', ['gabinete' => $gabinete->name])}}</option>
                            @endforelse
                        </x-input.select>
                    </x-input.group>
                </x-card.body>
            </x-card.card>

        </div>

            {{--                <div>--}}
            {{--                    <x-input.group for="add-gabinete" label="Añadir gabinete">--}}
            {{--                        <x-input.select wire:model="addGabinete" id="add-gabinete" placeholder="Selecciona un gabinete">--}}
            {{--                            @forelse($gabinetes->whereNotIn('id', $company->gabinetes->pluck('id')) as $newGabinete)--}}
            {{--                                <option value="{{ $newGabinete->id }}">{{ $newGabinete->name }}</option>--}}
            {{--                            @empty--}}
            {{--                                <option disabled>{{__('No hay más gabinetes que no trabajen con')}} {{__($company->name)}}</option>--}}
            {{--                            @endforelse--}}
            {{--                        </x-input.select>--}}
            {{--                    </x-input.group>--}}
            {{--                </div>--}}

    </div>
</div>
