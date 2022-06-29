<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <div>{{__('Tipos de propuesta')}}</div>
        </x-card.header>
    </x-card.card>
    <x-card.card>
            <x-administration.destiny.table :destinies="$destinies" />
    </x-card.card>
</div>
