<x-card.card>
    <x-card.body class="space-y-4" wire:key="typecase-table">
        <x-administration.typecase.table :typecases="$ramo->typecases" :ramo="$ramo" />
        @unless($ramo->preexistenceClass)
            <span class="text-xs text-red-400">{{__('Para poder seleccionar preexistencia, el ramo tiene que tener seleccionado un formulario de preexistencia por defecto')}}</span>
        @endunless
    </x-card.body>
</x-card.card>
