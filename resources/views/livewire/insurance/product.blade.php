<x-layout.two-columns>
    <x-slot name="title">
        {{__('Product')}}
    </x-slot>

    <!-- mobile menu -->
    <x-slot name="primary">
        <div class="pt-2 px-4 flex justify-between space-x-2">
            <x-button.header_menu :menu="''" :showSubMenu="$showSubmenu">{{$product->name}}</x-button.header_menu>
            <x-button.header_menu :menu="'Capitals'" :showSubMenu="$showSubmenu">{{__('Capitales')}}</x-button.header_menu>
            <x-button.header_menu :menu="'Guarantees'" :showSubMenu="$showSubmenu">{{__('Garantías')}}</x-button.header_menu>
        </div>
    </x-slot>

    <x-slot name="secondary">
        <nav aria-label="Sidebar">
            <div class="space-y-1" :key="$gabinete->id . 'nav-area'">
                <h3  wire:click="$set('showSubmenu', '')" class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400 cursor-pointer" id="expedient-headline">
                    <span class="text-sm">{{$product->company->name ?? __('Condicionado por defecto')}} / {{$product->ramo->name }}</span>
                    <p class="font-bold">{{$product->name}}</p>
                </h3>
                <x-administration.menu-item label="Capitales" icon="cash" name="Capitals" badge="{{ $product->capitals->count() }}" is-active="{{ $showSubmenu == 'Capitals' }}" />
                <x-administration.menu-item label="Garantías" icon="shield-check" name="Guarantees" badge="{{ $product->guarantees->count() }}" is-active="{{ $showSubmenu == 'Guarantees' }}" />
            </div>
        </nav>

    </x-slot>

    <div class="p-4 w-full">
        @if($showSubmenu == '')
            <livewire:insurance.product.product-data :product="$product" />
        @elseif($showSubmenu == 'Capitals')
            <livewire:insurance.product.capitals :product="$product" />
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

