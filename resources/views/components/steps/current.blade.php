<!-- Current Step -->
<div wire:click="$set('openedStep', {{$number}})" class="px-6 py-4 flex items-center text-sm font-medium cursor-pointer">
        <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-primary rounded-full" aria-current="step">
          <span class="text-primary">{{ str_pad($number, 2, '0', STR_PAD_LEFT) }}</span>
        </span>
    <span class="ml-4 text-sm font-medium text-primary">{{ $title }}</span>
</div>
