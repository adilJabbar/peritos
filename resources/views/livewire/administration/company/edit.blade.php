<x-layout.two-columns>
    <x-slot name="title">
        {{__('Company')}}
    </x-slot>

    <!-- mobile menu -->
    <x-slot name="primary">
        <div class="pt-2 px-4 flex justify-between space-x-2">
            {{--            <x-button.header_menu :menu="'personalData'" :showSubMenu="$showSubmenu">{{__('Datos personales')}}</x-button.header_menu>--}}
            {{--            <x-button.header_menu :menu="'Security'" :showSubMenu="$showSubmenu">{{__('Seguridad')}}</x-button.header_menu>--}}
            {{--            <x-button.header_menu :menu="'zipCoverage'" :showSubMenu="$showSubmenu">{{__('Zonas')}}</x-button.header_menu>--}}
        </div>
    </x-slot>

    <x-slot name="secondary">

        <nav aria-label="Sidebar">
            <div class="space-y-1" :key="$company->id . 'nav-area'">
                <h3  wire:click="$set('showSubmenu', '')" class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400 cursor-pointer" id="expedient-headline">
                    {{ $company->name }}
                </h3>
                <x-administration.menu-item label="Ramos" icon="adjustments" name="Ramos" badge="{{ $company->ramos->count() }}" is-active="{{ $showSubmenu == 'Ramos' }}" />
                <x-administration.menu-item label="Productos" icon="briefcase" name="Products" badge="{{ $company->products->count() }}" is-active="{{ $showSubmenu == 'Products' }}" />
                <x-administration.menu-item label="Áreas" icon="view-grid-add" name="Areas" badge="{{ $company->areas->count() }}" is-active="{{ $showSubmenu == 'Areas' }}" />
                <x-administration.menu-item label="Tramitadores" icon="users" name="Agents" badge="{{ $company->activeAgents()->count() }}" is-active="{{ $showSubmenu == 'Agents' }}" />
                <x-administration.menu-item label="Gabinetes" icon="office-building" name="Gabinetes" badge="{{ $company->gabinetes->count() }}" is-active="{{ $showSubmenu == 'Gabinetes' }}" />
                <x-administration.menu-item label="Expedients" icon="document-text" name="Expedients" badge="{{ $company->expedients->count() }}" is-active="{{ $showSubmenu == 'Expedients' }}" />
            </div>
        </nav>

    </x-slot>

    <div class="p-4 w-full">
        @if($showSubmenu == '')
            @include('partials.insurance.insurance_data')
        @elseif($showSubmenu == 'Ramos')
            <livewire:insurance.ramos :company="$company" />
        @elseif($showSubmenu == 'Products')
            <livewire:insurance.products :company="$company" />
        @elseif($showSubmenu == 'Areas')
            <livewire:insurance.areas :company="$company" />
        @elseif($showSubmenu == 'Agents')
            <livewire:insurance.agents :company="$company" />
        @elseif($showSubmenu == 'Gabinetes')
            <livewire:insurance.gabinetes :company="$company" />
        @elseif($showSubmenu == 'Expedients')
            <livewire:insurance.expedients :company="$company" />
        @endif
    </div>
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
