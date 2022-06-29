<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('company.show', ['company' => $company->id]) }}">{{ $company->name }}</x-breadcumb.item>
                <x-breadcumb.item>{{ __('Productos') }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>
    <div class="space-y-4">
        <x-card.card class="divide-gray-200 divide-y">
        <x-card.header>
            <h3>{{__('Productos comercializados por')}} {{$company->name}}</h3>
            @can('product.create')
                <x-button.primary wire:click="addNewProduct">{{__('Añadir un producto')}}</x-button.primary>
            @endcan
        </x-card.header>
        <x-card.body>
            <div>
                <x-input.group for="company-ramo" label="Ramo" borderless>
                    <x-input.select wire:model.lazy="selectedRamo" id="company-ramo" placeholder="Selecciona un ramo" >
                        @forelse($company->ramos->sortBy('name') as $ramoRow)
                            <option value="{{$ramoRow->id}}">{{__($ramoRow->name)}}</option>
                        @empty
                            <option disabled>{{__('Esta compañía no tiene ningún ramo disponible')}}</option>
                        @endforelse
                    </x-input.select>
                </x-input.group>
            </div>
        </x-card.body>
    </x-card.card>

        @if($selectedRamo)
        <x-card.card>
            @if($selectedRamo)
            <x-card.header>
                <h3>{{__('Ramo')}}: {{__($ramo->name ?? '')}}</h3>
            </x-card.header>
            <x-card.body>
                <x-table.table>
                    <x-slot name="head">
                        <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" >{{__('Name')}}</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('code')" :direction="$sorts['code'] ?? null" centered>{{__('Code')}}</x-table.heading>
                        <x-table.heading>{{__('Version')}}</x-table.heading>
                        <x-table.heading>{{__('Notes')}}</x-table.heading>
                        <x-table.heading></x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($products as $productRow)
                            <x-table.row>
                                <x-table.cell>{{$productRow->name}}</x-table.cell>
                                <x-table.cell class="text-center">{{$productRow->code}}</x-table.cell>
                                <x-table.cell class="text-center">{{$productRow->current_version}}</x-table.cell>
                                <x-table.cell>{{$productRow->notes}}</x-table.cell>
                                <x-table.cell class="w-20">
                                    <div class="flex space-x-2">
                                        <x-button.primary wire:click="openProduct({{$productRow->id}})" size="xs">
                                            <x-icon.eye/>
                                        </x-button.primary>
                                        @if($productRow->cond_general)
                                            <a target="_blank" href="{{$productRow->url_cond_general}}">
                                                <x-button.secondary size="xs"><x-icon.document-text/></x-button.secondary>
                                            </a>
                                        @endif
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            {{__('Esta companía no comercializa ningún producto de este ramo')}}
                        @endforelse
                    </x-slot>
                </x-table.table>
                {{$products->links()}}
            </x-card.body>
                @endif
        </x-card.card>
    @endif

    </div>
    @include('partials.insurance.product.modal')

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

</div>
