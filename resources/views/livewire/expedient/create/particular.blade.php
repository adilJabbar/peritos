<div class="w-full p-4 overflow-auto space-y-4">
    <x-card.card>
        <x-card.body>
            <div class="flex flex-col w-full space-y-2">
                <div class="flex justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('Nuevo expediente:') }} <span class="text-gray-400"> {{ $expedient->billable?->name }}</span>
                    </h3>
                    <span>{{$expedient->full_code}}</span>

                </div>
                <nav aria-label="{{__('Progreso de alta')}}">
                    <x-steps.steps :steps="$steps" :stepSelected="$currentStep" :completedSteps="$completedSteps" />
                </nav>
            </div>
        </x-card.body>
    </x-card.card>

    @if($openedStep == 1)
        <livewire:expedient.create.step1-particular :expedient="$expedient" :key="'step1'.$expedient->id"/>
    @elseif($openedStep == 2)
        <livewire:expedient.create.step2-particular :expedient="$expedient" :key="'step2'.$expedient->id"/>
    @elseif($openedStep == 3)
        <livewire:expedient.create.step3 :expedient="$expedient" :key="'step3'.$expedient->id"/>
    @endif

</div>

@section('trix-editor')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
@endsection


@section('css-filepond')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/filepond/dist/filepond.css">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

@endsection
@section('filepond')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection
