<div>
    @if($showGabineteSelector ?? true)
        <x-layout.two-column-card title="Gabinete" info="Selecciona el gabinete en el que trabajará este usuario">
            <x-input.select wire:model="gabineteId" placeholder="Selecciona el gabinete..." :error="$errors->first('gabinete')">
                @foreach($gabinetes->sortBy('name') as $gabineteRow)
                    <option value="{{$gabineteRow->id}}">{{ $gabineteRow->name }}</option>
                @endforeach
            </x-input.select>

            @if ($errors->first('gabinetesUser'))
                <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('gabinetesUser') }}</div>
            @endif
        </x-layout.two-column-card>
    @endif
</div>

<div>
    @if($gabineteSelected)
        <x-input.group label="Backoffice" for="user-backoffice-id" :error="$errors->first('backofficeId')" borderless>
            <x-input.select wire:model="backofficeId" placeholder="Selecciona el backoffice..." id="user-backoffice-id"  :error="$errors->first('backofficeId')">
                <option value="0">{{__('Sin backoffice')}}</option>
                @foreach($gabineteSelected->backoffices() as $backofficeRow)
                    <option value="{{$backofficeRow->id}}">{{ __($backofficeRow->full_name) }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group label="Supervisor" for="supervisor-id" :error="$errors->first('supervisorId')" borderless>
            <x-input.select wire:model="supervisorId" placeholder="Selecciona el supervisor..." id="user-supervisor-id" :error="$errors->first('supervisorId')">
                <option value="0">{{__('Sin supervisor')}}</option>
                @foreach($gabineteSelected->supervisors() as $supervisorRow)
{{--                        @if($supervisorRow->hasanyrole(['TechManager', 'Technician']))--}}
                        <option value="{{$supervisorRow->id}}">{{ __($supervisorRow->full_name) }}</option>
{{--                        @endif--}}
                @endforeach
            </x-input.select>
        </x-input.group>

        <div>
            @if($supervisorId && $supervisorId !== 0)
                <x-input.group for="user-supervised-advances" label=" " borderless>
                    <x-input.checkbox wire:model.defer="supervised_advances" id="user-supervised-advances" label="Supervised advances" label-notes="Los avances han de ser supervisados antes de su envío" />
                    <x-input.checkbox wire:model.defer="supervised_reports" id="user-supervised-reports" label="Supervised reports" label-notes="Los informes han de ser supervisados antes de su envío"/>
                    <x-input.checkbox wire:model.defer="supervised_incidences" id="user-supervised-incidences" label="Supervised incidences" label-notes="Las incidencias han de ser supervisadas antes de su envío"/>
                </x-input.group>
                <x-input.group for="user-supervised-advances" label=" "  :error="$errors->first('contact_to_company')">
                    <x-input.checkbox wire:model.defer="contact_to_company" id="user-contact_to_company" label="Allowed contact to company" label-notes="Esta autorizado para enviar directamente comunicaciones a la compañía" :error="$errors->first('contact_to_company')"/>
                </x-input.group>
            @endif
        </div>

    @endif
</div>
