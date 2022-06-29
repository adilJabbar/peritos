<div>
    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header >
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{__('Condicionados disponibles por defecto')}}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{__('Condicionados Generales para ser utilizados por defectos en cada uno de los ramos.')}}
                </p>
            </div>
            <x-input.group for="new-product" borderless :error="$errors->first('newProduct')">
                <div class="flex-shrink-0 flex space-x-2">
                    <x-input.text wire:model="newProduct" id="new-product" placeholder="Nombre del nuevo producto" :error="$errors->first('newProduct')"/>
                    <x-button.primary wire:click="create"><x-icon.plus size="4" /></x-button.primary>
                </div>
            </x-input.group>
        </x-card.header>
        <x-card.body>
            <x-table.table>
                <x-slot name="head">
                    <x-table.heading>{{__('Nombre')}}</x-table.heading>
                    <x-table.heading>{{__('Usado en...')}}</x-table.heading>
                    <x-table.heading></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($products->sortBy('name') as $productRow)
                        <x-table.row>
                            <x-table.cell>{{$productRow->name}}</x-table.cell>
                            <x-table.cell></x-table.cell>
                            <x-table.cell class="text-right">
                                <a href="{{route('default_product.show', $productRow->id)}}">
                                    <x-button.primary size="xs"><x-icon.eye /></x-button.primary>
                                </a>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="3" class="text-center">
                            {{__('No hay ningun producto definido como por defecto')}}
                        </x-table.cell>
                    </x-table.row>
                    @endforelse

                </x-slot>
            </x-table.table>
        </x-card.body>
    </x-card.card>

{{--    @include()--}}
</div>
