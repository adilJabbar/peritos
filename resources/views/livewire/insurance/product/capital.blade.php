<div class="flex justify-between items-center">
    <div class="flex">
        <x-input.checkbox size="5" wire:model="selected" value="{{ $capital->id }}"/>
        <p class="text-sm font-medium text-gray-900">{{$capital->name}}</p>
    </div>
    {{--                            <img class="h-10 w-10 rounded-full" src="{{asset($rowRamo->icon_url)}}" alt="{{$rowRamo->name}}">--}}
    <div class="ml-3 flex justify-end items-center space-x-2">
        <x-input.checkbox size="5" wire:model="conditions.derog_reg_prop" />

        <x-input.text wire:model.lazy="conditions.derog_amount" type="number" id="derog-amount" placeholder="Límite Derogación Regla Proporcional" :readonly="!$conditions['derog_reg_prop']"/>

        <x-input.text wire:model.lazy="conditions.derog_percent" type="number" id="derog-percent" placeholder="% Derogación Regla Proporcional"  :readonly="!$conditions['derog_reg_prop']"/>
        {{--                                <p class="text-sm text-gray-500">({{__($rowRamo->country->name)}})</p>--}}
    </div>
</div>
