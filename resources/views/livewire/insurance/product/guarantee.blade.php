<x-card.card>
    <x-card.body class="space-y-2">
        <div class="grid grid-cols-2 gap-4">
            <x-input.group for="guarantee-name" borderless inline label="Garantia" :error="$errors->first('guarantee.name')">
                <div class="flex justify-between space-x-2">
                    <x-input.text wire:model.lazy="guarantee.name" id="guarantee-name" placeholder="Nombre de la garantia" />
                </div>
            </x-input.group>
            <x-input.group for="new-subguarantee" borderless :error="$errors->first('guarantee.name')" inline label="Añadir subgarantia" >
                <div class="flex justify-between space-x-2">
                    <x-input.text wire:model="newSubguarantee" id="new-subguarantee" placeholder="{{__('Añadir nueva subgarantía a :garantia', ['garantia' => __($guarantee->name)] )}}" />
                    <x-button.primary wire:click="addNewSubguarantee" size="xs" ><x-icon.plus /></x-button.primary>
                </div>
            </x-input.group>

            <div class="col-span-2 space-y-2">

{{--                <x-input.group for="chronology" label="Cronología de lo ocurrido" :error="$errors->first('textAdjuster.chronology')"  borderless >--}}
{{--                    <x-input.rich-text  id="chronology" :error="$errors->first('textAdjuster.chronology')" />--}}
{{--                </x-input.group>--}}

{{--                <x-input.group for="adjuster" label="Intervención pericial" :error="$errors->first('textAdjuster.adjuster')"  borderless >--}}
{{--                    <x-input.rich-text  id="adjuster" :error="$errors->first('textAdjuster.adjuster')" />--}}
{{--                </x-input.group>--}}

                <x-input.group for="guarantee-notes" borderless :error="$errors->first('guarantee.notes')" inline label="Notas" >
{{--                    <div class="flex justify-between space-x-2 flex-grow">--}}
                        <x-input.rich-text wire:model.lazy="guarantee.notes" id="guarantee-notes" placeholder="{{__('Notas de esta garantía')}}" :error="$errors->first('guarantee.notes')"/>
{{--                    </div>--}}
                </x-input.group>

                <x-input.group for="guarantee-exclusions" borderless :error="$errors->first('guarantee.exclusions')" inline label="Exclusiones" >
{{--                    <div class="flex justify-between space-x-2 flex-grow">--}}
                        <x-input.rich-text wire:model.lazy="guarantee.exclusions" id="guarantee-exclusions" placeholder="{{__('Exclusiones de esta garantía')}}" :error="$errors->first('guarantee.exclusions')"/>
{{--                    </div>--}}
                </x-input.group>

            </div>
        </div>

        <div class="space-y-4">
            @if($guarantee->subguarantees->count() > 0)
            <div>
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">{{__('Selecciona una subgarantia')}}</label>

                    <select id="tabs" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                        @foreach($guarantee->subguarantees as $subguaranteeRow)
                            <option value="{{$subguaranteeRow->id}}">{{ $subguaranteeRow->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="hidden sm:block">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex justify-between" aria-label="Tabs">

                        @foreach($guarantee->subguarantees as $subguaranteeRow)
                                <div wire:click="$set('activeSubguarantee', {{$subguaranteeRow->id}})" class="flex-grow py-4 px-1 text-center border-b-2 font-medium text-sm cursor-pointer {{$activeSubguarantee === $subguaranteeRow->id ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'}}">
                                    {{ __($subguaranteeRow->name) }}
                                </div>
                        @endforeach
                        </nav>
                    </div>
                </div>
            </div>

            <div>
                <livewire:insurance.product.subguarantee :subguarantee="$subguarantee" />
            </div>

            @else
            <div class="p-4 text-gray-500">
                {{__('No hay ninguna subgarantia para esta garantia')}}
            </div>
            @endif
        </div>

    </x-card.body>
</x-card.card>
