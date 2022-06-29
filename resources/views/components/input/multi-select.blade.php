<div
    x-data="{ selectedValues: @entangle($attributes->wire('model'))}"
    x-init="() => {
        var choices = new Choices($refs.{{ $attributes['prettyname'] }}, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
        });
        choices.passedElement.element.addEventListener(
            'change',
            function(event) {
{{--                values = selectedValues;--}}
{{--                @this.set('{{ $attributes['wire:model'] }}', values);--}}
                selectedValues = getSelectValues($refs.{{ $attributes['prettyname'] }});
            },
            false,
        );

        if(Array.isArray(selectedValues)){
            selectedValues.forEach(function(select) {
                choices.setChoiceByValue((select).toString());
            });
        }
	}
    function getSelectValues(select) {
        var result = [];
        var options = select && select.options;
        console.log(options);
        var opt;
        for (var i=0, iLen=options.length; i<iLen; i++) {
            opt = options[i];
            if (opt.selected) {
                result.push(opt.value || opt.text);
            }
        }
        return result;
	}
	">
    <select id="{{ $attributes['prettyname'] }}" wire-model="{{ $attributes['wire:model'] }}" wire:change="{{ $attributes['wire:change'] }}" x-ref="{{ $attributes['prettyname'] }}" multiple="multiple">
        @if(count($attributes['options'])>0)
            @foreach($attributes['options'] as $key=>$option)
                <option value="{{ $key }}" >{{ __($option) }}</option>
            @endforeach
        @endif
    </select>
</div>

