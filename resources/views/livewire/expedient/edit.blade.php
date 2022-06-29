<div>
    <x-layout.two-columns>
        <x-slot name="title">
            {{__('Gabinete')}}
        </x-slot>

        <x-slot name="primary">
            <nav class="relative z-0 rounded-lg shadow flex lg:hidden divide-x divide-gray-200 " aria-label="Tabs">
                <div @click.away="optionsMenuOpen = false" x-data="{ optionsMenuOpen: false }" class="text-gray-900 rounded-l-lg group relative min-w-0 flex-1 inline-flex">
                    <div @click="optionsMenuOpen = !optionsMenuOpen" x-state:on="Item active" x-state:off="Item inactive" :class="{ 'text-gray-900': optionsMenuOpen, 'text-gray-500': !optionsMenuOpen }" class=" overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 cursor-pointer w-full">
                        <span class="break-all">{{ $expedient->full_code }}</span>
                        @if($topMenu == 'expedient')<span aria-hidden="true" class="bg-primary absolute inset-x-0 bottom-0 h-0.5"></span>@endif
                    </div>

                    <div x-show="optionsMenuOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-left absolute z-30 top-12 left-2 mt-2 w-auto rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-1">
                        <div class="py-1">
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Resumen del expediente" icon="template" name="summary"
                                                        is-active="{{ $showSubmenu == 'summary' }}" badge="23"/>
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Información inicial" icon="clipboard-list" name="initialData"
                                                        is-active="{{ $showSubmenu == 'initialData' }}"/>
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Gestión del expediente" icon="desktop-computer" name="management"
                                                        is-active="{{ $showSubmenu == 'management' }}"/>
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Terceros afectados" icon="users" name="affecteds"
                                                        is-active="{{ $showSubmenu == 'affecteds' }}"/>
                            @if($expedient->requires_policy)
                                <x-administration.menu-item @click="optionsMenuOpen = false" label="Póliza y Condiciones" icon="newspaper" name="policy"
                                                            is-active="{{ $showSubmenu == 'policy' }}"/>
                            @endif

                        </div>
                    </div>
                </div>

                <div @click.away="optionsMenuOpen = false" x-data="{ optionsMenuOpen: false }" class="text-gray-900 rounded-l-lg group relative min-w-0 flex-1  inline-flex">
                    <div @click="optionsMenuOpen = !optionsMenuOpen" x-state:on="Item active" x-state:off="Item inactive" :class="{ 'text-gray-900': optionsMenuOpen, 'text-gray-500': !optionsMenuOpen }" class=" overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 cursor-pointer w-full">
                        <span>{{ __('Zona técnica') }}</span>
                        @if($topMenu == 'tecnicalZone')<span aria-hidden="true" class="bg-primary absolute inset-x-0 bottom-0 h-0.5"></span>@endif
                    </div>

                    <div x-show="optionsMenuOpen" x-description="Dropdown menu, show/hide based on menu state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-center absolute z-30 top-12 left-2 mt-2 w-auto rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-1">
                        <div class="py-1">
                            @if($expedient->requires_preexistences)
                                <x-administration.menu-item @click="optionsMenuOpen = false" label="Preexistencias" icon="collection" name="preexistence"
                                                            is-active="{{ $showSubmenu == 'preexistence' }}"/>
                            @endif
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Causa y circunstancias" icon="clock" name="texts"
                                                        is-active="{{ $showSubmenu == 'texts' }}"/>
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Valoración de daños" icon="table" name="assessment"
                                                        is-active="{{ $showSubmenu == 'assessment' }}"/>
                            @if($expedient->requires_tasacion)
                                <x-administration.menu-item @click="optionsMenuOpen = false" label="Propuesta de tasación" icon="credit-card" name="tasacion"
                                                            is-active="{{ $showSubmenu == 'tasacion' }}"/>
                            @endif
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Fotografías y anexos" icon="photograph" name="anexos"
                                                        is-active="{{ $showSubmenu == 'anexos' }}"/>
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Informes" icon="document-text" name="documentLog"
                                                        is-active="{{ $showSubmenu == 'documentLog' }}"/>

                        </div>
                    </div>
                </div>

                <div @click.away="optionsMenuOpen = false" x-data="{ optionsMenuOpen: false }" class="text-gray-900 rounded-l-lg group relative min-w-0 flex-1  inline-flex">
                    <div @click="optionsMenuOpen = !optionsMenuOpen" x-state:on="Item active" x-state:off="Item inactive" :class="{ 'text-gray-900': optionsMenuOpen, 'text-gray-500': !optionsMenuOpen }" class=" overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 cursor-pointer w-full">
                        <span>{{ __('Envíos') }}</span>
                        @if($topMenu == 'envios')<span aria-hidden="true" class="bg-primary absolute inset-x-0 bottom-0 h-0.5"></span>@endif
                    </div>

                    <div x-show="optionsMenuOpen" x-description="Dropdown menu, show/hide based on menu state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute z-30 top-12 right-2 mt-2 w-auto rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-1">
                        <div class="py-1">
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Communicaciones" icon="mail" name="communications"
                                                        is-active="{{ $showSubmenu == 'communications' }}"/>
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Informes" icon="document-text" name="documentLog"
                                                        is-active="{{ $showSubmenu == 'documentLog' }}"/>

                        </div>
                    </div>
                </div>

                <div @click.away="optionsMenuOpen = false" x-data="{ optionsMenuOpen: false }" class="text-gray-900 rounded-l-lg group relative min-w-0 flex-1  inline-flex">
                    <div @click="optionsMenuOpen = !optionsMenuOpen" x-state:on="Item active" x-state:off="Item inactive" :class="{ 'text-gray-900': optionsMenuOpen, 'text-gray-500': !optionsMenuOpen }" class=" overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 cursor-pointer w-full">
                        <span>{{ __('Contabilidad') }}</span>
                        @if($topMenu == 'contabilidad')<span aria-hidden="true" class="bg-primary absolute inset-x-0 bottom-0 h-0.5"></span>@endif
                    </div>

                    <div x-show="optionsMenuOpen" x-description="Dropdown menu, show/hide based on menu state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute z-30 top-12 right-2 mt-2 w-auto rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-1">
                        <div class="py-1">
                            <x-administration.menu-item @click="optionsMenuOpen = false" label="Facturación" icon="currency-dollar" name="billing"
                                                        is-active="{{ $showSubmenu == 'billing' }}"/>

                        </div>
                    </div>
                </div>
            </nav>
    {{--        <div class="pt-2 px-2 flex justify-between space-x-2 overflow-auto">--}}
    {{--            <x-button.header_menu :menu="'summary'" :showSubMenu="$showSubmenu">{{__('Datos')}}</x-button.header_menu>--}}
    {{--            <x-button.header_menu :menu="'Guarantees'" :showSubMenu="$showSubmenu">{{__('Garantías')}}</x-button.header_menu>--}}
    {{--        </div>--}}
        </x-slot>

        <x-slot name="secondary">

            <nav aria-label="Sidebar">
                <div class="space-y-1" :key="$gabinete->id . 'nav-area'">

                    <h3 class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400" id="expedient-headline">
                        {{ $expedient->full_code  }}
                    </h3>

                    <x-administration.menu-item label="Resumen del expediente" icon="template" name="summary"
                                                is-active="{{ $showSubmenu == 'summary' }}" badge="23"/>
                    <x-administration.menu-item label="Información inicial" icon="clipboard-list" name="initialData"
                                                is-active="{{ $showSubmenu == 'initialData' }}"/>
                    <x-administration.menu-item label="Gestión del expediente" icon="desktop-computer" name="management"
                                                is-active="{{ $showSubmenu == 'management' }}"/>
                    <x-administration.menu-item label="Terceros afectados" icon="users" name="affecteds"
                                                is-active="{{ $showSubmenu == 'affecteds' }}"/>
                    @if($expedient->requires_policy)
                        <x-administration.menu-item label="Póliza y Condiciones" icon="newspaper" name="policy"
                                                is-active="{{ $showSubmenu == 'policy' }}"/>
                    @endif
                    <h3 class="p-3 text-xs font-semibold text-white uppercase tracking-wider bg-gray-400"
                        id="texhnical-zone-headline">
                        {{ __('Zona técnica') }}
                    </h3>
                    @if($expedient->requires_preexistences)
                    <x-administration.menu-item label="Preexistencias" icon="collection" name="preexistence"
                                                is-active="{{ $showSubmenu == 'preexistence' }}"/>
                    @endif
                    <x-administration.menu-item label="Causa y circunstancias" icon="clock" name="texts"
                                                is-active="{{ $showSubmenu == 'texts' }}"/>
                    <x-administration.menu-item label="Valoración de daños" icon="table" name="assessment"
                                                is-active="{{ $showSubmenu == 'assessment' }}"/>
                    @if($expedient->requires_tasacion)
                    <x-administration.menu-item label="Propuesta de tasación" icon="credit-card" name="tasacion"
                                                is-active="{{ $showSubmenu == 'tasacion' }}"/>
                    @endif
                    <x-administration.menu-item label="Fotografías y anexos" icon="photograph" name="anexos"
                                                is-active="{{ $showSubmenu == 'anexos' }}"/>

                    <x-administration.menu-item label="Informes" icon="document-text" name="documentLog"
                                                is-active="{{ $showSubmenu == 'documentLog' }}"/>
                    <h3 class="p-3 text-xs font-semibold text-white uppercase tracking-wider bg-gray-400"
                        id="envios-headline">
                        {{ __('Comunicaciones') }}
                    </h3>
                    <x-administration.menu-item label="Llamada" icon="phone" name="phonecall"
                                                is-active="{{ $showSubmenu == 'phonecall' }}"/>
                    <x-administration.menu-item label="Videollamada" icon="video-camera" name="videocall"
                                                is-active="{{ $showSubmenu == 'videocall' }}"/>
                    <x-administration.menu-item label="e-mails" icon="mail" name="communications"
                                                is-active="{{ $showSubmenu == 'communications' }}"/>

                    <h3 class="p-3 text-xs font-semibold text-white uppercase tracking-wider bg-gray-400"
                        id="contabilidad-headline">
                        {{ __('Contabilidad') }}
                    </h3>
                    <x-administration.menu-item label="Facturación" icon="currency-dollar" name="billing"
                                                is-active="{{ $showSubmenu == 'billing' }}"/>

                </div>
            </nav>
        </x-slot>


        <div class="p-4 w-full space-y-4">
            @if($showSubmenu == 'summary')
                <livewire:expedient.summary :expedient="$expedient" />
            @elseif($showSubmenu == 'initialData')
                <livewire:expedient.initial-data :expedient="$expedient" />
            @elseif($showSubmenu == 'management')
                <livewire:expedient.management :expedient="$expedient" />
            @elseif($showSubmenu == 'affecteds')
                <livewire:expedient.affecteds :expedient="$expedient" />
            @elseif($showSubmenu == 'policy')
                <livewire:expedient.policy :expedient="$expedient" />
            @elseif($showSubmenu == 'preexistence')
                <livewire:expedient.preexistence :expedient="$expedient" />
            @elseif($showSubmenu == 'texts')
                <livewire:expedient.texts :expedient="$expedient" />
            @elseif($showSubmenu == 'assessment')
                @if($expedient->policy)
                    <livewire:expedient.assessment :expedient="$expedient" />
                @else
                    <livewire:expedient.assesment-no-capital :expedient="$expedient" />
                @endif
            @elseif($showSubmenu == 'phonecall')
                <livewire:expedient.phone-call :expedient="$expedient" />
            @elseif($showSubmenu == 'communications')
                <livewire:expedient.communications :expedient="$expedient" />
            @elseif($showSubmenu == 'tasacion')
                <livewire:expedient.tasacion :expedient="$expedient" />
            @elseif($showSubmenu == 'anexos')
                <livewire:expedient.anexos :expedient="$expedient" />
            @elseif($showSubmenu == 'documentLog')
                <livewire:expedient.document-log :expedient="$expedient" />
            @endif
        </div>
    </x-layout.two-columns>


@section('trix-editor')
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
@endsection

{{--@push('styles')--}}
{{--    @once--}}
{{--        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">--}}
{{--    @endonce--}}
{{--@endpush--}}

{{--@push('scripts')--}}
{{--    @once--}}
{{--        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>--}}
{{--    @endonce--}}
{{--@endpush--}}

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
@section('workTime')
{{--        Start the inactivity time, asigning model, id, user, name--}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.emit('loadedWorkTimeArea', 'App\\Models\\Expedient', {{$expedient->id}}, '{{ $this->topMenu }}');
        })
    </script>
@endsection

@section('twilio-video')
    <script src="//sdk.twilio.com/js/video/releases/2.17.1/twilio-video.min.js"></script>

@endsection
</div>
