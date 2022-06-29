<form wire:submit.prevent="save">
    <x-modal.dialog wire:model.defer="showNewProductModal" class="w-full  overflow-auto" max-width="4xl" un-closable>

        <x-slot name="title">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('Añadir un producto') }}
            </h3>
            <x-button.close wire:click="$set('showNewProductModal', false)" />
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <x-input.group for="new-product-ramo" label="Ramo" borderless :error="$errors->first('product.ramo_id')">
                    <x-input.select wire:model.lazy="product.ramo_id" id="new-product-ramo" placeholder="Selecciona un ramo"  :error="$errors->first('product.ramo_id')">
                        @forelse($company->ramos as $ramoRow)
                            <option value="{{$ramoRow->id}}">{{__($ramoRow->name)}}</option>
                        @empty
                        @endforelse
                    </x-input.select>
                </x-input.group>

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

        </x-slot>

        <x-slot name="footer">
            <div class="w-full flex justify-end">
                <div>
                    @can('product.create')
                        <x-button.secondary wire:click="$set('showNewProductModal', false)">{{__('Cancel')}}</x-button.secondary>
                        <x-button.primary type="submit">{{__('Save')}}</x-button.primary>
                    @else
                        <x-button.secondary wire:click="$set('showNewProductModal', false)">{{__('Cerrar')}}</x-button.secondary>
                    @endcan
                </div>
            </div>

        </x-slot>

    </x-modal.dialog>
</form>
