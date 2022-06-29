@props([
    'type' => 'text',
    'id',
    'error' => false,
    'placeholder' => null,
    'readonly' => false,
    'rows' => 3
    ])

<div class="flex shadow-sm w-full">
    <div class="w-full relative">
        <textarea
            {{ $attributes->merge(['class' => 'flex-1 block w-full px-3 py-2 rounded-md sm:text-sm border-gray-300 ' . ($error ? ' pr-10 border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 ' : ' border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 ') . ($readonly ? ' bg-gray-200 ' : '')]) }}
            id="{{ $id }}"
            type="{{$type}}"
            rows="{{$rows}}"
            @if ($placeholder)
            placeholder="{{ __($placeholder) }}"
            @endif
            @if ($readonly)
            readonly
            @endif
        ></textarea>
        @if ($error)
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
        @endif
    </div>
</div>
