<div>
    <div class="p-3 sm:px-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
        <div>
            {{ __($title) }}
        </div>
        <div class="flex-shrink-0 flex items-center space-x-2">
            @if($expedient->reference)
                <span class="text-xs">({{__('Ref')}}: {{ $expedient->reference }})</span>
            @endif
            <span class="font-bold">{{ $expedient->full_code }}</span>
            <div>
                <x-input.select wire:model="expedient.status_id" id="expedient-status" placeholder="Selecciona el estado">
                    @forelse($statuses as $statusRow)
                        <option value="{{ $statusRow->id }}">{{ __($statusRow->name) }}</option>
                    @empty
                        <option>{{__('No hay ningún estado de expediente definido en la aplicación')}}</option>
                    @endforelse
                </x-input.select>
            </div>
        </div>
    </div>
</div>
