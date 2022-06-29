@props(['modal' => null])

<div class="flex flex-col bg-white shadow rounded-lg divide-y divide-gray-200 {{ $modal ? 'h-full  overflow-hidden' : '' }} ">
    <div class="p-3 sm:px-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
        {{ $header }}
    </div>
    <div class="p-4 sm:px-6 flex-1 overflow-y-auto">
        {{ $slot }}
    </div>
    <div class="p-4 sm:px-6 {{ $modal ? ' bg-gray-100 text-right space-x-2' : '' }}">
        {{ $footer }}
    </div>
</div>
