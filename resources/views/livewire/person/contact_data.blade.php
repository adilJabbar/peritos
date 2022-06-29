<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:py-2">
    <label for="Emails y teléfonos"
           class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
        {{ __( 'Emails y teléfonos' ) }}
    </label>

    <div class="col-span-2 space-y-2">
        @forelse($contacts as $contactOption)
            <div wire:key="contact-{{$loop->index}}">
                @include('livewire.form.new-contact-row', [
                    'array' => 'contacts',
                    'contact' => $contactOption,
                    'total'=>count($contacts),
                    'readonly' => $readonly ?? false])
            </div>
        @empty
        @endforelse
    </div>
</div>
