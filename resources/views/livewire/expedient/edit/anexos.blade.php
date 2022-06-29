<div class="space-y-4">

    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Fotografías y anexos'" />
    </x-card.card>

    <x-card.card>
        <div>
            <div class="sm:hidden">
                <label for="collection-tab" class="sr-only">{{__('Selecciona una opción')}}</label>
                <select wire:model="collection" id="collection-tab" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                    <option value="">{{__('Todo')}}</option>
                    <option value="avance">{{__('Avance')}}</option>
                    <option value="prereport">{{__('Pre-Informe')}}</option>
                    <option value="report">{{__('Informe')}}</option>
                    <option value="incidencia">{{__('Incidencia')}}</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
                    <div aria-current="page" class=" rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == null ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', null)">
                        <span>{{__('Todo')}}</span>
                        <span aria-hidden="true" class="bg-{{ $collection == null ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                    </div>
                    <div aria-current="page" class=" group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'avance' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'avance')">
                        <span>{{__('Avance')}}</span>
                        <span aria-hidden="true" class="bg-{{ $collection == 'avance' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                    </div>
                    <div aria-current="page" class=" group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'prereport' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'prereport')">
                        <span>{{__('Pre-Informe')}}</span>
                        <span aria-hidden="true" class="bg-{{ $collection == 'prereport' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                    </div>
                    <div aria-current="page" class=" group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'report' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'report')">
                        <span>{{__('Informe')}}</span>
                        <span aria-hidden="true" class="bg-{{ $collection == 'report' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                    </div>
                    <div aria-current="page" class="rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center  focus:z-10 cursor-pointer hover:bg-gray-50 {{ $collection == 'incidencia' ? 'text-gray-900 ' : 'text-gray-500 hover:text-gray-700'  }} " wire:click="$set('collection', 'incidencia')">
                        <span>{{__('Incidencia')}}</span>
                        <span aria-hidden="true" class="bg-{{ $collection == 'incidencia' ? 'primary' : 'transparent'  }} absolute inset-x-0 bottom-0 h-0.5"></span>
                    </div>
                </nav>
            </div>
        </div>
    </x-card.card>

    <div class="grid grid-col-1 lg:grid-cols-3 gap-4">
        <section class="lg:col-span-2">
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                {{__('Fotografías')}} {{__($collection)}}
                <x-button.secondary wire:click="$toggle('showSelectPicturesOptions')"><x-icon.collection /></x-button.secondary>
            </x-card.header>
            <x-card.body>
                <div class="flex flex-nowrap justify-between">
                    @if($showSelectPicturesOptions)
                        <div>
                            {{__('Selecciona las imágenes que desees y después selecciona una opción...')}}
                        </div>
                        <x-button.secondary wire:click="$toggle('selectAll')">{{ $selectAll ? __('Unselect all') : __('Select all')}}</x-button.secondary>
                        @if($imagesArray)
                            <x-input.select id="bulkAction" wire:model="bulkAction" placeholder="Select one option">
                                <optgroup label="{{__('Añadir')}}">
                                    <option value="addAvance">{{__('Incluir en avances')}}</option>
                                    <option value="addPrereport">{{__('Incluir en preliminares')}}</option>
                                    <option value="addReport">{{__('Incluir en informes')}}</option>
                                    <option value="addIncidencia">{{__('Incluir en incidencias')}}</option>
                                    <option value="addAll">{{__('Incluir en todos los documentos')}}</option>
                                </optgroup>
                                <optgroup label="{{__('Eliminar')}}">
                                    <option value="deleteAll">{{__('Eliminar de todos los documentos')}}</option>
                                    @if($collection)
                                            @if($collection == 'avance') <option value="deleteAvance">{{__('No incluir en avances')}}</option>@endif
                                            @if($collection == 'prereport') <option value="deletePrereport">{{__('No incluir en preliminares')}}</option>@endif
                                            @if($collection == 'report') <option value="deleteReport">{{__('No incluir en informes')}}</option>@endif
                                            @if($collection == 'incidencia') <option value="deleteIncidencia">{{__('No incluir en incidencias')}}</option>@endif
                                    @endif
                                </optgroup>
                            </x-input.select>
                        @endif
                    @endif
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 mb-4">
                    @forelse($picturesCollection as $picture)
                        <livewire:gallery.grid-image :image="$picture" :key="'image-grid-'.$picture->id" :showSelectionOptions="$showSelectPicturesOptions" />
                    @empty
                    @endforelse
                </div>
                @if(!$showSelectPicturesOptions)
                    <x-input.filepond wire:model="pictures"
                        multiple
                        image-preview
                                      class="mt-4"
                        validation="'image/*'"
                        maxSize="4096KB"
                    />
                    @if($pictures)
                        <x-button.primary  wire:click="savePictures" fullWidth="true">{{__('Guardar')}}</x-button.primary>
                    @endif
                @endif
            </x-card.body>
        </x-card.card>
        </section>
        <section>
        <x-card.card class="divide-gray-200 divide-y">
            <x-card.header>
                {{__('Anexos')}} {{__($collection)}}
                <x-button.secondary wire:click="$toggle('showSelectAnexosOptions')"><x-icon.collection /></x-button.secondary>
            </x-card.header>
            <x-card.body class="space-y-4">
                <div class="flex flex-nowrap justify-between">
                    @if($showSelectAnexosOptions)
                        <div class="flex items-center">
                            <x-input.checkbox wire:model="selectAllAnexos" label="{{$selectAllAnexos ? 'Unselect' : 'Select All'}}" size="5"/>
                        </div>
                        @if($anexosArray)
                            <x-input.select id="bulkActionAnexos" wire:model="bulkActionAnexos" placeholder="Select one option">
                                <optgroup label="{{__('Añadir')}}">
                                    <option value="addAvance">{{__('Incluir en avances')}}</option>
                                    <option value="addPrereport">{{__('Incluir en preliminares')}}</option>
                                    <option value="addReport">{{__('Incluir en informes')}}</option>
                                    <option value="addIncidencia">{{__('Incluir en incidencias')}}</option>
                                    <option value="addAll">{{__('Incluir en todos los documentos')}}</option>
                                </optgroup>
                                <optgroup label="{{__('Eliminar')}}">
                                    <option value="deleteAll">{{__('Eliminar de todos los documentos')}}</option>
                                    @if($collection)
                                        @if($collection == 'avance') <option value="deleteAvance">{{__('No incluir en avances')}}</option>@endif
                                        @if($collection == 'prereport') <option value="deletePrereport">{{__('No incluir en preliminares')}}</option>@endif
                                        @if($collection == 'report') <option value="deleteReport">{{__('No incluir en informes')}}</option>@endif
                                        @if($collection == 'incidencia') <option value="deleteIncidencia">{{__('No incluir en incidencias')}}</option>@endif
                                    @endif
                                </optgroup>
                            </x-input.select>
                        @endif
                    @endif
                </div>
                <div class="space-y-2">
                    @forelse($anexosCollection as $anexo)
                        <div class="flex justify-between" wire:key="anexo-{{$anexo->id}}">
                            <div class="flex items-center">
                                @if($showSelectAnexosOptions)
                                    <x-input.checkbox wire:model="anexosArray" value="{{ $anexo->id }}" size="5"/>
                                @endif
                            </div>
                            <div class="w-full">
                                <livewire:anexo.anexo-row :anexo="$anexo" :key="'anexo-row' . $anexo->id" />
{{--                                {{$anexo->name}}--}}
                            </div>
                        </div>
{{--                        <livewire:gallery.grid-image :image="$picture" :key="'image-grid-'.$picture->id" :showSelectionOptions="$showSelectPicturesOptions" />--}}
                    @empty
                    @endforelse
                </div>
                @unless($showSelectAnexosOptions)
                    <x-input.filepond wire:model="anexos"
                        multiple
                        validation="'application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'"
                        maxSize="4096KB"
                    />
                    @if($anexos)
                        <x-button.primary  wire:click="saveAnexos" fullWidth="true">{{__('Guardar')}}</x-button.primary>
                    @endif
                @endunless
            </x-card.body>
        </x-card.card>
        </section>
    </div>
        @include('livewire.gallery.expedient-pictures-modal', ['pictures' => $picturesCollection, 'title' => 'Fotografías', 'activeFoto' => $activeFoto])

</div>
