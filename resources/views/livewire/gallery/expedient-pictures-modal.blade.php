<x-modal.modal wire:model.defer="showGalleryModal" class="w-full max-h-full overflow-auto" max-width="4xl">
    <div class="divide-gray-200 divide-y">
        @foreach($pictures as $picture)
            @if($picture->id == $activeFoto)
                <livewire:gallery.picture :picture="$picture" :key="'picture'.$picture->id" />
            @endif
        @endforeach

        <div wire:key="pictures-carrousel">
            @if(count($pictures) > 1)
                <div class="p-4 flex-1">
                    <div class="grid grid-cols-6 gap-4 items-center">
                        @foreach($pictures as $picture)
{{--                            <div class="w-1/6 px-2 mb-2">--}}
                                <img class="object-cover h-24 mx-auto rounded-md shadow-md {{$picture->id == $activeFoto ? 'border-primary border-4' : ''}}" wire:click="$set('activeFoto', '{{ $picture->id }}')" src="{{ $picture->public_url }}" alt="">
{{--                            </div>--}}
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-modal.modal>
