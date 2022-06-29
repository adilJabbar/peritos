<x-layout.two-columns>
    <x-slot name="title">
        {{__('Alta de expediente')}}
    </x-slot>

    <!-- mobile menu -->
    <x-slot name="primary">
    </x-slot>

    <x-slot name="secondary">

        <nav aria-label="Sidebar">
            <div class="space-y-1" :key="$country->id . 'nav-area'">

                <h3  class="p-3  font-semibold text-white uppercase tracking-wider bg-gray-400 cursor-pointer" id="expedient-headline">
                    {{__('Alta de expediente')}}
                </h3>
{{--                @if(auth()->user()->gabinetes->count() > 1)--}}
{{--                    <x-administration.menu-item label="Gabinete" icon="office-building" name="Gabinete" is-active="{{ $showSubmenu == 'Gabinete' }}" />--}}
{{--                @endif--}}
                <x-administration.menu-item label="Requester" icon="pencil-alt" name="Requester" is-active="{{ $showSubmenu == 'Requester' }}" />
                @if($expedient->getKey())
                <x-administration.menu-item label="Datos del siniestro" icon="cash" name="CaseData" is-active="{{ $showSubmenu == 'CaseData' }}" />
                    @if($expedient->requires_policy && $expedient->ramo)
                        <x-administration.menu-item label="Datos de la póliza" icon="document-text" name="Policy" is-active="{{ $showSubmenu == 'Policy' }}" />
                    @endif
                    @if($showTerceros)
                        <x-administration.menu-item label="Terceros Afectados" icon="users" name="Terceros" is-active="{{ $showSubmenu == 'Terceros' }}" />
                    @endif
                    @if($showFinalize)
                        <x-administration.menu-item label="Finalizar alta" icon="check-circle" name="Finalize" is-active="{{ $showSubmenu == 'Finalize' }}" />
                    @endif
                @endif

                {{--                <x-administration.menu-item label="Expedients" icon="document-text" name="Expedients" badge="{{ $company->expedients->count() }}" is-active="{{ $showSubmenu == 'Expedients' }}" />--}}
            </div>
        </nav>

    </x-slot>
    <div class="p-4 space-y-4 w-full">

        @if($showSubmenu == 'Requester')
            <livewire:expedient.new-expedient.requester :expedient="$expedient" />
        @elseif($showSubmenu == 'CaseData')
            <livewire:expedient.new-expedient.case-data :expedient="$expedient" />
        @elseif($showSubmenu == 'Policy')
            <livewire:expedient.new-expedient.policy :expedient="$expedient" />
        @elseif($showSubmenu == 'Terceros')
            <livewire:expedient.new-expedient.terceros :expedient="$expedient" />
        @elseif($showSubmenu == 'Finalize')
            <livewire:expedient.new-expedient.finalize :expedient="$expedient" />
        @endif

    </div>


    @include('partials.expedient.newExpedient.requester_change_modal')

    @section('trix-editor')
        <link rel="stylesheet" type="text/css" href="/css/trix.css">
        <script type="text/javascript" src="/js/trix.js"></script>
    @endsection


    @section('css-filepond')
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/filepond/dist/filepond.css">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

    @endsection
    @section('filepond')
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    @endsection

</x-layout.two-columns>
