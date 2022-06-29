<x-modal.modal wire:model.defer="showGalleryModal" class="w-full max-h-full overflow-auto" max-width="4xl">
    <div class="divide-gray-200 divide-y">
        @foreach($images as $image)
            @if($image->id == $activeFoto)
                <livewire:gallery.image :image="$image" :key="'image'.$image->id" />
            @endif
        @endforeach

        <div wire:key="images-carrousel">
            @if(count($images) > 1)
                <div class="p-4 flex-1">
                    <div class="flex flex-wrap -mx-2 -mb-2">
                        @foreach($images as $image)
                            <div class="w-1/6 px-2 mb-2">
                                <img class="rounded-md shadow-md {{$image->id == $activeFoto ? 'border-primary border-4' : ''}}" wire:click="$set('activeFoto', '{{ $image->id }}')" src="{{ $image->url }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-modal.modal>
