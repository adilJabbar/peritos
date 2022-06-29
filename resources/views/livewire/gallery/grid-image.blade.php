<div class="h-full flex-col space-y-1">
    <div class="relative cursor-pointer">
        <img class="object-contain h-{{$height}} w-full rounded-md" src="{{ $image->public_url }}" wire:click="viewGallery({{$image->id}})">
        @if($deletable)
            <div  class="absolute top-3 right-3">
                <x-button.danger wire:click="delete" size="xs"><x-icon.ban size="4" /></x-button.danger>
            </div>
        @endif
        @if($showSelectionOptions)
            <div class="absolute top-0 right-0 left-0 bottom-0 bg-gray-100 bg-opacity-50 flex items-center" wire:click="$toggle('selected')">
                @if($selected)
                    <x-icon.check-circle class="mx-auto text-green-700" size="10/12"/>
                @endif
            </div>
        @endif
    </div>
    <x-input.text id="grid-image-{{$image->id}}" wire:model.lazy="image.name" :error="$errors->first('image.name')" />
</div>
