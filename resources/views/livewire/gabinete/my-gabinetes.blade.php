<div>
    <x-layout.two-columns>
        <!-- title -->
        <x-slot name="title">
            {{ __('Mis gabinetes') }}
        </x-slot>

        <!-- mobile menu -->
        <x-slot name="primary">
            @forelse(auth()->user()->gabinetes as $gabineteOption)
                <div class="pt-2 px-4 flex justify-between space-x-2">
                    <div>
                        <div>{{ $gabineteOption->name }}</div>
                        @if($subcontractor = $gabineteOption->subcontractors->find($gabineteOption->pivot->subcontractor_id))
                            <div class="text-xs">({{$subcontractor->name}})</div>
                        @endif
                    </div>

                    @if(!$subcontractor)
                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'data'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'data' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Datos del gabinete')}}
                        </x-button.header_menu_gabinetes>
                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'Users'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'Users' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Empleados')}}
                        </x-button.header_menu_gabinetes>
                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'Subcontractors'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'Subcontractors' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Subcontratas')}}
                        </x-button.header_menu_gabinetes>
                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'Expedients'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'Expedientes' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Expedientes')}}
                        </x-button.header_menu_gabinetes>
                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'Companies'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'Companies' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Compañías')}}
                        </x-button.header_menu_gabinetes>
                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'Reports'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'Reports' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Documentos')}}
                        </x-button.header_menu_gabinetes>
                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'Plan'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'Plan' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Plan')}}
                        </x-button.header_menu_gabinetes>
                    @else

                        <x-button.header_menu_gabinetes
                            :gabinete="$gabineteOption->id"
                            :menu="'Expedients'"
                            :showSubMenu="$showSubmenu"
                            :isActive="$showSubmenu == 'Expedientes' && $gabineteSelectedId == $gabineteOption->id">
                            {{__('Expedientes')}}
                        </x-button.header_menu_gabinetes>
                    @endif
                </div>
            @empty

            @endforelse
        </x-slot>

        <!-- left side menu -->
        <x-slot name="secondary">
            <nav aria-label="Sidebar">

{{--                    @dd(auth()->user()->gabinetes)--}}
                @forelse(auth()->user()->gabinetes as $gabineteOption)
                <div class="space-y-1" wire:key="{{$gabineteOption->id}}nav-area">
                    <div class="p-3 font-semibold text-white bg-gray-400">
                        <h3 class="uppercase tracking-wider" id="expedient-headline">
                            <div>{{ $gabineteOption->name }}</div>
                        </h3>
                        <span class="text-sm" id="expedient-headline-2">
                            @if($subcontractor = $gabineteOption->subcontractors->find($gabineteOption->pivot->subcontractor_id))
                                ({{$subcontractor->name}})
                            @endif
                        </span>

                    </div>
                    @if(!$subcontractor)
                        <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Datos del gabinete" icon="office-building" name="data" is-active="{{ $showSubmenu == 'data' && $gabineteSelectedId == $gabineteOption->id}}" />

                        <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Empleados" icon="users" name="Users" badge="{{ $gabineteOption->employees()->count() }}" is-active="{{ $showSubmenu == 'Users' && $gabineteSelectedId == $gabineteOption->id}}" />

                        <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Subcontratas" icon="briefcase" name="Subcontractors" badge="{{ $gabineteOption->subcontractors->count() }}" is-active="{{ $showSubmenu == 'Subcontractors' && $gabineteSelectedId == $gabineteOption->id}}" />

                        <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Expedientes" icon="clipboard-list" name="Expedients" badge="{{ $gabineteOption->expedients->count() }}" is-active="{{ $showSubmenu == 'Expedients' && $gabineteSelectedId == $gabineteOption->id}}" />

                        <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Compañías" icon="collection" name="Companies" badge="{{ $gabineteOption->companies->count() }}" is-active="{{ $showSubmenu == 'Companies' && $gabineteSelectedId == $gabineteOption->id}}" />

                        <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Documentos" icon="document-text" name="Reports" is-active="{{ $showSubmenu == 'Reports' && $gabineteSelectedId == $gabineteOption->id}}" />

                        @can('plan.manage')
                            <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Plan" icon="cash" name="Plan" is-active="{{ $showSubmenu == 'Plan' && $gabineteSelectedId == $gabineteOption->id}}" />
                        @endcan

                    @else
                        <x-administration.menu-item_gabinetes :gabinete="$gabineteOption->id" label="Expedientes" icon="clipboard-list" name="Expedients" badge="{{ $gabineteOption->subcontractorExpedients($subcontractor->id)->count() }}" is-active="{{ $showSubmenu == 'Expedients' && $gabineteSelectedId == $gabineteOption->id}}" />
                    @endif
                </div>

                @empty

                @endforelse
            </nav>
        </x-slot>
        <!-- main content -->
        <div class="p-4 w-full">
            @if($showSubmenu == 'data')
                <livewire:my-gabinetes.gabinete :gabinete="$gabinete" wire:key="data{{$gabinete->id}}"/>
            @elseif($showSubmenu == 'Users')
                <livewire:my-gabinetes.users :gabinete="$gabinete" wire:key="users{{$gabinete->id}}"/>
            @elseif($showSubmenu == 'Subcontractors')
                <livewire:my-gabinetes.subcontractors :gabinete="$gabinete" wire:key="subcontractors{{$gabinete->id}}"/>
            @elseif($showSubmenu == 'Expedients')
                <livewire:my-gabinetes.expedients :gabinete="$gabinete" wire:key="expedients{{$gabinete->id}}"/>
            @elseif($showSubmenu == 'Companies')
                <livewire:my-gabinetes.companies :gabinete="$gabinete" wire:key="companies{{$gabinete->id}}"/>
            @elseif($showSubmenu == 'Reports')
                <livewire:my-gabinetes.reports :gabinete="$gabinete" wire:key="reports{{$gabinete->id}}"/>
            @elseif($showSubmenu == 'Plan')
                @can('plan.manage')
                    <livewire:my-gabinetes.plan :gabinete="$gabinete" wire:key="plan{{$gabinete->id}}"/>
                @endcan
            @endif

        </div>
    </x-layout.two-columns>

</div>
