<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Countries">{{__('Countries')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($country->name) }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Ramos') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
    <x-card.header>
        {{__('Ramos disponibles en')}}: {{ __($country->name) }}
        <x-input.group for="newRamo" borderless>
            <div class="flex justify-between space-x-2">
                <x-input.text wire:model="newRamo" id="newRamo" placeholder="Añadir ramo" :error="$errors->first('newRamo')" />
                <x-button.primary wire:click="addRamo" size="sm"><x-icon.plus size="4" /></x-button.primary>
            </div>
        </x-input.group>
    </x-card.header>
    <x-table.table>
        <x-slot name="head">
            <x-table.heading>{{__('Icon')}}</x-table.heading>
            <x-table.heading>{{__('Name')}}</x-table.heading>
            <x-table.heading>{{__('Tipos de siniestro')}}</x-table.heading>
            <x-table.heading>{{__('Capitales')}}</x-table.heading>
            <x-table.heading>{{__('Preexistencias')}}</x-table.heading>
            <x-table.heading>{{__('Cond. defecto')}}</x-table.heading>
            <x-table.heading/>
        </x-slot>
        <x-slot name="body">
            @forelse($country->ramos->sortBy('name') as $rowRamo)
                <x-table.row>
                    <x-table.cell>
                        <div class="flex justify-center">
                            <img class="h-10 w-10 rounded-full" src="{{asset($rowRamo->icon_url)}}" alt="{{$rowRamo->name}}">
                        </div>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="text-sm font-medium text-gray-900">{{$rowRamo->name}}</span>
                    </x-table.cell>
                    <x-table.cell>
                        {{$rowRamo->typecases->pluck('name')->implode(', ')}}
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        <span>{{$rowRamo->capitals->count()}}</span>
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        <span>{!! $rowRamo->preexistenceClass->name ?? '<span class="bg-red-600 rounded-full p-2 text-white">' . __('Sin definir') . '</span>'!!}</span>
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        <span class="{{!$rowRamo->defaultProduct ? 'bg-red-600 rounded-full p-2 text-white' : ''}}">{{$rowRamo->defaultProduct->name ?? __('Sin definir')}}</span>
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex justify-end flex-shrink-0 space-x-2">
                            <a href="{{route('administration.country.ramo.show', ['ramo' => $rowRamo->id])}}">
                                <x-button.primary size="xs"><x-icon.eye /></x-button.primary>
                            </a>
                            <x-button.danger wire:click="removeRamo({{$rowRamo->id}})" size="xs"><x-icon.trash /></x-button.danger>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="5">
                        <p class="text-sm font-medium text-gray-900">{{__('No hay ningún ramo disponible en este país')}}</p>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>


</x-card.card>
</div>
