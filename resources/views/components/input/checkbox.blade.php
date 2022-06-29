@props([
    'label' => null,
    'labelNotes' => null,
    'error' => false,
    'size' => 4,
    'justify' => null,
    'disabled' => false
   ])

<div class="flex items-start {{$justify ? 'justify-' . $justify : ''}}">
    <input {!! $attributes->merge([
        'class' => 'focus:ring-indigo-500 h-' . $size . ' w-' . $size . ' text-gray-800 border-gray-300 rounded' . ($error ? ' border-red-500' : ' border-gray-300 ' ) . ( $disabled ? ' bg-gray-200 ' : '')
    ]) !!}
        type="checkbox"

        {{ $disabled ? 'disabled' : ''}}
    />
    <div class="ml-3 text-sm">
        @if($label)
            <label for="comments" class="font-medium text-gray-700">{{ __($label) }}</label>
        @endif
        @if($labelNotes)
            <p class="text-gray-500">{{ __($labelNotes) }}</p>
        @endif
    </div>
</div>
