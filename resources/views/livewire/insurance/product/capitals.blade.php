<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('company.show', ['company' => $product->company_id]) }}">{{ $product->company->name }}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('company.show', ['company' => $product->company_id]) }}?showSubmenu=Products">{{ __('Productos') }}</x-breadcumb.item>
                <x-breadcumb.item>{{ $product->name }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Capitales') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <div>
    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            @include('partials.insurance.product.product_header')
            <x-input.group class="w-1/2" for="new-capital" :error="$errors->first('newCapital')"  borderless  >
                <div class="flex justify-between space-x-2">
                    <x-input.text wire:model.lazy="newCapital" id="new-capital" placeholder="{{ __('Añadir un nuevo capital en :country', ['country' => __($product->company->country->name)]) }}" :error="$errors->first('newCapital')"/>
                    <x-button.primary wire:click="addNewCapital" size="xs" ><x-icon.plus /></x-button.primary>
                </div>
            </x-input.group>
        </x-card.header>
        <div class="flex justify-around p-2 border-b border-gray-200">
            <div>{{__('Capital')}}</div>
            <div>{{__('Derogación Regla Proporcional')}}</div>
        </div>
        <x-card.body>
            <ul role="list" class="divide-y divide-gray-200">
                @forelse($capitals->sortBy('position') as $rowCapital)
                    <li class="py-4">
                        <livewire:insurance.product.capital :product="$product" :capital="$rowCapital" :key="'rowCapital' . $rowCapital->id " />

                    </li>
                @empty
                    <li class="py-4 flex">
                        <div class="">
                            <p class="text-sm font-medium text-gray-900">{{__('No hay ningún capital asegurable en :pais asociado al ramo :ramo', ['pais' => __($product->ramo->country->name), 'ramo' => __($product->ramo->name)])}}</p>
                        </div>
                    </li>
                @endforelse
            </ul>

        </x-card.body>
    </x-card.card>
</div>
</div>
