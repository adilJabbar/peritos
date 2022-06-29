<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Gestión del expediente'" />
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.body>
            @if(class_basename($expedient->billable) != 'Company' )
            <x-input.group label="Incluir póliza" for="expedient-requires_policy" :error="$errors->first('expedient.requires_policy')" borderless>
                <x-input.select wire:model="expedient.requires_policy" placeholder="Selecciona..." id="expedient-requires_policy">
                    <option value="1">{{ __('Yes') }}</option>
                    <option value="0">{{ __('No') }}</option>
                </x-input.select>
            </x-input.group>
            @endif
            <x-input.group label="Tipo de expediente" for="expedient-ramo_id" :error="$errors->first('expedient.ramo_id')" borderless>
                <x-input.select wire:model="expedient.ramo_id" placeholder="Selecciona tipo de expediente" id="expedient-ramo_id">
                    @foreach($expedient->country->ramos as $ramo)
                        <option value="{{$ramo->id}}">{{ __($ramo->name) }}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>
            <x-input.group label="Tipología del siniestro" for="expedient-typecases" :error="$errors->first('typecases')" borderless>
{{--                @dd($expedient->ramo)--}}
                <x-input.select wire:model="typecases" size="{{$expedient->ramo->typecases->count()}}" multiple id="expedient-typecases">
                    @foreach($expedient->ramo->typecases as $typecase)
                        <option value="{{$typecase->id}}">{{ __($typecase->name) }}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>

{{--                @json($expedient->adjuster)--}}
            <x-input.group label="Asignado a" for="expedient-adjuster-id" :error="$errors->first('expedient.adjuster_id')">
                <x-input.select wire:model.lazy="expedient.adjuster_id" id="expedient-adjuster-id" placeholder="Selecciona la persona responsable de este expediente...">
                    <option value="{{ $expedient->adjuster_id }}" wire:key="selected-assigned-to">
                        {{ $expedient->adjuster->isSubcontractor($expedient->gabinete->id) ? $expedient->gabineteOrSubcontractorName() . ' · ' : '' }}
                        {{ $expedient->adjuster->full_name }}
                    </option>

                    @can('gabinete.allEmployees')
                        @foreach($employees->where('id', '!=',  $expedient->adjuster_id) as $adjusterRow)
                            <option value="{{ $adjusterRow->id }}" wire:key="newOptionEmployeeTo-{{$adjusterRow->id}}">{{ $adjusterRow->full_name }}</option>
                        @endforeach
                        @foreach($externals->where('id', '!=', $expedient->adjuster_id)->sortBy('pivot.subcontractor_id')->sortBy('name') as $adjusterRow)
                            <option value="{{ $adjusterRow->id }}" wire:key="newOptionExternalTo-{{$adjusterRow->id}}" >{{$adjusterRow->subcontractors->find($adjusterRow->pivot->subcontractor_id)->name}} · {{ $adjusterRow->full_name }}</option>
                        @endforeach
                    @else
                        @if($subcontractor = auth()->user()->isSubcontractor($expedient->gabinete))
                            @foreach($externals->where('id', '!=', $expedient->adjuster_id)->where('pivot.subcontractor_id', $subcontractor)->sortBy('name') as $adjusterRow)
                                <option value="{{ $adjusterRow->id }}" wire:key="newOptionExternalTo-{{$adjusterRow->id}}" >{{$adjusterRow->subcontractors->find($adjusterRow->pivot->subcontractor_id)->name}} · {{ $adjusterRow->full_name }}</option>
                            @endforeach
                        @else
                            @foreach($employees->where('id', '!=',  $expedient->adjuster_id) as $adjusterRow)
                                <option value="{{ $adjusterRow->id }}" wire:key="newOptionEmployeeTo-{{$adjusterRow->id}}">{{ $adjusterRow->full_name }}</option>
                            @endforeach
                        @endif
                    @endcan
                </x-input.select>
            </x-input.group>

            <x-input.group label="Técnicos colaboradores" for="collaborator" :error="$errors->first('collaborator')">
                @if($expedient->collaborators)
                    <ul>
                        @foreach($expedient->collaborators as $collaboratorSelected)
                            <li class="flex justify-between py-2 items-center">
                                <div class="text-sm">{{ $collaboratorSelected->full_name }} <span class="text-xs text-gray-500">{{ $expedient->gabinete->users->find($collaboratorSelected)->pivot->subcontractor_id
                                    ? '(' . $expedient->gabinete->subcontractors->find($expedient->gabinete->users->find($collaboratorSelected)->pivot->subcontractor_id)->name . ')'
                                    : '' }}</span></div>
                                <x-button.danger wire:click="detachCollaborator({{$collaboratorSelected->id}})" size="xs"><x-icon.trash size="4"/></x-button.danger>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <x-input.select wire:model="addCollaborator" id="expedient-adjuster-id" placeholder="Colaboradores firmantes de este expediente...">
                    @can('gabinete.allEmployees')
                        @foreach($expedient->gabinete->employees()->whereNotIn('id', array_merge($this->expedient->collaborators->pluck('id')->toArray(), [$expedient->adjuster_id]))->sortBy('name') as $collaboratorRow)
                            @if($collaboratorRow->hasRole('Technician'))
                                <option value="{{ $collaboratorRow->id }}" wire:key="newCollaboratorEmployeeTo-{{$collaboratorRow->id}}">{{ $collaboratorRow->full_name }}</option>
                            @endif
                        @endforeach
                        @foreach($expedient->gabinete->externals()->whereNotIn('id', array_merge($this->expedient->collaborators->pluck('id')->toArray(), [$expedient->adjuster_id]))->sortBy('pivot.subcontractor_id')->sortBy('name') as $collaboratorRow)
                            @if($collaboratorRow->hasRole('Technician'))
                                <option value="{{ $collaboratorRow->id }}" wire:key="newCollaboratorExternalTo-{{$collaboratorRow->id}}" >{{$collaboratorRow->subcontractors->find($collaboratorRow->pivot->subcontractor_id)->name}} · {{ $collaboratorRow->full_name }}</option>
                            @endif
                        @endforeach
                    @else
                        @if($subcontractor = auth()->user()->isSubcontractor($expedient->gabinete))
                            @foreach($expedient->gabinete->externals()->where('pivot.subcontractor_id', $subcontractor)->whereNotIn('id', array_merge($this->expedient->collaborators->pluck('id')->toArray(), [$expedient->adjuster_id]))->sortBy('pivot.subcontractor_id')->sortBy('name') as $collaboratorRow)
                                @if($collaboratorRow->hasRole('Technician'))
                                    <option value="{{ $collaboratorRow->id }}" wire:key="newCollaboratorExternalTo-{{$collaboratorRow->id}}" >{{$collaboratorRow->subcontractors->find($collaboratorRow->pivot->subcontractor_id)->name}} · {{ $collaboratorRow->full_name }}</option>
                                @endif
                            @endforeach
                        @else
                            @foreach($expedient->gabinete->employees()->whereNotIn('id', array_merge($this->expedient->collaborators->pluck('id')->toArray(), [$expedient->adjuster_id]))->sortBy('name') as $collaboratorRow)
                                @if($collaboratorRow->hasRole('Technician'))
                                    <option value="{{ $collaboratorRow->id }}" wire:key="newCollaboratorEmployeeTo-{{$collaboratorRow->id}}">{{ $collaboratorRow->full_name }}</option>
                                @endif
                            @endforeach
                        @endif
                    @endcan
                </x-input.select>
            </x-input.group>
        </x-card.body>
        <x-card.footer class="bg-gray-50 flex justify-end space-x-2">
            <x-button.primary wire:click="save">{{__('Update')}}</x-button.primary>
        </x-card.footer>
    </x-card.card>

    <livewire:expedient.contacts :expedient="$expedient" />

    <form wire:submit.prevent="deleteProduct">
        <x-modal.confirmation wire:model.defer="showDeleteModal" un-closable>

            <x-slot name="title">
                {{__('El expediente tiene asociado un producto')}}
                <x-button.close wire:click="cancelDeletion" />
            </x-slot>

            <x-slot name="content">
                <p>{{ __('¿Estás seguro de que quires cambiar el ramo del expediente?') }}</p>
                <p>{{ __('Las garantías y subgarantías se modificarán, y algunas de las condiciones particulares ya definidas podrían perderse.')}}</p>
                <p>{{__('Esta acción no se puede deshacer.') }}</p>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="cancelDeletion">{{__('Cancel')}}</x-button.secondary>
                <x-button.danger type="submit">{{__('Continuar')}}</x-button.danger>
            </x-slot>

        </x-modal.confirmation>
    </form>

</div>

