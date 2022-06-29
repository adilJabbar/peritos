@props(['label'=>null])

<label class="flex items-center text-sm cursor-pointer">
    <input {{ $attributes }} type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 cursor-pointer border-gray-300">
    @if($label)
        <span class="ml-3 font-medium text-gray-900">{{__($label)}}</span>
    @endif
</label>
