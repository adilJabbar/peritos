<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent >{{__('Alta de expediente')}}</x-breadcumb.item>
                @if($expedient->gabinete_id)
                    <x-breadcumb.item>{{__($expedient->gabinete->name)}}</x-breadcumb.item>
                    @if($expedient->getKey())
                        <x-breadcumb.item>{{ $expedient->full_code }}</x-breadcumb.item>
                    @endif
                    <x-breadcumb.item>{{ __('Finalizar alta') }}</x-breadcumb.item>
                @endif
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            {{__('Finalizar alta')}}
        </x-card.header>
        <x-card.body>
            <x-input.group for="expedient-private-comments" label="Comentarios privados" :error="$errors->first('expedient.private_comments')" borderless>
                <x-input.textarea wire:model.lazy="expedient.private_comments" id="expedient-private-comments" placeholder="Notas o comentarios privados (no se reportarán a la compañía ni se reflejaran en ningún informe)" :error="$errors->first('expedient.private_comments')" />
            </x-input.group>
            <x-input.group for="expedient-adjuster-id" label="Asignado a" :error="$errors->first('expedient.adjuster_id')" borderless>
                <x-input.select wire:model.lazy="expedient.adjuster_id" id="expedient-adjuster-id" placeholder="Asignar a..." :error="$errors->first('expedient.adjuster_id')">
                    @forelse($expedient->gabinete->employees() as $employeeRow)
{{--                        @if($employeeRow->can('own.expedient'))--}}
                            <option value="{{ $employeeRow->id }}">{{ $employeeRow->full_name }}</option>
{{--                        @endif--}}
                    @empty
                        <option disabled>{{__('No hay ningún empleado asignable en este gabinete')}}</option>
                    @endforelse
                </x-input.select>
            </x-input.group>
            <div class="grid sm:grid-cols-2 gap-4">
                <x-input.group for="attached-pictures" label="Fotografías" inline :error="$errors->first('pictures')" >
                    <x-input.filepond wire:model="pictures"
                                      multiple
                                      validation="'image/*'"
                                      maxSize="2048KB"
                    />
                </x-input.group>
                <x-input.group for="attached-documents" label="Documentos" inline :error="$errors->first('documents')" >
                    <x-input.filepond wire:model="documents"
                                      multiple
                                      validation="'application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'"
                                      maxSize="2048KB"
                    />
                </x-input.group>

            </div>
        </x-card.body>
        <x-card.footer class="flex justify-end space-x-2">
            <x-button.primary wire:click="finishAndOpen">{{__('Finalizar y abrir expediente')}}</x-button.primary>
            <x-button.primary wire:click="finishAndList">{{__('Finalizar y volver a expedientes')}}</x-button.primary>
        </x-card.footer>
    </x-card.card>
</div>
