@props(['id' => null,
    'maxWidth' => null,
    'unClosable' => false
    ])

<x-modal.modal :id="$id" :maxWidth="$maxWidth" :unClosable="$unClosable" {{ $attributes->merge(['class' => 'overflow-auto ']) }} >

    <x-card.card-with-header-and-footer modal>
        <x-slot name="header">
            {{ $title }}
        </x-slot>

        {{ $content }}

        <x-slot name="footer">
            {{ $footer }}
        </x-slot>
    </x-card.card-with-header-and-footer>

</x-modal.modal>
