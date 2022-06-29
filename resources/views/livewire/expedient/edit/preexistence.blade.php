<div class="space-y-4">

    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Preexistencias'" />
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            <h3>{{ ucfirst(__($expedient->ramo->preexistenceClass->name)) }}</h3>
        </x-card.header>
        <x-card.body>
            @livewire('expedient.preexistence.' . strtolower($expedient->ramo->preexistenceClass->name), ['expedient' => $expedient])

            <x-input.group for="risk-description" label="Descripción del riesgo" :error="$errors->first('textPreexistence.risk_description')"  >
                <x-input.rich-text wire:model.lazy="textPreexistence.risk_description"
                                   id="risk-description" :error="$errors->first('textPreexistence.risk_description')" />
            </x-input.group>

            <x-input.group for="risk-matches" label="Coincide con el riesgo" :error="$errors->first('textPreexistence.risk_matches')" borderless>
                <x-input.rich-text wire:model.lazy="textPreexistence.risk_matches"
                              id="risk-matches"
                              :error="$errors->first('textPreexistence.risk_matches')"/>
            </x-input.group>

        </x-card.body>
    </x-card.card>
</div>
