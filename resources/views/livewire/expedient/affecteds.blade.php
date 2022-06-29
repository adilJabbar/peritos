<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Terceros Afectados'" />
    </x-card.card>

    <div class="flex justify-end">
        <x-button.primary wire:click="create"><x-icon.plus size="4" /></x-button.primary>
    </div>
            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($expedient->affecteds as $existingAffected)

                    <li class="relative col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200" wire:key="affected-item-{{$loop->index}}">
                        <livewire:expedient.affected :expedient="$expedient" :affected="$existingAffected" :key="'affectedCard-'.$existingAffected->id"/>

                    </li>
                @empty
                    {{__('No hay terceros afectados')}}
                @endforelse


            </ul>

    @include('livewire.affected.modal')

    @include('livewire.form.address-modal')
</div>
