<!-- Name -->
<x-input.group label="Name" for="name" :error="$errors->first('company.name')" borderless>
    <x-input.text wire:model.lazy="company.name" id="name" placeholder="Name" :error="$errors->first('company.name')" />
</x-input.group>

<x-input.group label="Legal name" for="legal_name" class="sm:pt-0" borderless :error="$errors->first('company.legal_name')">
    <x-input.text wire:model.lazy="company.legal_name" id="legal_name" :error="$errors->first('company.legal_name')" placeholder="Legal name"/>
</x-input.group>

<x-input.group label="CIF" for="legal_id" class="sm:pt-0" borderless :error="$errors->first('company.legal_id')">
    <x-input.text wire:model.lazy="company.legal_id" id="legal_id" :error="$errors->first('company.legal_id')" placeholder="CIF"/>
</x-input.group>

<x-input.group label="Logo" for="logo"  :error="$errors->first('logo')" no-shadow>
    <x-input.file wire:model="logo" id="logo">
        <div class="h-32 w-full bg-white text-gray-300 flex items-center">
            @if($logo)
                <img class="max-h-32 mx-auto" src="{{ $logo->temporaryUrl() }}" alt="{{ __('Company Logo') }}">
            @else
                <img class="max-h-32 mx-auto" src="{{ $company->logo_url }}" alt="{{ __('Company Logo') }}">
            @endif
        </div>
    </x-input.file>
</x-input.group>
