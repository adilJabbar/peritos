<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('company.show', ['company' => $company->id]) }}">{{ $company->name }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Gabinetes') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>


    <div class="space-y-4">
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3>{{__('Gabinetes que trabajan con')}} {{$company->name}}</h3>

            </x-card.header>
            <x-card.body>
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse($company->gabinetes->sortBy('name') as $rowGabinete)
                        <li class="py-4 flex justify-between space-x-4">

                            <div class="flex flex-shrink-0 items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center">
                                    <img class="max-h-10 max-w-10 " src="{{ $rowGabinete->logo_url }}" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$rowGabinete->name}}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{$rowGabinete->cif}}
                                    </div>
                                </div>
                            </div>


{{--                            <div class="flex flex-grow text-gray-500 text-sm">--}}
{{--                                <span>{{$company->products->where('ramo_id', $rowRamo->id)->pluck('name')->implode(' · ')}}</span>--}}
{{--                            </div>--}}
{{--                            <div class="right flex-shrink-0">--}}
{{--                                <x-button.danger wire:click="removeGabinete({{$rowGabinete->id}})" size="xs"><x-icon.trash /></x-button.danger>--}}
{{--                            </div>--}}
                        </li>
                    @empty
                        <li class="py-4 flex">
                            <div class="">
                                <p class="text-sm font-medium text-gray-900">{{__('No hay ningún gabinete que trabaje con esta compañía')}}</p>
                            </div>
                        </li>
                    @endforelse
                </ul>
{{--                <div>--}}
{{--                    <x-input.group for="add-gabinete" label="Añadir gabinete">--}}
{{--                        <x-input.select wire:model="addGabinete" id="add-gabinete" placeholder="Selecciona un gabinete">--}}
{{--                            @forelse($gabinetes->whereNotIn('id', $company->gabinetes->pluck('id')) as $newGabinete)--}}
{{--                                <option value="{{ $newGabinete->id }}">{{ $newGabinete->name }}</option>--}}
{{--                            @empty--}}
{{--                                <option disabled>{{__('No hay más gabinetes que no trabajen con')}} {{__($company->name)}}</option>--}}
{{--                            @endforelse--}}
{{--                        </x-input.select>--}}
{{--                    </x-input.group>--}}
{{--                </div>--}}
            </x-card.body>
        </x-card.card>

    </div>
</div>
