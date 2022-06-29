<div class="divide-y divide-gray-200">
    <x-card.header>
        <span class="font-bold text-xl">{{ $picture->name }}</span>
        <x-button.close wire:click="closeGalleryModal" />
    </x-card.header>
    <x-card.body>
        <div class="h-auto">
            <div class="mb-4 flex justify-center">
                <img class="rounded-md shadow-md" src="{{$picture->public_url}}" alt="">
            </div>
        </div>
        <div class="flex justify-around space-x-4">
            <div>
                <x-button.secondary wire:click="goPrevious"><x-icon.chevron-left size="5"/></x-button.secondary>
            </div>
            <div class="w-full text-center"><x-input.text wire:model.lazy="picture.name" id="name"  :error="$errors->first('picture.name')" placeholder="Title"/></div>
            <div><x-button.secondary wire:click="goNext"><x-icon.chevron-right size="5"/></x-button.secondary></div>
        </div>
        <div class="mt-2 space-x-2 flex">
            <div class="w-1/4">
                <x-button.secondary wire:click="$toggle('picture.avance')" class="{{$picture->avance ? 'text-green-700 bg-green-200' : ''}}" fullWidth="true">{{__('Avance')}}</x-button.secondary>
            </div>
            <div class="w-1/4">
                <x-button.secondary wire:click="$toggle('picture.prereport')" class="{{$picture->prereport ? 'text-green-700 bg-green-200' : ''}}" fullWidth="true">{{__('Pre-Informe')}}</x-button.secondary>
            </div>
            <div class="w-1/4">
                <x-button.secondary wire:click="$toggle('picture.report')" class="{{$picture->report ? 'text-green-700 bg-green-200' : ''}}" fullWidth="true">{{__('Informe')}}</x-button.secondary>
            </div>
            <div class="w-1/4">
                <x-button.secondary wire:click="$toggle('picture.incidencia')" class="{{$picture->incidencia ? 'text-green-700 bg-green-200' : ''}}" fullWidth="true">{{__('Incidencias')}}</x-button.secondary>
            </div>
        </div>
        <div class="mt-2">
            <x-input.group label="Comentarios" for="comments" :error="$errors->first('picture.comments')" inline borderless>
                <x-input.textarea wire:model.lazy="picture.comments" id="comments"  :error="$errors->first('picture.comments')" placeholder="Comentarios adicionales..."  />
            </x-input.group>
        </div>
    </x-card.body>
</div>
