<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('company.show', ['company' => $company->id]) }}">{{ $company->name }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Ramos') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>


    <div class="space-y-4">
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                <h3>{{__('Ramos comercializados por')}} {{$company->name}}</h3>

            </x-card.header>
            <x-card.body>
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse($company->ramos->sortBy('name') as $rowRamo)
                    <li class="py-4 flex justify-between space-x-4">
                        <div class="flex flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{asset($rowRamo->icon_url)}}" alt="{{$rowRamo->name}}">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{$rowRamo->name}}</p>
                                <p class="text-sm text-gray-500">({{__($rowRamo->country->name)}})</p>
                            </div>
                        </div>
                        <div class="flex flex-grow text-gray-500 text-sm">
                            <span>{{$company->products->where('ramo_id', $rowRamo->id)->pluck('name')->implode(' · ')}}</span>
                        </div>
                        <div class="right flex-shrink-0">
                            <x-button.danger wire:click="removeRamo({{$rowRamo->id}})" size="xs"><x-icon.trash /></x-button.danger>
                        </div>
                    </li>
                    @empty
                    <li class="py-4 flex">
                        <div class="">
                            <p class="text-sm font-medium text-gray-900">{{__('No hay ningún ramo asociado a esta compañía')}}</p>
                        </div>
                    </li>
                    @endforelse
                </ul>
                <div>
                    <x-input.group for="add-ramo" label="Añadir ramo">
                        <x-input.select wire:model="addRamo" id="add-ramo" placeholder="Selecciona un ramo">
                            @forelse($company->country->ramos->whereNotIn('id', $company->ramos->pluck('id')) as $newRamo)
                                <option value="{{ $newRamo->id }}">{{ $newRamo->name }}</option>
                            @empty
                                <option disabled>{{__('No hay más ramos disponibles en')}} {{__($company->country->name)}}</option>
                            @endforelse
                        </x-input.select>
                    </x-input.group>
                </div>
            </x-card.body>
        </x-card.card>

    {{--    @if($selectedRamo)--}}
    {{--        <x-card.card>--}}
    {{--            @if($selectedRamo === 'all')--}}

    {{--                todos--}}
    {{--            @else--}}
    {{--                <x-card.header>--}}
    {{--                    <h3>{{__('Ramo')}}: {{__($ramo->name ?? '')}}</h3>--}}
    {{--                </x-card.header>--}}
    {{--                <x-card.body>--}}
    {{--                    @forelse($company->products as $productRow)--}}
    {{--                        {{$productRow->name}}--}}
    {{--                    @empty--}}
    {{--                        {{__('Esta companía no comercializa ningún producto de este ramo')}}--}}
    {{--                    @endforelse--}}
    {{--                </x-card.body>--}}
    {{--            @endif--}}
    {{--        </x-card.card>--}}
    {{--    @endif--}}

    {{--    @include('partials.insurance.product.modal')--}}
    </div>
</div>
