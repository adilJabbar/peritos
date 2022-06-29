<div class="space-y-4">
    <x-card.card  class="divide-gray-200 divide-y">
        <x-card.header>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                <strong>{{$gabinete->name}}</strong> · {{ $company->name }}
            </h3>
    {{--        <div class="flex-shrink-0">--}}
    {{--            <x-button.primary @click="showAddCompany = !showAddCompany"><x-icon.plus size="4" /></x-button.primary>--}}
    {{--        </div>--}}
        </x-card.header>
        <x-card.body>
            <x-input.group for="default-assigned-user" label="Assign to" :error="$errors->first('defaultAssignUser')" borderless>
                <x-input.select id="default-assigned-user" wire:model.lazy="defaultAssignUser" :error="$errors->first('defaultAssignUser')" placeholder="Selecciona el usuario al que se le asignará por defecto">
                    @foreach($gabinete->users->sortBy('name') as $userOption)
                        <option value="{{$userOption->id}}">{{__($userOption->full_name)}}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>

            <x-input.group for="default-backoffice" label="Backoffice" :error="$errors->first('defaultBackoffice')" borderless>
                <x-input.select id="default-backoffice" wire:model.lazy="defaultBackoffice" :error="$errors->first('defaultBackoffice')" placeholder="Selecciona el backoffice por defecto para esta compañía">
                    @foreach($gabinete->backoffices()->sortBy('name') as $userOption)
                        <option value="{{$userOption->id}}">{{__($userOption->full_name)}}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>
        </x-card.body>
    </x-card.card>

    <div x-data="{showAddAgent : @entangle('showAddAgent')}">
        <x-card.card  class="divide-gray-200 divide-y">
            <x-card.header>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('Tramitadores') }}
                </h3>
                        <div class="flex-shrink-0">
                            <x-button.primary @click="showAddAgent = !showAddAgent">
                                @if($showAddAgent)
                                    <x-icon.minus size="4" />
                                @else
                                    <x-icon.plus size="4" />
                                @endif
                            </x-button.primary>
                        </div>
            </x-card.header>

            <!-- showAddAgent -->
            <div x-show="showAddAgent" class="p-2" x-transition>
                <x-card.card class="border-2 border-primary">
                    <x-card.body>
                        <x-input.group for="addAgent" label="Tramitador" :error="$errors->first('addAgent')" borderless>
                            <x-input.select id="addAgent" wire:model.lazy="addAgent" :error="$errors->first('addAgent')" placeholder="Selecciona un tramitador de la compañía">
                                @foreach($company->activeAgents()->whereNotIn('id', $gabinete->agents->pluck('id'))->sortBy('name') as $agentOption)
                                    <option value="{{$agentOption->id}}">{{__($agentOption->name)}}</option>
                                @endforeach
                                <option value="notListed">{{__('El tramitador no está en la lista')}}</option>
                            </x-input.select>
                        </x-input.group>
                        <div>
                            @if($showNewAgent)
                                <x-input.group label="Name" for="newAgent-name" :error="$errors->first('newAgent.name')" borderless>
                                    <x-input.text wire:model.lazy="newAgent.name" id="newAgent-name" placeholder="Name" :error="$errors->first('newAgent.name')" />
                                </x-input.group>
                                <x-input.group label="Phone" for="phone" :error="$errors->first('newAgent.phone')" borderless>
                                    <x-input.text wire:model.lazy="newAgent.phone" id="newAgent-phone" placeholder="Phone" :error="$errors->first('newAgent.phone')" />
                                </x-input.group>
                                <x-input.group label="Phone" for="phone2" :error="$errors->first('newAgent.phone2')" borderless>
                                    <x-input.text wire:model.lazy="newAgent.phone2" id="newAgent-phone2" placeholder="Another phone" :error="$errors->first('newAgent.phone2')" />
                                </x-input.group>
                                <x-input.group label="email" for="email" :error="$errors->first('newAgent.email')" borderless>
                                    <x-input.text wire:model.lazy="newAgent.email" id="newAgent-email" placeholder="email address" :error="$errors->first('newAgent.email')" />
                                </x-input.group>

                            @endif
                            <div class="flex justify-end">
                                <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
                            </div>

                        </div>
                    </x-card.body>
                </x-card.card>
            </div>

            <!-- agents table -->
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Name')}}</x-table.heading>
                    <x-table.heading>{{__('Phone')}}</x-table.heading>
                    <x-table.heading>{{__('Phone 2')}}</x-table.heading>
                    <x-table.heading>{{__('email')}}</x-table.heading>
                    <x-table.heading class="w-0"></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($gabinete->activeAgents()->where('company_id', $company->id) as $agentRow)
                        <x-table.row>
                            <x-table.cell>{{ $agentRow->name }}</x-table.cell>
                            <x-table.cell class="text-center">
                                <a href="tel:{{ $agentRow->phone }}">{{ $agentRow->phone }}</a>
                            </x-table.cell>
                            <x-table.cell class="text-center">
                                <a href="tel:{{ $agentRow->phone2 }}">{{ $agentRow->phone2 }}</a>
                            </x-table.cell>
                            <x-table.cell class="text-center">
                                <a href="mailto:{{ $agentRow->email }}">{{ $agentRow->email }}</a>
                            </x-table.cell>
                            <x-table.cell>
                                <x-button.danger wire:click="delete({{$agentRow->id}})" size="sm"><x-icon.trash size="5" /></x-button.danger>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell class="text-center" colspan="5">{{__('No hay ningún tramitador de :company para :gabinete', ['company' => $company->name, 'gabinete' => $gabinete->name])}}</x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table.table>

        </x-card.card>
    </div>
</div>
