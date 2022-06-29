<div class="divide-y divide-gray-200">
    <div class="w-full flex justify-between p-6 space-x-6 mb-52">
        <div class="flex-1 truncate">
            <div class="flex space-x-3">
                <h3 class="text-gray-900 text-sm font-medium truncate">{{$affected->name}}</h3>

            </div>
            @if($affected->legal_id)
                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-gray-800 text-xs font-medium bg-gray-100 rounded-full">{{$affected->legal_id}}</span>
            @endif
            @if($affected->legal_name)
                <p class="mt-1 text-gray-500 text-sm truncate"> {{$affected->legal_name}}</p>
            @endif

            <p class="mt-1 text-gray-500 text-sm truncate"> {{$address->name}}</p>
            <p class="mt-1 text-gray-500 text-sm truncate"> {{$address->address}}</p>
            <p class="mt-1 text-gray-500 text-sm truncate"> {{$address->full_city}}</p>
        </div>
        <div class="flex-1 truncate">
            @forelse($affected->contacts as $contactOption)
                <p class="mt-1 text-right text-gray-500 text-sm truncate"><a href="{{ $contactOption->link}}">{{ $contactOption->value}}</a></p>
            @empty
            @endforelse
        </div>
    </div>
    <div class="absolute inset-x-0 bottom-0 divide-gray-200 divide-y">
        <x-card.body>
            <x-input.group for="affected-type" label="Type"
                           :error="$errors->first('affected.pivot.type')" borderless>
                <x-input.select wire:model="affected.pivot.type" placeholder="Tipo de afectado...">
                    <option value="causante">{{__('Causante')}}</option>
                    <option value="perjudicado">{{__('Perjudicado')}}</option>
                </x-input.select>
            </x-input.group>
            <x-input.group for="affected.pivot.amount" label="{{ $affected->pivot['type'] == 'causante' ? __('Importe a reclamar') : __('Importe que reclama') }}" :error="$errors->first('affected.pivot.amount')" borderless>
                <x-input.money wire:model.lazy="affected.pivot.amount" :currency="$address->country->currency" id="affected.pivot.amount" :error="$errors->first('affected.pivot.amount')" />
            </x-input.group>
        </x-card.body>
        <div class="-mt-px flex divide-x divide-gray-200">
            <div class="w-0 flex-1 flex">
                <a href="#" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">

                    <div>
                        <span class="ml-3">{{__('Valoración de daños')}}</span>
                        @if($affected->pivot['type'] === 'causante')
                            <p class="text-xs text-gray-500 px-3">{{__('Total de daños cubiertos reclamables según la valoración')}}</p>
                        @else
                            <p class="text-xs text-gray-500 px-3">{{__('Total de daños cubiertos para este perjudicado según la valoración')}}</p>
                        @endif
                    </div>
                </a>
            </div>
            <div class="-ml-px w-0 flex-1 flex">
                <a href="#" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                    <span class="ml-3 text-xl font-bold"><x-output.currency value="{{ $totalValue }}" :currency="$expedient->currency()" /></span>
                </a>
            </div>
        </div>
    </div>
</div>
