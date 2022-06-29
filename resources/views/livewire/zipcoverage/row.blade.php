<x-table.row>
    <x-table.cell noPadding>
        <x-input.select id="zipCoverage-country_id" wire:model.lazy="zipCoverage.country_id" :error="$errors->first('zipCoverage.country_id')" placeholder="Selecciona el país">
            @foreach(\App\Models\Admin\Country::all()->sortBy('name') as $countryOption)
                <option value="{{$countryOption->id}}">{{__($countryOption->name)}}</option>
            @endforeach
        </x-input.select>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.select id="zipCoverage-gabinete_id" wire:model.lazy="zipCoverage.gabinete_id" :error="$errors->first('zipCoverage.gabinete_id')" placeholder="Selecciona el gabinete">
            @foreach($zipCoverage->user->gabinetes->sortBy('name') as $gabineteOption)
                <option value="{{$gabineteOption->id}}">{{__($gabineteOption->name)}}</option>
            @endforeach
        </x-input.select>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.text id="zipCoverage-from" type="number" step="1" wire:model.lazy="zipCoverage.from" :error="$errors->first('zipCoverage.from')"/>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.text id="zipCoverage-to" type="number" step="1" wire:model.lazy="zipCoverage.to" :error="$errors->first('zipCoverage.to')"/>
    </x-table.cell>
    <x-table.cell noPadding>
        <x-input.textarea id="zipCoverage-comments" wire:model.lazy="zipCoverage.comments" rows="1" :error="$errors->first('zipCoverage.comments')"/>
    </x-table.cell>
    <x-table.cell noPadding class="text-center">
        <x-button.danger wire:click="delete" size="xs"><x-icon.trash size="5" /></x-button.danger>
    </x-table.cell>
</x-table.row>
