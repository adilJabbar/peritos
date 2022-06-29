<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Tasación de daños'" />
    </x-card.card>

    <div>
        <div class="sm:hidden">
            <label for="tasacion-tab" class="sr-only">{{__('Selecciona una opción')}}</label>
            <select wire:model="tasacionView" id="tasacion-tab" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                <option value="capital">{{__('Por capitales')}}</option>
                <option value="person">{{__('Por perceptores')}}</option>
            </select>
        </div>
        <div class="hidden sm:block">
            <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
                <div aria-current="page" class=" rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $tasacionView == 'capital' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('tasacionView', 'capital')">
                    <span>{{__('Por capitales')}}</span>
                    <span aria-hidden="true" class="bg-{{ $tasacionView == 'capital' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                </div>

                <div aria-current="page" class=" rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $tasacionView == 'person' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('tasacionView', 'person')">
                    <span>{{__('Por perceptores')}}</span>
                    <span aria-hidden="true" class="bg-{{ $tasacionView == 'person' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                </div>

            </nav>
        </div>
    </div>

    <div>

        @if($tasacionView == 'capital')
            <div>
                @include('livewire.expedient.edit.tasacion.tasacionCapital')
            </div>
        @else
            <div class="space-y-4">
                @include('livewire.expedient.edit.tasacion.tasacionPerson')
            </div>
        @endif
    </div>
</div>
