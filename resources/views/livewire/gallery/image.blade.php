<div class="divide-y divide-gray-200">
    <x-card.header>
        <h3>{{ $image->name }}</h3>
        <x-button.close wire:click="closeGalleryModal" />
    </x-card.header>
    <x-card.body>
        <div class="h-auto">
            <div class="mb-4">
                <img class="rounded-md shadow-md" src="{{$image->url}}" alt="">
            </div>
        </div>
        <div class="flex justify-around space-x-4">
            <div>
                <x-button.secondary wire:click="goPrevious"><x-icon.chevron-left size="5"/></x-button.secondary>
            </div>
            <div class="w-full text-center"><x-input.text wire:model="image.name" id="name"  :error="$errors->first('image.name')" placeholder="Title"/></div>
            <div><x-button.secondary wire:click="goNext"><x-icon.chevron-right size="5"/></x-button.secondary></div>
        </div>
        <div class="mt-2">
            <x-input.group label="Comentarios" for="comments" :error="$errors->first('image.comments')" inline borderless>
                <x-input.textarea wire:model="image.comments" id="comments"  :error="$errors->first('image.comments')" placeholder="Comentarios adicionales..."  />
            </x-input.group>
        </div>
    </x-card.body>
</div>
