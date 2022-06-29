<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Causa y circunstancias'" />
    </x-card.card>
    <x-card.card class="divide-y divide-gray-200">
        <x-card.body class="space-y-4">

            <x-input.group for="attended_by" label="Atendidos por" :error="$errors->first('textAdjuster.attended_by')" borderless>
                <x-input.text wire:model.lazy="textAdjuster.attended_by"
                              id="attended_by"
                              :error="$errors->first('textAdjuster.attended_by')"/>
            </x-input.group>

            <x-input.group for="chronology" label="Cronología de lo ocurrido" :error="$errors->first('textAdjuster.chronology')"  borderless >
                <x-input.rich-text wire:model.lazy="textAdjuster.chronology" id="chronology" :error="$errors->first('textAdjuster.chronology')" />
            </x-input.group>

            <x-input.group for="adjuster" label="Intervención pericial" :error="$errors->first('textAdjuster.adjuster')"  borderless >
                <x-input.rich-text wire:model.lazy="textAdjuster.adjuster" id="adjuster" :error="$errors->first('textAdjuster.adjuster')" />
            </x-input.group>

            <x-input.group for="damages" label="Descripción de los daños" :error="$errors->first('textAdjuster.damages')"  borderless >
                <x-input.rich-text wire:model.lazy="textAdjuster.damages" id="damages" :error="$errors->first('textAdjuster.damages')" />
            </x-input.group>

            <x-input.group for="evaluations" label="Comentarios a la valoración" :error="$errors->first('textAdjuster.evaluations')" borderless>
                <x-input.rich-text wire:model.lazy="textAdjuster.evaluations"
                              id="evaluations"
                              :error="$errors->first('textAdjuster.evaluations')"/>
            </x-input.group>

            @if($expedient->requires_policy)
                <x-input.group for="coverage" label="Conclusiones" :error="$errors->first('textAdjuster.coverage')" borderless>
                    <x-input.rich-text wire:model.lazy="textAdjuster.coverage"
                                  id="coverage"
                                  :error="$errors->first('textAdjuster.coverage')"/>
                </x-input.group>
            @endif
        </x-card.body>
    </x-card.card>
</div>
