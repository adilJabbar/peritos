<div class="w-full p-4 overflow-auto space-y-4">
    <x-card.card>
        <x-card.body>
            <div class="flex flex-col w-full space-y-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('Nuevo expediente') }} {{ $expedient->billable?->name }}
                </h3>
                <nav aria-label="Progress">
                    <ol class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
                        @foreach ($steps as $key => $value)
                            <li class="relative md:flex-1 md:flex">

                                @if($currentStep == $key)
                                    <x-steps.current number="{{ $key }}" title="{{ __($value) }}"/>
                                @elseif(in_array($key, $completedSteps))
                                    <x-steps.completed number="{{ $key }}" title="{{ __($value) }}"/>
                                @else
                                    <x-steps.upcoming number="{{ $key }}" title="{{ __($value) }}"/>
                                @endif

                                @if(!$loop->last)
                                    <x-steps.arrow/>
                                @endif


                            </li>
                        @endforeach

                    </ol>
                </nav>
            </div>
        </x-card.body>

    </x-card.card>

    @if($openedStep == 1)

        @include('livewire.expedient.create.step1_old')

        <div class="flex justify-end">
            @if($requesterType)
                <x-button.primary wire:click="goToNextStep(2)" class="inline-flex items-center space-x-2">
                    <span>{{__('Datos del Siniestro')}}</span>
                    <x-icon.chevron-right size="4"/>
                </x-button.primary>
            @endif
        </div>

    @endif
    @if($openedStep == 2)

        @include('livewire.expedient.create.step2')

        <div class="flex justify-between">
            <x-button.primary wire:click="$set('openedStep', 1)" class="inline-flex items-center space-x-2">
                <x-icon.chevron-left size="4"/>
                <span>{{__('Datos del Expediente')}}</span>
            </x-button.primary>

            <x-button.primary wire:click="goToNextStep(3)" class="inline-flex items-center space-x-2">
                <span>{{__('Terceros Afectados')}}</span>
                <x-icon.chevron-right size="4"/>
            </x-button.primary>
        </div>
    @endif
    @if($openedStep == 3)
        @include('livewire.expedient.create.step3')

        <div class="flex justify-between">
            <x-button.primary wire:click="$set('openedStep', 2)" class="inline-flex items-center space-x-2">
                <x-icon.chevron-left size="4"/>
                <span>{{__('Datos del Siniestro')}}</span>
            </x-button.primary>

            <x-button.primary wire:click="save()" class="inline-flex items-center space-x-2">
                <span>{{__('Crear expediente')}}</span>
            </x-button.primary>
        </div>
    @endif


</div>



@section('css-trix')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
@endsection
@section('trix')
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
@endsection
