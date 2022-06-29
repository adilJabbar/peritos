@props(['modal' => null])

<div class="flex flex-col bg-white shadow rounded-lg divide-y divide-gray-200 {{ $modal ? 'h-full overflow-hidden' : 'h-full' }} ">
    <x-card.header>{{ $header }}</x-card.header>
    <x-card.body>{{ $slot }}</x-card.body>
</div>
