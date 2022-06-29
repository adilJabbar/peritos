<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('company.show', ['company' => $company->id]) }}">{{ $company->name }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Áreas') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>
    <div x-data="{ showNewArea : @entangle('showNewArea')}" class="space-y-4">
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3>{{__('Áreas/Departamentos de')}} {{$company->name}}</h3>
                @can('insurance.update')
                    <x-button.primary @click="showNewArea = !showNewArea">
                        @if($showNewArea)
                            <x-icon.minus size="4" />
                        @else
                            <x-icon.plus size="4" />
                        @endif</x-button.primary>
                @endcan
            </x-card.header>

            <!-- show new area -->
            <div x-show="showNewArea" class="p-2" x-transition>
                <x-card.card class="border-2 border-primary">
                    <x-card.body>

                        <!-- name -->
                        <x-input.group label="Name" for="name" :error="$errors->first('area.name')" borderless>
                            <x-input.text wire:model.lazy="area.name" id="name" placeholder="Name" :error="$errors->first('area.name')" />
                        </x-input.group>



                        <!-- save -->
                        <div class="flex justify-end">
                            <x-button.primary type="save" wire:click="save">{{__('Save')}}</x-button.primary>
                        </div>
                    </x-card.body>
                </x-card.card>
            </div>

            <!-- table -->
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Name')}}</x-table.heading>
                </x-slot>


                <x-slot name="body">
                    @forelse ($company->areas->sortBy('name') as $areaRow)
                        <livewire:insurance.area.row :area="$areaRow" wire:key="area-row{{$areaRow->id}}" />
                    @empty
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-6 w-6 text-cool-gray-300"/>
                                    <span class="text-cool-gray-500 text-medium">{{__(':Company no tiene ningún área o departamento asociado.', ['company' => $company->name])}}</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table.table>

        </x-card.card>

    </div>

</div>
