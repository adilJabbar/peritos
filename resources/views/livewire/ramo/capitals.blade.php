<x-card.card>
    <x-card.body class="space-y-4" wire:key="capital-table">
        <x-administration.capital.table :capitals="$ramo->capitals" :ramo="$ramo" />
        <span class="text-sm text-red-400 font-bold">{{__('Solamente un capital por defecto de cada grupo.')}}</span> <span class="text-xs text-red-400">{{__('Los capitales que se seleccionen por defecto, serán los receptores de algunos cálculos específicos realizados por la aplicación, como por ejemplo valores de preexistencia de continente y contenido.')}}</span>
    </x-card.body>
</x-card.card>
