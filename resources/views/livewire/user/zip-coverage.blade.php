<div x-data="{showNewZone: @entangle('showNewZone')}">
    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            <h3>{{__('Zonas de cobertura')}}</h3>
            @can('zipCoverage.create')
            <div class="flex-shrink-0">
                <x-button.primary @click="showNewZone = !showNewZone">
                    @if($showNewZone)
                        <x-icon.minus size="4" />
                    @else
                        <x-icon.plus size="4" />
                    @endif
                </x-button.primary>
            </div>
            @endcan
        </x-card.header>

        @can('zipCoverage.create')
        <!-- show new zone -->
        <div x-show="showNewZone" class="p-2">
            <x-card.card class="border-2 border-primary">
                <x-card.body>
                    <x-input.group for="newZone-country_id" label="Country" :error="$errors->first('newZone.country_id')" borderless>
                        <x-input.select id="newZone-country_id" wire:model.lazy="newZone.country_id" :error="$errors->first('newZone.country_id')" placeholder="Selecciona el país">
                            @foreach(\App\Models\Admin\Country::all()->sortBy('name') as $countryOption)
                                <option value="{{$countryOption->id}}">{{__($countryOption->name)}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                    @unless($gabinete)
                    <x-input.group for="newZone-gabinete_id" label="Gabinete" :error="$errors->first('newZone.gabinete_id')" borderless>
                        <x-input.select id="newZone-gabinete_id" wire:model.lazy="newZone.gabinete_id" :error="$errors->first('newZone.gabinete_id')" placeholder="Selecciona el gabinete">
                            @foreach($user->gabinetes->sortBy('name') as $gabineteOption)
                                <option value="{{$gabineteOption->id}}">{{__($gabineteOption->name)}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                    @endunless
                    <x-input.group for="newZone-from" label="Desde" :error="$errors->first('newZone.from')" borderless>
                        <x-input.text id="newZone-from" type="number" step="1" wire:model.lazy="newZone.from" :error="$errors->first('newZone.from')"/>
                    </x-input.group>
                    <x-input.group for="newZone-to" label="Hasta" :error="$errors->first('newZone.to')" borderless>
                        <x-input.text id="newZone-to" type="number" step="1" wire:model.lazy="newZone.to" :error="$errors->first('newZone.to')"/>
                    </x-input.group>
                    <x-input.group for="newZone-comments" label="Comentarios" :error="$errors->first('newZone.comments')" borderless>
                        <x-input.textarea id="newZone-comments" rows="2" wire:model.lazy="newZone.comments" :error="$errors->first('newZone.comments')"/>
                    </x-input.group>
                    <div class="flex justify-end">
                        <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
                    </div>
                </x-card.body>
            </x-card.card>
        </div>
        @endcan

        <!-- Existing zip zones -->
        <x-table.table>
            <x-slot name="head">
                <x-table.heading class="w-64">{{__('Country')}}</x-table.heading>
                <x-table.heading class="w-64">{{__('Gabinete')}}</x-table.heading>
                <x-table.heading class="w-24">{{__('From')}}</x-table.heading>
                <x-table.heading class="w-24">{{__('To')}}</x-table.heading>
                <x-table.heading>{{__('Comments')}}</x-table.heading>
                <x-table.heading class="w-0"></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse($zipCoverages as $zipCoverage)
                    @can('zipCoverage.update')
                        <livewire:zipcoverage.row :zipCoverage="$zipCoverage" wire:key="{{ $zipCoverage->id }}-zipcoverage"/>
                    @else
                        <x-table.row>
                            <x-table.cell>
                                {{__($zipCoverage->country->name)}}

                            </x-table.cell>
                            <x-table.cell noPadding>
                                {{ $zipCoverage->gabinete->name }}

                            </x-table.cell>
                            <x-table.cell noPadding>
                                {{ $zipCoverage->from }}
                            </x-table.cell>
                            <x-table.cell noPadding>
                                {{ $zipCoverage->to }}
                            </x-table.cell>
                            <x-table.cell noPadding>
                                {{ $zipCoverage->comments }}
                            </x-table.cell>
                            <x-table.cell noPadding class="text-center">

                            </x-table.cell>
                        </x-table.row>

                    @endcan
                @empty
                    <x-table.row>
                        <x-table.cell colspan="6" class="text-center">{{__('No hay ninguna zona de cobertura para este usuario')}}</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
    </x-card.card>
</div>
