<x-card.card>
    <div class="divide-gray-200 divide-y">

        <x-card.body>

            <x-input.group label="Name" for="ramo-name" class="sm:pt-0" borderless :error="$errors->first('ramo.name')">
                <x-input.text wire:model.lazy="ramo.name" id="ramo-name" :error="$errors->first('ramo.name')" placeholder="Name"/>
            </x-input.group>

            <x-input.group label="Icon" for="ramo.icon" :error="$errors->first('ramoNewIcon')" no-shadow borderless>
                <x-input.file wire:model="ramoNewIcon" id="ramo.icon">
                    <div class="h-32 w-full bg-white text-gray-300 flex items-center">
                        @if($ramoNewIcon)
                            <img class="max-h-32 mx-auto" src="{{ $ramoNewIcon->temporaryUrl() }}" alt="{{ __('Icon') }}">
                        @else
                            <img class="max-h-32 mx-auto" src="{{ $ramo->icon_url }}" alt="{{ __('Icon') }}">
                        @endif
                    </div>
                </x-input.file>
            </x-input.group>

            <x-input.group label="Preexistencia" for="ramo.preexistence_class_id" class="sm:pt-0" borderless :error="$errors->first('ramo.preexistence_class_id')">
                <x-input.select wire:model="ramo.preexistence_class_id" id="ramo.preexistence_class_id" :error="$errors->first('ramo.preexistence_class_id')">
                    <option disabled value="0">{{__('Select preexistence form...')}}</option>
                    @foreach(\App\Models\Admin\PreexistenceClass::all()->sortBy('name') as $preexistenceOption)
                        <option value="{{$preexistenceOption->id}}">{{ __($preexistenceOption->name) }}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>

            <x-input.group label="Producto por defecto" for="ramo.default_product_id" class="sm:pt-0" borderless :error="$errors->first('ramo.default_product_id')">
                <x-input.select wire:model="ramo.default_product_id" id="ramo.default_product_id" :error="$errors->first('ramo.default_product_id')" placeholder="Selecciona condicionado por defecto...">
                    @forelse($default_products->sortBy('name') as $productOption)
                        <option value="{{$productOption->id}}">{{ __($productOption->name) }}</option>
                    @empty
                        <option disabled>{{__('No hay definido ningún condicionado por defecto')}}</option>
                    @endforelse
                </x-input.select>
            </x-input.group>

        </x-card.body>
        <x-card.footer class="flex justify-end bg-gray-50 space-x-2">
            <x-button.danger wire:click="deleteRamo({{$ramo->id}})">{{__('Delete')}}</x-button.danger>
            <x-button.primary wire:click="saveRamo">{{__('Update')}}</x-button.primary>
        </x-card.footer>


    </div>
</x-card.card>
