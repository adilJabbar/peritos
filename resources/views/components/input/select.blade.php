@props([
    'placeholder' => null,
    'trailingAddOn' => null,
    'error' => false,
    'readonly' => false,
    'id' => false,
    'divClass' => null
])

<div class="flex {{$divClass}}">
  <select {{ $attributes->merge(['class' => ' rounded-md form-select block w-full pl-3 pr-10 py-2 text-base leading-6 sm:text-sm sm:leading-5' . ( $error ? ' border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 ' : ' border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 ') . ($trailingAddOn ? ' rounded-r- ' : '') . ($readonly ? 'bg-gray-200' : '') ]) }}
      @if ($id)
          id="{{$id}}"
      @endif
      @if ($readonly)
          disabled
      @endif
  >
    @if ($placeholder)
        <option disabled value="">{{ __($placeholder) }}</option>
    @endif

    {{ $slot }}
  </select>

  @if ($trailingAddOn)
    {{ $trailingAddOn }}
  @endif
</div>
