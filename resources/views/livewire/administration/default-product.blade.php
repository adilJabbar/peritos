<x-layout.two-columns>
    <x-slot name="title">
        {{__('Product')}}
    </x-slot>

    <x-slot name="primary">
        <div class="pt-2 px-2 flex justify-between space-x-2 overflow-auto">
            <x-button.header_menu :menu="''" :showSubMenu="$showSubmenu">{{__('Datos')}}</x-button.header_menu>
            <x-button.header_menu :menu="'Guarantees'" :showSubMenu="$showSubmenu">{{__('Garantías')}}</x-button.header_menu>
        </div>
    </x-slot>

    <x-slot name="secondary">

        <nav aria-label="Sidebar">
            <div class="space-y-1" :key="$gabinete->id . 'nav-area'">

                <h3  wire:click="$set('showSubmenu', '')" class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400 cursor-pointer" id="expedient-headline">
                    <span class="text-sm">{{ __('Condicionado por defecto') }}</span>
                    <p class="font-bold">{{$product->name}}</p>
                </h3>
                <x-administration.menu-item label="Garantías" icon="shield-check" name="Guarantees" badge="{{ $product->guarantees->count() }}" is-active="{{ $showSubmenu == 'Guarantees' }}" />
            </div>
        </nav>

    </x-slot>

    <div class="p-4 w-full">
        @if($showSubmenu == '')
            <livewire:insurance.product.product-data :product="$product" />
        @elseif($showSubmenu == 'Guarantees')
            <livewire:insurance.product.guarantees :product="$product" />
        @endif
    </div>


    @section('trix-editor')
        <link rel="stylesheet" type="text/css" href="/css/trix.css">
        <script type="text/javascript" src="/js/trix.js"></script>
    @endsection

    @section('css-filepond')
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/filepond/dist/filepond.css">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

    @endsection
    @section('filepond')
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    @endsection
</x-layout.two-columns>

