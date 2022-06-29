<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Countries">{{__('Countries')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($country->name) }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Provincias') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            {{__('Provincias de')}} {{ __($country->name) }}
            <x-input.group for="country-newstate" borderless :error="$errors->first('newState')">
                <div class="flex justify-between space-x-2">
                    <x-input.text wire:model.lazy="newState" id="country-newstate" placeholder="Añadir provincia" :error="$errors->first('newState')" />
                    <x-button.primary wire:click="addState" size="sm"><x-icon.plus size="4" /></x-button.primary>
                </div>
            </x-input.group>
        </x-card.header>
        <x-table.table>
            <x-slot name="head">
                <x-table.heading>{{__('Name')}}</x-table.heading>
                <x-table.heading>{{__('Coeficiente ajuste sobre módulo nacional')}}</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse($country->states->sortBy('name') as $stateRow)
                    <livewire:country.state-row :state="$stateRow" :key="'state'. $stateRow->id"/>

                @empty
                    <x-table.row>
                        <x-table.cell colspan="3" class="text-center">
                            {{__('No hay ningún estado definido para este país')}}
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
    </x-card.card>
</div>
