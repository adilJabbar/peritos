<div class="p-3 sm:px-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
    <div>
        {{ $slot }}
    </div>
    <div class="flex-shrink-0 flex items-center space-x-2">
        @if($expedient->reference)
            <span class="text-xs">({{__('Ref')}}: {{ $expedient->reference }})</span>
        @endif
        <span class="font-bold">{{ $expedient->full_code }}</span>
        <div>
            <x-input.select id="expedient-status" placeholder="Selecciona el estado">
                <option value="opened">Opened</option>
            </x-input.select>
        </div>
    </div>
</div>
