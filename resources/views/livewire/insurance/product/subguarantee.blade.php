<div>
    @if($subguarantee->getKey())
        <x-input.group for="subguarantee-name" label="Nombre" :error="$errors->first('subguarantee.name')" borderless>
            <x-input.text wire:model="subguarantee.name" id="subguarantee-name" :error="$errors->first('subguarantee.name')" placeholder="Introduce el nombre"/>
        </x-input.group>

        <x-input.group for="subguarantee-coverage" label="Tipo de Cobertura" borderless>
            <div class="flex space-x-4">
                <x-input.select wire:model="subguarantee.coverage" divClass="flex-grow" id="subguarantee.coverage" :error="$errors->first('subguarantee.coverage')">
                    <option value="total">{{__('Valor Total')}}</option>
                    <option value="partial">{{__('Valor Parcial')}}</option>
                    <option value="primer riesgo">{{__('Primer Riesgo')}}</option>
                </x-input.select>
                @if($subguarantee->coverage === 'partial')
                    <x-input.text wire:model.lazy="percent" id="subguarantee-percent" type="number" step="5" placeholder="% parcial" :fullWidth="false" />
                @endif
            </div>
        </x-input.group>

        <x-input.group for="subguarantee-included" label="Incluida " :error="$errors->first('subguarantee.included')">
            <div class="flex">
                <x-input.checkbox wire:model="subguarantee.included" class="mt-1" size="7" />
            </div>
        </x-input.group>

        <x-input.group for="subguarantee-required-capital" label="Capital Requerido " :error="$errors->first('subguarantee.required_capital')">
            <div class="flex">
                <x-input.select wire:model="subguarantee.required_capital" divClass="flex-grow" id="subguarantee-required-capital" :error="$errors->first('subguarantee.required_capital')" >
                    <option value="continente">{{__('Continente')}}</option>
                    <option value="contenido">{{__('Contenido')}}</option>
                    <option value="">{{__('Ningún capital requerido')}}</option>
                </x-input.select>
            </div>
        </x-input.group>

        <x-input.group for="subguarantee-limit" label="Limite" :error="$errors->first('subguarantee.name')">
            <div class="flex">
                <x-input.checkbox wire:model="hasLimit" class="mt-1" size="7" />
                @if($hasLimit)
                    <div class="flex-grow space-y-2">
                        <x-input.group for="subguarantee-percent_limit" label="Porcentaje" :error="$errors->first('subguarantee.percent_limit')" borderless paddingless>
                            <x-input.text wire:model.lazy="subguarantee.percent_limit" id="subguarantee-percent_limit" type="number" placeholder="% límite" fullWidth/>
                        </x-input.group>

                        <x-input.group for="subguarantee-limit" label="Límite" :error="$errors->first('subguarantee.limit')" borderless paddingless>
                            <x-input.text wire:model.lazy="subguarantee.limit" id="subguarantee-limit" type="number" placeholder="Limite" fullWidth/>
                        </x-input.group>
                    </div>
                @endif
            </div>
        </x-input.group>

        <x-input.group for="subguarantee-hasDeductible" label="Franquicia">
            <div class="flex">
                <x-input.checkbox wire:model="hasDeductible" class="mt-1" size="7" />
                @if($hasDeductible)
                    <div class="flex-grow space-y-2">
                        <x-input.group for="subguarantee-percent_deductible" label="Porcentaje" :error="$errors->first('subguarantee.percent_deductible')" borderless paddingless>
                            <x-input.text wire:model="subguarantee.percent_deductible" id="subguarantee-percent_deductible" type="number" placeholder="% Franquicia" fullWidth/>
                        </x-input.group>

                        <x-input.group for="subguarantee-min_deductible" label="Mínimo" :error="$errors->first('subguarantee.min_deductible')" borderless paddingless>
                            <x-input.text wire:model="subguarantee.min_deductible" id="subguarantee-min_deductible" type="number" placeholder="Mínimo" fullWidth/>
                        </x-input.group>

                        <x-input.group for="subguarantee-max_deductible" label="Máximo" :error="$errors->first('subguarantee.max_deductible')" borderless paddingless>
                            <x-input.text wire:model="subguarantee.max_deductible" id="subguarantee-max_deductible" type="number" placeholder="Máximo" fullWidth/>
                        </x-input.group>

                    </div>
                @endif
            </div>
        </x-input.group>

        <x-input.group for="subguarantee-notes" label="Notas" :error="$errors->first('subguarantee.notes')" inline>
            <x-input.textarea wire:model="subguarantee.notes" id="subguarantee-notes" placeholder="Notas e instrucciones para esta subgarantía" :error="$errors->first('subguarantee.notes')" :rows="6"/>
        </x-input.group>



    @endif
{{--    <div class="flex justify-end">--}}
{{--        @if($subguarantee->isDirty())--}}
{{--            <x-button.primary wire:click="saveChanges" size="xs" class="flex px-2">--}}
{{--                <x-icon.save size="5" /><span class="ml-2">{{__('Actualizar')}}</span></x-button.primary>--}}
{{--        @endif--}}
{{--    </div>--}}
</div>
