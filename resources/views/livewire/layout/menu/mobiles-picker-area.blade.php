<div class="relative">
    <label for="inbox-select" class="sr-only">{{__('Select one option')}}</label>
    <select wire:model="option" id="inbox-select" class="rounded-md border-0 bg-none pl-3 pr-8 text-base font-medium text-gray-900 focus:ring-2 focus:ring-indigo-600">

        <option value="">{{__('Select one option')}}</option>
        <option value="dashboard">{{__('Inicio')}}</option>
        <option value="siniestro">{{__('Expedients')}}</option>
        <option value="perito">{{__('Peritos')}}</option>
        <option value="gabinete">{{__('Gabinetes')}}</option>
        <option value="usuario">{{__('Users')}}</option>


    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center justify-center pr-2">
        <x-icon.chevron-down size="5" solid="true" class="text-gray-500"/>
    </div>
</div>
