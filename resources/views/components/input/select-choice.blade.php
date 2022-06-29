@props(['options' => [], 'optionSelected' => ''])

{{--@dd($attributes['options'])--}}
<div wire:ignore>
    <div
        x-data="{ value: @entangle($attributes->wire('model'))}"
        x-init="() => {
            var choices = new Choices($refs.{{ $attributes['prettyname'] }}, {
                itemSelectText: '',
            });
            choices.passedElement.element.addEventListener(
              'change',
              function(event) {
                    value = event.detail.value;
{{--                    @this.set('{{ $attributes['wire:model'] }}', values);--}}
              },
              false,
            );
            let selected = (value);
            choices.setChoiceByValue(value);
            console.log (value);
        }"
    >
        <select
            id="{{ $attributes['prettyname'] }}"
            wire-model="{{ $attributes['wire:model'] }}"
            wire:change="{{ $attributes['wire:change'] }}"
            x-ref="{{ $attributes['prettyname'] }}"
        >
            <option value="">{{ isset($attributes['placeholder']) ? __($attributes['placeholder']) . $attributes['optionselected'] : __('-- Choose an option --') }}</option>
{{--            @dd($attributes['options'])--}}
            @if(count($options)>0)
                @foreach($options as $key => $option)
                    <option value="{{$key}}" >{{ __($option) }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
