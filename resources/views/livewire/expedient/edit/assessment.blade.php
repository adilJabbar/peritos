<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Valoración de daños'" />
    </x-card.card>

    <ul class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2 xl:grid-cols-4 mt-3" x-max="1">

        <li class="relative col-span-1 flex shadow-sm rounded-md">
            <div class="flex-shrink-0 flex items-center justify-center w-16 bg-pink-600 text-white text-sm font-medium rounded-l-md">
                <x-icon.user />
            </div>
            <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                <div class="flex-1 px-4 py-2 text-sm truncate cursor-pointer" wire:click="showDamages({{$expedient->person_id}})">
                    <span class="text-gray-900 font-medium hover:text-gray-600">
                        {{__('Daños propios')}}
                    </span>
                    <p class="text-gray-500"><x-output.currency value="{{$expedient->totalProposedByPerson($expedient->person_id)}}" :currency="$expedient->currency()" /></p>
                </div>
                <x-dropdown.dots-vertical class="origin-top-right right-0 top-auto w-11/12">
                    <div role="none">
                        <span class="block px-4 py-2 text-sm text-gray-700 bg-gray-100 text-gray-900 rounded-t-md">{{__('Cubierto')}}</span>
                    </div>
                    <div class="py-1" role="none">
                        @foreach($destinies->where('covered', 1) as $destiny)
                            <div class="flex justify-between" role="menuitem">
                                <span class="block px-4 py-2 text-sm text-gray-700">{{$destiny->name}}</span>
                                <span class="block px-4 py-2 text-sm text-gray-700">
                                    <x-output.currency value="{{$expedient->totalProposedByDestinyAndPerson($destiny->id, $expedient->person_id)}}" :currency="$expedient->currency()" />
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div role="none">
                        <span class="block px-4 py-2 text-sm text-gray-700 bg-gray-100 text-gray-900">{{__('Excluido')}}</span>
                    </div>
                    <div class="py-1" role="none">
                        @foreach($destinies->where('covered', 0) as $destiny)
                            <div class="flex justify-between"  role="menuitem">
                                <span class="block px-4 py-2 text-sm text-gray-700">{{$destiny->name}}</span>
                                <span class="block px-4 py-2 text-sm text-gray-700">
                                    <x-output.currency value="{{$expedient->totalByDestinyAndPerson($destiny->id, $expedient->person_id)}}" :currency="$expedient->currency()" />
                                </span>
                            </div>
                        @endforeach
                    </div>
                </x-dropdown.dots-vertical>
            </div>
        </li>

        <li class="relative col-span-1 flex shadow-sm rounded-md">
            <div class="flex-shrink-0 flex items-center justify-center w-16 bg-purple-600 text-white text-sm font-medium rounded-l-md">
                <x-icon.users />
            </div>
            <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                <div class="flex-1 px-4 py-2 text-sm truncate">
                    <span class="text-gray-900 font-medium hover:text-gray-600">
                        {{__('Daños a terceros')}}
                    </span>
                    <p class="text-gray-500"><x-output.currency value="{{$expedient->totalProposedAffecteds()}}" :currency="$expedient->currency()" /></p>
                </div>

                <x-dropdown.dots-vertical class="origin-top-right right-0 top-auto w-11/12">
                    <div>
                        <span class="block px-4 py-2 text-sm text-gray-700 bg-gray-100 text-gray-900 rounded-t-md">{{__('Perjudicados')}}</span>
                    </div>
                    <div class="py-1" role="none">
                        @forelse($expedient->affecteds->where('pivot.type', 'perjudicado') as $affectedOption)
                            <div class="flex justify-between hover:bg-gray-100 hover:text-gray-900 cursor-pointer" wire:click="showDamages({{$affectedOption->id}})" role="menuitem">
                                <span class="block px-4 py-2 text-sm text-gray-700"  >{{ $affectedOption->name }}</span>
                                <span class="block px-4 py-2 text-sm text-gray-700">
                                    <x-output.currency value="{{$expedient->totalProposedByPerson($affectedOption->id)}}" :currency="$expedient->currency()" />
                                </span>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </x-dropdown.dots-vertical>
            </div>
        </li>

        <li class="relative col-span-1 flex shadow-sm rounded-md">
            <div class="flex-shrink-0 flex items-center justify-center w-16 bg-yellow-500 text-white text-sm font-medium rounded-l-md">
                <x-icon.ban />
            </div>
            <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                <div class="flex-1 px-4 py-2 text-sm truncate">
                     <span class="text-gray-900 font-medium hover:text-gray-600">
                        {{__('Total excluido')}}
                    </span>
                    <p class="text-gray-500"><x-output.currency value="{{$expedient->totalProposedExcluded()}}" :currency="$expedient->currency()" /></p>
                </div>
                <x-dropdown.dots-vertical class="origin-top-right right-0 top-auto w-11/12">
                    <div class="py-1" role="none">
                        @foreach($destinies->where('covered', 0) as $destiny)
                            <div class="flex justify-between"  role="menuitem">
                                <span class="block px-4 py-2 text-sm text-gray-700">{{$destiny->name}}</span>
                                <span class="block px-4 py-2 text-sm text-gray-700">
                                    <x-output.currency value="{{$expedient->totalByDestiny($destiny->id)}}" :currency="$expedient->currency()" />
                                </span>
                            </div>
                        @endforeach
                    </div>
                </x-dropdown.dots-vertical>
            </div>
        </li>

        <li class="relative col-span-1 flex shadow-sm rounded-md">
            <div class="flex-shrink-0 flex items-center justify-center w-16 bg-green-500 text-white text-sm font-medium rounded-l-md">
                <x-icon.badge-check />
            </div>
            <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                <div class="flex-1 px-4 py-2 text-sm truncate">
                    <span class="text-gray-900 font-medium hover:text-gray-600">
                        {{__('Total propuesto')}}
                    </span>
                    <p class="text-gray-500"><x-output.currency value="{{$expedient->totalProposedCovered()}}" :currency="$expedient->currency()" /></p>
                </div>
                <x-dropdown.dots-vertical class="origin-top-right right-0 top-auto w-11/12">
                    @foreach($destinies->where('covered', 1) as $destiny)
                        <div class="flex justify-between"  role="menuitem">
                            <span class="block px-4 py-2 text-sm text-gray-700">{{$destiny->name}}</span>
                            <span class="block px-4 py-2 text-sm text-gray-700">
                                    <x-output.currency value="{{$expedient->totalProposedByDestiny($destiny->id)}}" :currency="$expedient->currency()" />
                                </span>
                        </div>
                    @endforeach
                </x-dropdown.dots-vertical>
            </div>
        </li>

    </ul>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            @if($person->id == $expedient->person_id)
                {{ __('Daños propios') }}
            @else
                {{$person->name}} <span class="text-xs text-gray-500">{{ $address->address . '. ' . $address->full_city }}</span>
            @endif

            <x-button.primary wire:click="create({{$person->id}})"><x-icon.plus size="4" /></x-button.primary>
        </x-card.header>
            @include('partials.expedient.assessment.table', ['subguaranteesUsed' => $expedient->subguaranteesUsed($person->id)])
    </x-card.card>

    @include('livewire.expedient.edit.assessment.modal')
</div>
