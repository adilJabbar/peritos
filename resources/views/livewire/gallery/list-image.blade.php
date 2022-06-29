<div class="h-full flex space-x-4 pt-2">
    <div class="relative cursor-pointer" wire:click="toggleImage">
        <img class="object-contain max-h-{{$size}} max-w-{{$size}} rounded-md" src="{{ $image->public_url }}" >
        @if($excluded)
            <div class="absolute top-0 right-0 left-0 bottom-0 bg-gray-100 bg-opacity-50 flex items-center">
                <div  class="absolute top-3 right-3">
                    <x-button.danger wire:click="delete" size="xs"><x-icon.ban size="4" /></x-button.danger>
                </div>
            </div>
        @endif
        @if($deletable)
            <div  class="absolute top-3 right-3">
                <x-button.danger wire:click="delete" size="xs"><x-icon.ban size="4" /></x-button.danger>
            </div>
        @endif
        @if($showSelectionOptions)
            <div class="absolute top-0 right-0 left-0 bottom-0 bg-gray-100 bg-opacity-50 flex items-center" wire:click="toggle('selected')">
                @if($selected)
                    <x-icon.check-circle class="mx-auto text-green-700" size="10/12"/>
                @endif
            </div>
        @endif
    </div>
    <x-input.text id="grid-image-{{$image->id}}" wire:model.lazy="image.name" :error="$errors->first('image.name')" :shadow="false" :divClass="'m-auto'" />
</div>
