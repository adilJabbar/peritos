<div {{ $attributes->merge(['class' => ' bg-white overflow-hidden shadow sm:rounded-lg ']) }}>
    <ul class="divide-y divide-gray-200">
        {{ $slot }}
    </ul>
</div>
