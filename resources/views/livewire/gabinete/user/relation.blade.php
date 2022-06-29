<x-card.card class="divide-gray-200 divide-y">
    <x-card.header>
        <h3>{{ $gabinete->name }}</h3>
        <x-button.danger wire:click="detach" size="sm"><x-icon.trash size="5" /></x-button.danger>
    </x-card.header>
    <x-card.body>
        <x-input.group label="Backoffice" for="user-backoffice-id{{$gabinete->id}}" :error="$errors->first('backofficeId')" borderless>
            <x-input.select wire:model="backofficeId" placeholder="Selecciona el backoffice..." id="user-backoffice-id{{$gabinete->id}}"  :error="$errors->first('backofficeId')">
                <option value="0">{{__('Sin backoffice')}}</option>
                @foreach($gabinete->employees() as $backofficeRow)
                    @if($backofficeRow->hasRole('Administrative'))
                        <option value="{{$backofficeRow->id}}">{{ __($backofficeRow->full_name) }}</option>
                    @endif
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group label="Supervisor" for="supervisor-id{{$gabinete->id}}" :error="$errors->first('supervisorId')" borderless>
            <x-input.select wire:model="supervisorId" placeholder="Selecciona el supervisor..." id="user-supervisor-id{{$gabinete->id}}" :error="$errors->first('supervisorId')">
                <option value="0">{{__('Sin supervisor')}}</option>
                @foreach($gabinete->employees() as $supervisorRow)
                    @if($supervisorRow->hasanyrole(['TechManager', 'Technician']))
                        <option value="{{$supervisorRow->id}}">{{ __($supervisorRow->full_name) }}</option>
                    @endif
                @endforeach
            </x-input.select>
        </x-input.group>

        @if($supervisorId && $supervisorId !== 0)
            <x-input.group for="user-supervised-advances{{$gabinete->id}}" label=" " borderless>
                <x-input.checkbox wire:model.defer="supervised_advances" id="user-supervised-advances{{$gabinete->id}}" label="Supervised advances" label-notes="Los avances han de ser supervisados antes de su envío" />
                <x-input.checkbox wire:model.defer="supervised_reports" id="user-supervised-reports{{$gabinete->id}}" label="Supervised reports" label-notes="Los informes han de ser supervisados antes de su envío"/>
                <x-input.checkbox wire:model.defer="supervised_incidences" id="user-supervised-incidences{{$gabinete->id}}" label="Supervised incidences" label-notes="Las incidencias han de ser supervisadas antes de su envío"/>
            </x-input.group>
            <x-input.group for="user-contact_to_company{{$gabinete->id}}" label=" "  :error="$errors->first('contact_to_company')">
                <x-input.checkbox wire:model.defer="contact_to_company" id="user-contact_to_company{{$gabinete->id}}" label="Allowed contact to company" label-notes="Esta autorizado para enviar directamente comunicaciones a la compañía" :error="$errors->first('contact_to_company')"/>
            </x-input.group>
        @endif

        @if($gabinete->subcontractors->count() > 0)
            <x-input.group label="Subcontrata" for="subcontractor-id{{$gabinete->id}}" :error="$errors->first('subcontractorId')" borderless>
                <x-input.select wire:model="subcontractorId" placeholder="Selecciona la subcontrata..." id="subcontractor-id{{$gabinete->id}}" :error="$errors->first('subcontractorId')">
                    <option value="0">{{__('Empleado de :Gabinete', ['gabinete' => $gabinete->name])}}</option>
                    @foreach($gabinete->subcontractors as $subcontractorRow)
                        <option value="{{$subcontractorRow->id}}">{{ $subcontractorRow->name }}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>
        @endif
    </x-card.body>
    <x-card.footer class="flex justify-end space-x-4 bg-gray-50">
        <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
    </x-card.footer>
</x-card.card>
