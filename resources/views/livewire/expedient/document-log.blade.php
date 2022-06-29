<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Documentos del expediente'" />
    </x-card.card>
    <x-card.card>
        <x-card.header>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                <strong>{{__('Documentos del expediente') . ' ' . $expedient->full_code}}</strong>
            </h3>
        </x-card.header>
        <x-card.body class="space-y-4">
            <div>
                <div class="sm:hidden">
                    <label for="collection-tab" class="sr-only">{{__('Selecciona un documento a generar')}}</label>
                    <select wire:model="collection" id="collection-tab" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                        <option value="">{{__('No generar ninguno')}}</option>
                        <option value="avance">{{__('Avance')}}</option>
                        <option value="preReport">{{__('Pre-Informe')}}</option>
                        <option value="report">{{__('Informe')}}</option>
                        <option value="ampliation">{{__('Ampliación')}}</option>
                    </select>
                </div>
                <div class="hidden sm:block">
                    <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
                        <div aria-current="page" class=" rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == null ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', null)">
                            <span>{{__('Listado')}}</span>
                            <span aria-hidden="true" class="bg-{{ $collection == 'reset' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                        </div>
                        <div aria-current="page" class=" group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'avance' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'avance')">
                            <span>{{__('Avance')}}</span>
                            <span aria-hidden="true" class="bg-{{ $collection == 'avance' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                        </div>
                        <div aria-current="page" class=" group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'preReport' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'preReport')">
                            <span>{{__('Pre-Informe')}}</span>
                            <span aria-hidden="true" class="bg-{{ $collection == 'preReport' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                        </div>
                        <div aria-current="page" class=" group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'report' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'report')">
                            <span>{{__('Informe')}}</span>
                            <span aria-hidden="true" class="bg-{{ $collection == 'report' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                        </div>
                        <div aria-current="page" class="rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'ampliation' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'ampliation')">
                            <span>{{__('Ampliación')}}</span>
                            <span aria-hidden="true" class="bg-{{ $collection == 'ampliation' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                        </div>
                    </nav>
                </div>
            </div>
            <div>
                @if($collection)
                    <div class="mb-4">
                        @if($collection == 'avance')
                            <livewire:document.new-advance-form :expedient="$expedient" />

                        @elseif($collection == 'preReport')
                            Resumen del pre informe que se va a generar
                        @elseif($collection == 'report')
                            Resumen del informe que se va a generar
                        @elseif($collection == 'ampliation')
                            Resumen de la ampliación que se va a generar
                        @endif
                    </div>
                @endif
                <div>
                    <x-table.table>
                        <x-slot name="head">
                            <x-table.heading>{{__('Fecha')}}</x-table.heading>
                            <x-table.heading>{{__('Tipo')}}</x-table.heading>
                            <x-table.heading>{{__('Reserva')}}</x-table.heading>
                            <x-table.heading>{{__('Propuesta')}}</x-table.heading>
                            <x-table.heading>{{__('Excluido')}}</x-table.heading>
                            <x-table.heading>{{__('Generado por')}}</x-table.heading>
                            <x-table.heading>{{__('Revisado por')}}</x-table.heading>
                            <x-table.heading>{{__('Enviado')}}</x-table.heading>
                            <x-table.heading>{{__('...')}}</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($expedient->documents->sortByDesc('created_at') as $expedientDocument)
                                <x-table.row>
                                    <x-table.cell>{{$expedientDocument->localize('created_at')->format(auth()->user()->full_date_for_humans_format)}}</x-table.cell>
                                    <x-table.cell>{{__($expedientDocument->template->type)}}</x-table.cell>
                                    <x-table.cell><x-output.currency value="{{$expedientDocument->reserve }}" :currency="$expedient->currency()" /></x-table.cell>
                                    <x-table.cell><x-output.currency value="{{$expedientDocument->proposed }}" :currency="$expedient->currency()" /></x-table.cell>
                                    <x-table.cell><x-output.currency value="{{$expedientDocument->excluded }}" :currency="$expedient->currency()" /></x-table.cell>
                                    <x-table.cell>{{ $expedientDocument->creator->full_name }}</x-table.cell>
                                    <x-table.cell>{{ $expedientDocument->supervisor->full_name ?? ''}}</x-table.cell>
                                    <x-table.cell>
                                        @if($expedientDocument->sent_at)
                                            {{ $expedientDocument->sent }}
                                        @elseif (auth()->user()->can('documents.send'))
                                            <x-button.primary>{{__('Send')}}</x-button.primary>
                                        @endif
                                    </x-table.cell>
                                    <x-table.cell>
                                        @if(!$expedient->sent_at)
                                            <x-button.primary>{{__('Discard')}}</x-button.primary>
                                        @endif
                                            <x-button.a-primary href="{{$expedientDocument->public_url}}" target="_blank">{{__('View')}}</x-button.a-primary>
                                    </x-table.cell>
                                </x-table.row>
                            @empty

                            @endforelse

                        </x-slot>

                    </x-table.table>
                </div>
            </div>
        </x-card.body>
    </x-card.card>

</div>
