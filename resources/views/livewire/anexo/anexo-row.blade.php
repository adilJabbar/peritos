<div class="flex space-x-2">

    <div class="flex-shrink-0">
        <a href="{{$anexo->url_expedient}}" target="_blank">
            <img class="max-h-8" src="{{$anexo->icon}}" alt="{{$anexo->extension}}">
        </a>
    </div>

    <x-input.text id="anexo-name-{{$anexo->id}}" wire:model.lazy="anexo.name" />
    <x-button.danger wire:click="removeAnexo" size="sm">
        <x-icon.minus-sm size="4" />
    </x-button.danger>

</div>
