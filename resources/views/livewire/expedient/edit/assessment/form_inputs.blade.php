<div class="space-y-4">
    <div class="grid grid-cols-3 gap-4">
        <x-input.group label="Destino" for="destiny_id" :error="$errors->first('assessment.destiny_id')" borderless inline>
            <x-input.select wire:model="assessment.destiny_id" id="destiny_id" :error="$errors->first('assessment.destiny_id')" placeholder="Selecciona una opción...">
                @foreach(\App\Models\Admin\Destiny::all() as $destiny)
                    <option value="{{$destiny->id}}">{{ $destiny->name }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group label="Localización" for="person_id" :error="$errors->first('assessment.person_id')" borderless inline>
            <x-input.select wire:model="assessment.person_id" id="person_id" :error="$errors->first('assessment.person_id')" placeholder="Selecciona una opción...">
                <option value="{{$expedient->person->id}}">{{__('Asegurado')}}</option>
                @foreach($affecteds as $affected)
                    <option value="{{$affected->id}}">{{ $affected->name }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group label="Moneda" for="currency_id" :error="$errors->first('assessment.currency_id')" borderless inline>
            <x-input.select wire:model="assessment.currency_id" id="currency_id" :error="$errors->first('assessment.currency_id')" placeholder="Selecciona una opción..." readonly>
                @foreach(\App\Models\Admin\Currency::all() as $currencyOption)
                    <option value="{{$currencyOption->id}}">{{ $currencyOption->name . ' ' . $currencyOption->currency }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>
{{--    </div>--}}
{{--    <div class="grid grid-cols-3 gap-4">--}}

        @if($expedient->policy)
            <x-input.group label="Capital" for="capital" :error="$errors->first('assessment.capital_id')" borderless inline>
                <x-input.select wire:model="assessment.capital_id" id="capital" :error="$errors->first('assessment.capital_id')" placeholder="Selecciona una opción...">
                    @foreach($expedient->policy->capitals->sortBy('position') as $capital)
                        <option value="{{$capital->id}}">{{ $capital->name }}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>
        @endif

        <x-input.group label="Garantía" for="guarantee" :error="$errors->first('guarantee')" borderless inline>
            <x-input.select wire:model="guarantee" id="guarantee" :error="$errors->first('guarantee')" placeholder="Selecciona una opción...">
                @foreach($guarantees as $guarantee)
                    <option value="{{$guarantee->id}}">{{ $guarantee->name }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <x-input.group label="SubGarantía" for="subguarantee_id" :error="$errors->first('assessment.subguarantee_id')" borderless inline>
            <x-input.select wire:model="assessment.subguarantee_id" id="subguarantee_id" :error="$errors->first('assessment.garantia')" placeholder="Selecciona una opción...">
                @foreach($subguarantees as $subguarantee)
                    <option value="{{$subguarantee->id}}">{{ $subguarantee->name }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>

    </div>

    <x-input.group label="Descripción" for="description" :error="$errors->first('assessment.description')" borderless inline>
        <div class="flex shadow-sm w-full">
            <div class="w-full relative">
                <textarea class="rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full px-3 py-2 sm:text-sm border-gray-300" wire:model.lazy="assessment.description" id="description" rows="4" placeholder="Descripción"></textarea>
            </div>
        </div>
    </x-input.group>

    <x-input.group for="description" :error="$errors->first('assessment.origin')" borderless inline>
        <x-input.text wire:model.lazy="assessment.origin" id="origin" placeholder="Fuente" :error="$errors->first('assessment.origin')" />
    </x-input.group>

    <x-table.table>
        <x-slot name="head">
            <x-table.heading class="w-1/3">{{__('Unidades')}}</x-table.heading>
            <x-table.heading class="w-1/3">{{__('Precio Unitario')}}</x-table.heading>
            <x-table.heading class="w-1/3">{{__('Total')}}</x-table.heading>
        </x-slot>
        <x-slot name="body">
            <x-table.row>
                <x-table.cell no-padding>
                    <x-input.text type="number" class="text-center" wire:model.lazy="assessment.unit" id="unit" placeholder="Unidades" :error="$errors->first('assessment.unit')" />
                </x-table.cell>
                <x-table.cell no-padding>
                    <x-input.money wire:model.lazy="assessment.unit_price" id="unit_price" placeholder="Precio Unitario" :currency="$assessment->currency" :error="$errors->first('assessment.unit_price')" />
                </x-table.cell>
                <x-table.cell class="text-right px-4" no-padding>
                    <x-output.currency class="font-bold" value="{{ $assessment->subtotal }}" :currency="$assessment->currency" />
                </x-table.cell>
            </x-table.row>
            <x-table.row>
                <x-table.cell class="text-right px-4" no-padding>
                    <div class="flex justify-around items-center">
                        <x-input.checkbox wire:model="assessment.taxes" value="{{$expedient->address->country->taxes}}" />
                        <span>{{__('% Impuestos')}}</span>
                    </div>
                </x-table.cell>

                <x-table.cell no-padding>
                    <x-input.text wire:model.lazy="assessment.taxes" id="taxes" class="text-right" type="number" step="0.01" placeholder="% de impuestos aplicable" :error="$errors->first('assessment.taxes')" />
                </x-table.cell>

                <x-table.cell class="text-right px-4" no-padding>
                    <x-output.currency value="{{ $assessment->subtotal_taxes }}" :currency="$assessment->currency" />
                </x-table.cell>
            </x-table.row>
            <x-table.row height="41px">
                <x-table.cell class="text-right px-4" colspan="2" no-padding>
                    <span>{{__('Valor de reposición')}}</span>
                </x-table.cell>
                <x-table.cell class="text-right px-4" no-padding>
                    <x-output.currency class="font-bold" value="{{ $assessment->total }}" :currency="$assessment->currency" />
                </x-table.cell>
            </x-table.row>
        </x-slot>
    </x-table.table>

{{--    Deprecation--}}
{{--    <x-card.header>{{__('Depreciación')}}</x-card.header>--}}

    <x-table.table>
        <x-slot name="head">
            <x-table.heading class="w-1/3">{{__('Tipo de depreciación')}}</x-table.heading>
            <x-table.heading class="w-1/3">{{ $assessment->deprecationgroup_id == '' ? 'Porcentaje' : 'Años de antigüedad' }}</x-table.heading>
            <x-table.heading class="w-1/3">{{__('Total')}}</x-table.heading>
        </x-slot>
        <x-slot name="body">
            <x-table.row>
                <x-table.cell no-padding>
                    <x-input.select wire:model="assessment.deprecationgroup_id" id="deprecationgroup_id" :error="$errors->first('assessment.deprecationgroup_id')" placeholder="Selecciona una opción...">
                        <option value="0">{{__('Depreciación porcentual')}}</option>
                        @foreach($deprecationgroups->sortBy('name') as $deprecationgroup)
                            <option value="{{$deprecationgroup->id}}">{{ $deprecationgroup->name }}</option>
                        @endforeach]
                    </x-input.select>
                </x-table.cell>
                <x-table.cell no-padding>
                    <x-input.text wire:model.lazy="assessment.deprecation" id="deprecation" class="text-right" type="number" placeholder="{{ $assessment->deprecationgroup_id == '' ? '% a devaluar' : 'Años de antigüedad' }}" :error="$errors->first('assessment.deprecation')" />
                </x-table.cell>
                <x-table.cell class="text-right px-4" no-padding>
                    <x-output.currency class="font-bold" value="{{ $assessment->total_deprecated}}" :currency="$assessment->currency" />
                </x-table.cell>
            </x-table.row>
            <x-table.row height="41px">
                <x-table.cell class="text-right px-4" colspan="2" no-padding>
                    <span>{{__('Valor real')}}</span>
                </x-table.cell>
                <x-table.cell class="text-right px-4" no-padding>
                    <x-output.currency class="font-bold" value="{{ $assessment->total - $assessment->total_deprecated}}" :currency="$assessment->currency" />
                </x-table.cell>
            </x-table.row>
        </x-slot>
    </x-table.table>

</div>
