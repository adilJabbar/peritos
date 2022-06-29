<div>
    <x-card.card class="border border-primary">
        <x-card.header class="bg-primary text-white">
            <h3 class="text-lg leading-6 font-medium">
                <strong>{{__('Generar un nuevo avance') }}</strong>
            </h3>
        </x-card.header>
        <x-card.body>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <div class="bg-primary-lightest px-4 py-1 rounded-t-md">
                        <h4 class="text-white">{{__('Contenido del avance')}}</h4>
                    </div>

                    <x-input.group for="advance-date" label="Fecha del documento" borderless :error="$errors->first('advanceDate')">
                        <x-input.text wire:model.lazy="advanceDate" type="date" id="advance-date" placeholder="Fecha a imprimir en el documento" />
                    </x-input.group>

                    <x-input.group for="advance-documentVersion" label="Modelo de avance" borderless :error="$errors->first('advanceTemplate')">
                        <x-input.select wire:model="advanceTemplate" id="advance-documentVersion" placeholder="Selecciona la plantilla">
                            @foreach($templates as $option)
                                <option value="{{$option->id}}">{{__($option->name)}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="advance-text" label="Texto del avance" :error="$errors->first('text')"  borderless >
                        <x-input.rich-text wire:model.lazy="text" id="advance-text" :error="$errors->first('text')" />
                    </x-input.group>

                    <x-input.group for="reserve" label="Reserva Estimada" borderless :error="$errors->first('reserve')">
                        <x-input.money wire:model="reserve" id="reserve" :error="$errors->first('reserve')" placeholder="Importe estimado de la reserva" :currency="$expedient->currency()" />
                    </x-input.group>

                    <x-input.group for="include-advance-history" label="Incluir histórico" borderless :error="$errors->first('includeAdvanceHistory')">
                        <x-input.checkbox size="6" wire:model="includeAdvanceHistory" id="include-advance-history"></x-input.checkbox>
                    </x-input.group>

                    <x-input.group for="watermark" label="Marca de agua" borderless :error="$errors->first('watermark')">
                        <x-input.select wire:model="watermark" id="watermark" placeholder="Selecciona la marca de agua que quieres incluir">
                            <option value="null">{{__('Sin marca de agua')}}</option>
                            <option value="CONFIDENTIAL">{{__('Confidencial')}}</option>
                            <option value="DRAFT">{{__('Borrador')}}</option>
                            <option value="DUPLICATE">{{__('Duplicado')}}</option>
                        </x-input.select>
                    </x-input.group>

                </div>

                <div>
                    @if($pictures)
                        <div class="divide-gray-200 divide-y">
                            <div class="bg-primary-lightest px-4 py-1 rounded-t-md">
                                <h4 class="text-white">{{__('Imágenes a incluir en el avance')}}</h4>
                            </div>
                            <div class="space-y-4 divide-primary-lightest divide-y">
                                {{--                                        @dd($expedient->pictures->where('avance', 1))--}}
                            @forelse($pictures as $picture)
                                    <livewire:gallery.list-image :image="$picture" :key="'image-grid-'.$picture->id" :deletable="false" :size="32" />
                                @empty
                                @endforelse
                            </div>
                        </div>

                    @endif
                </div>

            </div>
            <div class="flex justify-end mt-4">
                <x-button.primary wire:click="generateAdvance">{{__('Generar un nuevo avance')}}</x-button.primary>
            </div>
        </x-card.body>

    </x-card.card>
</div>
