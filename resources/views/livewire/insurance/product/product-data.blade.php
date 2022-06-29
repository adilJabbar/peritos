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
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>

    <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            <h3>{{$product->name}}</h3>
        </x-card.header>
        <x-card.body>
            <div class="space-y-4">
                @if($product->company_id !== 0)
                <x-input.group for="new-product-ramo" label="Ramo" borderless :error="$errors->first('product.ramo_id')">
                    <x-input.select wire:model.lazy="product.ramo_id" id="new-product-ramo" placeholder="Selecciona un ramo"  :error="$errors->first('product.ramo_id')">
                        @forelse($company->ramos as $ramoRow)
                            <option value="{{$ramoRow->id}}">{{__($ramoRow->name)}}</option>
                        @empty
                        @endforelse
                    </x-input.select>
                </x-input.group>
                @endif
                <x-input.group for="new-product-name" label="Nombre del producto" borderless :error="$errors->first('product.name')">
                    <x-input.text wire:model="product.name" id="new-product-name" placeholder="Introduce el nombre del producto" :error="$errors->first('product.name')"/>
                </x-input.group>

                <x-input.group for="new-product-code" label="Código del producto" borderless :error="$errors->first('product.code')">
                    <x-input.text wire:model="product.code" id="new-product-code" placeholder="Introduce la referencia de la compañía para este producto" :error="$errors->first('product.code')"/>
                </x-input.group>

                <x-input.group for="new-product-current_version" label="Versión actual" borderless :error="$errors->first('product.current_version')">
                    <x-input.text wire:model="product.current_version" id="new-product-current_version" placeholder="Introduce la versión actual de este producto" :error="$errors->first('product.current_version')"/>
                </x-input.group>

                <x-input.group for="new-product-notes" label="Notas" borderless :error="$errors->first('product.notes')">
                    <x-input.textarea wire:model="product.notes" id="new-product-notes" placeholder="Notas" :error="$errors->first('product.notes')" />
                </x-input.group>

                <x-input.group label="Condiciones Generales" for="condGeneral"  :error="$errors->first('condGeneral')" wire:key="condGeneral" borderless :error="$errors->first('condGeneral')">
                    <div class="space-y-2">
                        @if($product->cond_general)
                            <div class="flex space-x-2">
                                <div class="flex-shrink-0">
                                    <a href="{{$product->url_cond_general}}" target="_blank">
                                        <img class="max-h-8" src="{{$product->icon}}" alt="{{__('Condiciones particulares')}}">
                                    </a>

                                </div>
                                <input type="text" class="flex-1 block w-full px-3 py-2 sm:text-sm border-gray-300 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-200" value="{{__('Condiciones Generales')}}" readonly/>
                                <x-button.danger wire:click="removeCondGeneral" size="sm">
                                    <x-icon.minus-sm size="4" />
                                </x-button.danger>
                            </div>
                        @endif
                        <x-input.filepond wire:model="condGeneral" id="condGeneral" validation="'application/pdf'"  :error="$errors->first('condGeneral')"/>
                    </div>
                </x-input.group>
            </div>
        </x-card.body>
        <x-card.footer class="flex justify-end">
            <x-button.primary wire:click="save">{{__('Actualizar')}}</x-button.primary>
        </x-card.footer>
    </x-card.card>
</div>
