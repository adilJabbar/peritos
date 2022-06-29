<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Countries">{{__('Countries')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ __($country->name) }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Edificaciones') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            {{__('Grupos de edificaciones')}}
            <x-input.group for="country-newGroup" borderless :error="$errors->first('newGroup')">
                <div class="flex justify-between space-x-2">
                    <x-input.text wire:model.lazy="newGroup" id="country-newGroup" placeholder="Añadir grupo" :error="$errors->first('newGroup')" />
                    <x-button.primary wire:click="addGroup" size="sm"><x-icon.plus size="4" /></x-button.primary>
                </div>
            </x-input.group>
        </x-card.header>
        <x-table.table>
            <x-slot name="head">
                <x-table.heading>{{__('Name')}}</x-table.heading>
                <x-table.heading>{{__('Subgrupos')}}</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse($country->riskgroups->sortBy('name') as $groupRow)
                    <livewire:country.risk-group.row :group="$groupRow" :key="'group'. $groupRow->id" :selected="$groupSelected"/>

                @empty
                    <x-table.row>
                        <x-table.cell colspan="3" class="text-center">
                            {{__('No hay ningún grupo de edificaciones definido para este país')}}
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
    </x-card.card>

    <div class="space-y-4">
        @if($groupSelected->getKey())
            <x-card.card>
                <x-card.header>
                    {{__('Subgrupos de edificaciones para :group', ['group' => $this->groupSelected->name])}}
                    <x-input.group for="group-newSubgroup" borderless :error="$errors->first('newSubgroup')">
                        <div class="flex justify-between space-x-2">
                            <x-input.text wire:model.lazy="newSubgroup" id="group-newSubgroup" placeholder="Añadir subgrupo" :error="$errors->first('newSubgroup')" />
                            <x-button.primary wire:click="addSubgroup" size="sm"><x-icon.plus size="4" /></x-button.primary>
                        </div>
                    </x-input.group>
                </x-card.header>

                <x-table.table>
                    <x-slot name="head">
                        <x-table.heading>{{__('Name')}}</x-table.heading>
                        <x-table.heading>{{__('Tipos de edificaciones')}}</x-table.heading>
                        <x-table.heading></x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($groupSelected->risksubgroups->sortBy('name') as $subgroupRow)
                            <livewire:country.risk-sub-group.row :subgroup="$subgroupRow" :key="'subgroup'. $subgroupRow->id" :selected="$subgroupSelected"/>

                        @empty
                            <x-table.row>
                                <x-table.cell colspan="3" class="text-center">
                                    {{__('No hay ningún subgrupo de edificaciones definido para este grupo')}}
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table.table>
            </x-card.card>

            <div>
                @if($subgroupSelected->getKey())
                    <x-card.card>
                        <x-card.header>
                            {{__('Tipología de edificaciones para :group :subgroup', ['group' => $this->groupSelected->name, 'subgroup' => $this->subgroupSelected->name])}}
                            <x-input.group for="group-newDetail" borderless :error="$errors->first('newDetail')">
                                <div class="flex justify-between space-x-2">
                                    <x-input.text wire:model.lazy="newDetail" id="group-newDetail" placeholder="Añadir tipo de edificación" :error="$errors->first('newDetail')" />
                                    <x-button.primary wire:click="addDetail" size="sm"><x-icon.plus size="4" /></x-button.primary>
                                </div>
                            </x-input.group>
                        </x-card.header>

                        <x-table.table>


                            <x-slot name="head">
                            </x-slot>
                            <x-slot name="body">
                                <thead>
                                <tr>
                                    <x-table.heading rowspan="2">{{__('Name')}}</x-table.heading>
                                    <x-table.heading rowspan="2">{{__('Coeficiente')}}</x-table.heading>
                                    <th colspan="4" class="px-6 py-0 bg-gray-50">
                                            <span class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{__('Ajuste por calidad')}}</span>
                                    </th>
{{--                                    <x-table.heading colspan="42" class="p-0">{{__('Ajuste por calidad')}}</x-table.heading>--}}
                                </tr>
                                <tr>
                                    <th class="px-6 py-0 bg-gray-50">
                                            <span class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{__('VPO')}}</span>
                                    </th>
                                    <th class="px-6 py-0 bg-gray-50">
                                            <span class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{__('Baja')}}</span>
                                    </th>
                                    <th class="px-6 py-0 bg-gray-50">
                                            <span class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{__('Alta')}}</span>
                                    </th>
                                    <th class="px-6 py-0 bg-gray-50">
                                            <span class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{__('Lujo')}}</span>
                                    </th>
                                    <x-table.heading></x-table.heading>
                                </tr>
                                </thead>
                                @forelse($subgroupSelected->riskdetails->sortBy('name') as $detailRow)
                                    <livewire:country.risk-details.row :detail="$detailRow"  :key="'detail'. $detailRow->id" />
{{--                                    <livewire:country.risk-sub-group.row :subgroup="$subgroupRow" :key="'subgroup'. $subgroupRow->id" :selected="$subgroupSelected"/>--}}

                                @empty
                                    <x-table.row>
                                        <x-table.cell colspan="3" class="text-center">
                                            {{__('No hay ningún tipo de edificacion definido para este subgrupo')}}
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table.table>
                    </x-card.card>


                @endif
            </div>


        @endif
    </div>
</div>
