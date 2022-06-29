<div>

    <x-input.group for="policy.reference"  wire:key="policy.reference" label="Número de póliza" :error="$errors->first('policy.reference')" borderless>
        <x-input.text wire:model.lazy="policy.reference" id="policy.reference" :error="$errors->first('policy.reference')" placeholder="Número o referencia de la póliza" />
    </x-input.group>

    <x-input.group for="ramo" label="Ramo" :error="$errors->first('expedient.ramo_id')" borderless wire:key="ramo-select">
        <x-input.select wire:model="expedient.ramo_id" id="ramo"
                        placeholder="Selecciona un ramo..."
                        :error="$errors->first('expedient.ramo_id')">
            @if($company)
                @foreach($company->ramos as $ramoOption)
                    <option value="{{ $ramoOption->id }}">{{__($ramoOption->name)}}</option>
                @endforeach
            @else
                <option value="" disabled>{{__('Tienes que seleccionar una compañía')}}</option>
            @endif
        </x-input.select>
    </x-input.group>

    @if($ramo)
        <x-input.group for="product" label="Producto" :error="$errors->first('policy.product_id')" borderless wire:key="producto-select">
            <x-input.select wire:model="policy.product_id" id="product"
                            placeholder="Selecciona un producto..."
                            :error="$errors->first('policy.product_id')">
{{--                @if($ramo->products)--}}
{{--                @dd($ramo->products->where('company_id', $company->id))--}}
                @forelse($ramo->products->where('company_id', $company->id)->sortBy('name') as $productOption)
                    <option value="{{ $productOption->id }}">{{__($productOption->name)}}</option>
                @empty
                    @if($ramo)
                        <option value="" disabled>{{__('Esta compañía no tiene productos asociados a este ramo')}}</option>
                    @else
                        <option value="" disabled>{{__('Tienes que seleccionar un ramo')}}</option>
                    @endif
                @endforelse
{{--                <option value="{{ $ramo->default_product_id }}">({{__('Condicionado por defecto para :ramo', ['ramo' => __($ramo->name)]) . ': ' .$ramo->defaultProduct->name}})</option>--}}

            </x-input.select>
        </x-input.group>
    @endif

</div>
