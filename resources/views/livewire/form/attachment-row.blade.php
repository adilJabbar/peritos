<div class="flex space-x-2">

    <div class="flex-shrink-0">
        <a href="{{$attachment->url_expedient}}" target="_blank">
            <img class="max-h-8" src="{{$attachment->icon}}" alt="{{$attachment->extension}}">
        </a>
    </div>

    <x-input.text id="attachment-{{$attachment->id}}" wire:model.lazy="attachment.name" />
    <x-button.danger wire:click="removeAttachment" size="sm">
        <x-icon.minus-sm size="4" />
    </x-button.danger>

</div>
