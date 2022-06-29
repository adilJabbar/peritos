<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                @if($product->company_id !== 0)
                    <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                    <x-breadcumb.item link="{{ route('company.show', ['company' => $product->company_id]) }}">{{ $product->company->name }}</x-breadcumb.item>
                    <x-breadcumb.item link="{{ route('company.show', ['company' => $product->company_id]) }}?showSubmenu=Products">{{ __('Productos') }}</x-breadcumb.item>
                @else
                    <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Products">{{ __('Condicionados por defecto') }}</x-breadcumb.item>
                @endif
                <x-breadcumb.item>{{ $product->name }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Garantías') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>


    <x-card.card class="divide-y divide-gray-200">
    <x-card.header>
        @include('partials.insurance.product.product_header')
        <x-input.group class="flex w-1/2" for="new-guarantee" :error="$errors->first('newGuarantee')" borderless>
            <div class="flex justify-between space-x-2">
                <x-input.text wire:model="newGuarantee" id="new-guarantee" placeholder="{{ __('Añadir una nueva garantia a :product', ['product' => __($product->name)]) }}"  :error="$errors->first('newGuarantee')" />
                <x-button.primary wire:click="addNewGuarantee" size="xs" ><x-icon.plus /></x-button.primary>
            </div>
        </x-input.group>
    </x-card.header>
    <div class="grid grid-cols-4 gap-4">
        <div>
            <nav class="divide-gray-200 divide-y border-r border-gray-200 border-b">
                @forelse($product->guarantees as $guaranteeRow)
                <div wire:click="$set('guaranteeSelectedId', {{$guaranteeRow->id}})" class="px-4 py-2 hover:bg-primary hover:text-white cursor-pointer {{ $guaranteeSelected->id === $guaranteeRow->id ? 'bg-secondary text-white' : 'text-gray-600' }}">{{ $guaranteeRow->name }}</div>
                @empty
                <div class="px-4 py-2 col-span-4 text-gray-600">{{__('No hay ninguna garantia disponible para este producto')}}</div>
                @endforelse
            </nav>
        </div>
        <div class="col-span-3 pt-4 pr-4 pb-4">
            @if($guaranteeSelected->getKey())
                <livewire:insurance.product.guarantee :guarantee="$guaranteeSelected" />
            @endif
        </div>
    </div>
</x-card.card>
</div>
